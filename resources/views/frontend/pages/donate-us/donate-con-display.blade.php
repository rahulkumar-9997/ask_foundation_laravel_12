@extends('frontend.layouts.master')
@section('title','Donate us | ASK Foundation')
<!-- @section('description', 'List of Our Doctors - Ask Foundation Healthcare Services and Support Programs') -->
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
                                    <th colspan="3" style="text-align: center; font-size: 22px;">Please confirm your details</th>
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
                                        <div class="col-sm-12" style="text-align: center;">
                                            <form method="post" action="./cashfreecheckout">
                                                <div class="form-group">
                                                    <input type="hidden" name="order_id" value="1437183">
                                                    <input type="hidden" name="order_amount" value="4500.00">
                                                    <input type="hidden" name="customer_id" value="1437183">
                                                    <input type="hidden" name="customer_name" value="asdsa">
                                                    <input type="hidden" name="customer_email" value="admin@gmail.com">
                                                    <input type="hidden" name="customer_mobileno" value="1212121212">
                                                    <input type="hidden" name="customer_address" value="">
                                                    <!--<input type="hidden" name="price" value="4500.00" />-->
                                                    <input type="hidden" name="donor_slug" value="8769d293583d85895f5e729c0a7d2e45">
                                                    <input type="hidden" name="donation_payment_type_id" value="1">
                                                    <input type="hidden" name="plan_max_cycles" value="">
                                                    <input type="hidden" name="created_date" value="2025-09-11 16:19:36">
                                                </div>
                                                <input type="submit" name="submit" value="Donate Now" class="btn btn-primary">
                                            </form>
                                        </div>
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

@endpush