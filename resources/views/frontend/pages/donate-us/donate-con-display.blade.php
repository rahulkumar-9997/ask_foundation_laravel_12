@extends('frontend.layouts.master')
@section('title','Donate us | ASK Foundation')
@section('main-content')
<div class="page-header parallaxie breakpoint-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque">
                        <span>Donate</span>
                        Us
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-donation">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-xs-8 col-sm-8 col-md-8">
                <div class="donation-box-confirmation">
                    <div class="table-responsive1">
                        <table class="table table-bordered table-striped" style="background: #f3f9ff;box-shadow: 0 4px 12px 0 #c0c0c0;">
                            <tbody>
                                <tr>
                                    <th style="text-align: left; font-size: 16px; width: 50%;">
                                       <a href="{{ route('donate-us') }}" class="btn btn-sm btn-success">
                                       Edit
                                       </a>
                                    </th>
                                    <th style="font-size: 20px; width: 50%;">
                                        Please confirm your details
                                    </th>
                                </tr>
                                <tr>
                                    <th width="30%">Amount</th>
                                    <td>₹{{ $donation['amount'] }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $donation['salutation'] }} {{ $donation['name'] }}</td>
                                </tr>
                                <tr>
                                    <th>PAN Number</th>
                                    <td>{{ $donation['pan_number'] }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $donation['email'] }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile</th>
                                    <td>{{ $donation['mobile'] }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="col-md-5">
                                        <div class="col-sm-12 text-center">
                                            <button id="rzp-pay-btn" class="btn-default nonate_now_btn">
                                                Pay Now (₹ {{ $donation['amount'] }})
                                            </button>
                                        </div>
                                        <div id="payment-message" class="mt-3 text-center"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    const paymentMessage = document.getElementById('payment-message');
    function showMessage(msg, type="info") {
        let color = "#333";
        if (type === "success") color = "green";
        if (type === "error") color = "red";
        paymentMessage.innerHTML = `<span style="color:${color};font-weight:bold;">${msg}</span>`;
    }

    const options = {
        key: "{{ $razorpayKey }}",
        amount: "{{ $order['amount'] }}", 
        currency: "{{ $order['currency'] }}",
        name: "ASK Foundation",
        description: "Donation Payment",
        order_id: "{{ $order['id'] }}",
        prefill: {
            name: "{{ $donation['salutation'].' '.$donation['name'] }}",
            email: "{{ $donation['email'] }}",
            contact: "{{ $donation['mobile'] }}"
        },
        handler: function (response){
            showMessage("Verifying payment, please wait...");

            $.ajax({
                url: "{{ route('donate.callback') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    razorpay_payment_id: response.razorpay_payment_id,
                    razorpay_order_id: response.razorpay_order_id,
                    razorpay_signature: response.razorpay_signature,
                    token: "{{ $token }}"
                },
                success: function(res){
                    if(res.status === 'success'){
                        showMessage("Payment successful! Redirecting...", "success");
                        setTimeout(() => {
                            window.location.href = res.redirect;
                        }, 1500);
                    } else {
                        showMessage(res.message || 'Payment verification failed.', "error");
                        setTimeout(() => {
                            if(res.redirect){
                                window.location.href = res.redirect;
                            }
                        }, 2000);
                    }
                },
                error: function(xhr){
                    let errorMsg = "Server error while verifying payment.";
                    if(xhr.responseJSON && xhr.responseJSON.message){
                        errorMsg = xhr.responseJSON.message;
                    }
                    showMessage(errorMsg, "error");
                    setTimeout(() => {
                        window.location.href = "{{ route('donate.failed') }}";
                    }, 2000);
                }
            });
        },
        modal: {
            ondismiss: function(){
                showMessage("Payment process was cancelled by you.", "error");
            }
        }
    };

    const rzp = new Razorpay(options);
    document.getElementById('rzp-pay-btn').addEventListener('click', function(e){
        showMessage("Opening secure payment gateway...");
        rzp.open();
        e.preventDefault();
    });
</script>
@endpush
