<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Donation;

class DonationController extends Controller
{
    public function donateUs()
    {
        return view('frontend.pages.donate-us.index');
    }

    public function donateStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount'     => 'required|numeric|min:10',
            'salutation' => 'required|string',
            'name'       => 'required|string|min:2|max:255',
            'pan_number' => 'required|string|size:10',
            'pan_image'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'email'      => 'required|email',
            'mobile'     => 'required|digits:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $token = Str::random(40);

        $donationData = $request->only([
            'amount',
            'salutation',
            'name',
            'pan_number',
            'email',
            'mobile'
        ]);
        if ($request->hasFile('pan_image')) {
            $tmpPath = $request->file('pan_image')->store("donations/tmp/{$token}");
            $donationData['pan_image'] = $tmpPath;
        }
        session([
            'donation' => $donationData,
            'donation_token' => $token,
            'donation_time' => now()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Donation details submitted successfully!',
            'redirect' => route('donate.confirmation', ['token' => $token])
        ]);
    }

    public function confirmation($token)
    {
        $donation = session('donation');
        $sessionToken = session('donation_token');
        $savedTime = session('donation_time');
        if (!$donation || $token !== $sessionToken) {
            return redirect()->route('donate-us')->with('error', 'Invalid or expired donation session.');
        }
        /* Expire after 5 minutes */
        if (now()->diffInMinutes($savedTime) > 5) {
            session()->forget(['donation', 'donation_token', 'donation_time']);
            return redirect()->route('donate-us')->with('error', 'Session expired. Please try again.');
        }
        $currency = config('app.donation_currency', env('DONATION_DEFAULT_CURRENCY', 'INR'));
        $amountFloat = (float) $donation['amount'];
        $subunitMultiplier = 100;
        if (in_array($currency, ['JPY'])) {
            $subunitMultiplier = 1;
        }
        $amountInSubunits = (int) round($amountFloat * $subunitMultiplier);
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $orderData = [
            'receipt'         => 'donation_' . $token,
            'amount'          => $amountInSubunits,
            'currency'        => $currency,
            'payment_capture' => 1
        ];
        try {
            $order = $api->order->create($orderData);
        } catch (\Exception $e) {
            Log::error('Razorpay order creation failed: ' . $e->getMessage());
            return redirect()->route('donate-us')->with('error', 'Payment gateway error. Please try again.');
        }
        return view('frontend.pages.donate-us.donate-con-display', [
            'donation' => $donation,
            'order' => $order,
            'token' => $token,
            'razorpayKey' => env('RAZORPAY_KEY'),
            'currency' => $currency
        ]);
    }

    public function paymentCallback(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id'   => 'required|string',
            'razorpay_signature'  => 'required|string',
            'token'               => 'required|string'
        ]);
        if (session('donation_token') !== $request->token) {
            return response()->json(['status' => 'error', 'message' => 'Invalid session token'], 403);
        }
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        try {
            $attributes = [
                'razorpay_order_id'   => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature'  => $request->razorpay_signature
            ];
            $api->utility->verifyPaymentSignature($attributes);
            $sessionDonation = session('donation');
            $donation = Donation::create([
                'token'               => session('donation_token'),
                'amount'              => $sessionDonation['amount'],
                'currency'            => config('app.donation_currency', env('DONATION_DEFAULT_CURRENCY', 'INR')),
                'salutation'          => $sessionDonation['salutation'],
                'name'                => $sessionDonation['name'],
                'pan_number'          => $sessionDonation['pan_number'],
                'email'               => $sessionDonation['email'],
                'mobile'              => $sessionDonation['mobile'],
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id'   => $request->razorpay_order_id,
                'razorpay_signature'  => $request->razorpay_signature,
                'payment_status'      => 'success'
            ]);
            if (!empty($sessionDonation['pan_image']) && Storage::exists($sessionDonation['pan_image'])) {
                $destinationPath = public_path('upload/donation/');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $safeName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $donation->name);
                $extension = pathinfo($sessionDonation['pan_image'], PATHINFO_EXTENSION);
                $uniqueTimestamp = round(microtime(true) * 1000);
                $imageName = $safeName . '-' . $uniqueTimestamp . '.' . $extension;
                $tmpFile = storage_path('app/' . $sessionDonation['pan_image']);
                if (file_exists($tmpFile)) {
                    $image = Image::make($tmpFile)->encode('webp', 75);
                    $image->save($destinationPath . '/' . $imageName);
                    Storage::delete($sessionDonation['pan_image']);
                    $donation->update(['pan_image' => $imageName]);
                }
            }
            session()->forget(['donation', 'donation_token', 'donation_time']);
            return response()->json([
                'status'   => 'success',
                'redirect' => route('donate.success')
            ]);
        } catch (\Exception $e) {
            Log::error('Razorpay verification error: ' . $e->getMessage());
            if (isset($donation)) {
                $donation->update(['payment_status' => 'failed']);
            }
            return response()->json([
                'status'   => 'error',
                'redirect' => route('donate.failed'),
                'message'  => 'Payment verification failed.'
            ], 400);
        }
    }


    public function success()
    {
        return view('frontend.pages.donate-us.success');
    }

    public function failed()
    {
        return view('frontend.pages.donate-us.failed');
    }
}
