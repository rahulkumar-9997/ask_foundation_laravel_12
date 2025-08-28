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
        <div class="row">
            <div class="col-lg-12">
                <!-- Donation Box Start -->
                <div class="donation-box">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Your donation</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">Your donation is more than just financial support; it is a powerful act of kindness that drives meaningful change. Every contribution helps provide essential resources, support impactful programs, and empower communities in need.</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Campaign Donation Form Start -->
                    <div class="donate-form campaign-donate-form">
                        <form id="donateForm" action="#" method="POST">
                            <div class="campaign-donate-value wow fadeInUp" data-wow-delay="0.4s">
                                <div class="form-group mb-4">
                                    <input type="text" name="text" class="form-control" id="text" placeholder="Donate Now ..." required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <fieldset class="donate-value-box">
                                    <div class="donate-value">
                                        <input type="radio" id="value1" name="value" value="value1" checked>
                                        <label for="value1">$ 100.00</label>
                                    </div>

                                    <div class="donate-value">
                                        <input type="radio" id="value2" name="value" value="value2">
                                        <label for="value2">$ 200.00</label>
                                    </div>

                                    <div class="donate-value">
                                        <input type="radio" id="value3" name="value" value="value3">
                                        <label for="value3">$ 300.00</label>
                                    </div>

                                    <div class="donate-value">
                                        <input type="radio" id="value4" name="value" value="value4">
                                        <label for="value4">$ 400.00</label>
                                    </div>

                                    <div class="donate-value">
                                        <input type="radio" id="value5" name="value" value="value5">
                                        <label for="value5">$ 500.00</label>
                                    </div>

                                    <div class="donate-value">
                                        <input type="radio" id="value6" name="value" value="value6">
                                        <label for="value6">$ 600.00</label>
                                    </div>
                                </fieldset>
                            </div>

                            <!-- Donation Payment Method Start -->
                            <div class="donate-payment-method">
                                <div class="section-title">
                                    <h2 class="text-anime-style-2" data-cursor="-opaque">Select <span>payment method</span></h2>
                                </div>
                                <div class="donate-payment-type wow fadeInUp" data-wow-delay="0.6s">
                                    <div class="payment-method">
                                        <input type="radio" id="test" name="payment" value="Test" checked>
                                        <label for="test">test donation</label>
                                    </div>
                                    <div class="payment-method">
                                        <input type="radio" id="Offline" name="payment" value="Offline">
                                        <label for="Offline">offline donation</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Donation Payment Method End -->

                            <!-- Donar Personal Info Start -->
                            <div class="donar-personal-info">
                                <!-- Section Title Start -->
                                <div class="section-title">
                                    <h2 class="text-anime-style-2" data-cursor="-opaque">Personal <span>info</span></h2>
                                </div>
                                <!-- Section Title End -->

                                <div class="row wow fadeInUp" data-wow-delay="0.8s">
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="fname" class="form-control" id="fname" placeholder="First name" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="lname" class="form-control" id="lname" placeholder="Last name" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-12 mb-4">
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your e-mail" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-12 mb-4">
                                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter your phone no." required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-12 mb-5">
                                        <textarea name="message" class="form-control" id="message" rows="4" placeholder="Write message"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Donar Personal Info End -->

                            <!-- Donar Info Form Button Start -->
                            <div class="form-group-btn wow fadeInUp" data-wow-delay="1s">
                                <button type="submit" class="btn-default">donate now</button>
                                <div id="msgSubmit" class="h3 hidden"></div>
                            </div>
                            <!-- Donar Info Form Button End -->
                        </form>
                    </div>
                    <!-- Campaign Donation Form End -->
                </div>
                <!-- Donation Box End -->
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

@endpush