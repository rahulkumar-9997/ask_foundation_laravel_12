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
                <div class="donation-box">
                    <div class="row donate-row">
                        <div class="col-lg-6">
                            <div class="section-title">
                                <h2 class="text-anime-style-2" data-cursor="-opaque">Donate us for Better Tomorrow !!</h2>
                            </div>
                            <div class="donate-text">
                                <p class="wow fadeInUp" data-wow-delay="0.2s">The season of giving and thinking of others is never ending. That’s why you’re probably seeing the signs of charitable organizations to do so and have finally reached here. </p>
                            </div>
                            <div class="donateusimg">
                                <figure class="image-anime reveal">
                                    <img src="{{asset('fronted/assets/ask-img/donate-us.jpeg')}}" alt="donate" loading="lazy">
                                </figure>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="donate-form campaign-donate-form">
                                <h4>
                                    Payment Details
                                </h4>
                                <div class="title-underline"></div>
                                <form id="donateForm" class="UI-form" method="POST" action="{{ route('donate-confirmation.store') }}" novalidate>
                                    @csrf
                                    <div class="Field Field--required Field--amount Field--currency-1 mb-2">
                                        <div class="Field-label">Amount</div>
                                        <div class="Field-content">
                                            <div class="Field-wrapper">
                                                <span class="Field-addon Field-addon--before">
                                                    <b class="currency-symbol">₹</b>
                                                </span>
                                                <input class="Field-el" type="number" name="amount" id="amount"
                                                    placeholder="Enter Amount" aria-label="Enter your Amount">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="Field Field--required mb-2">
                                        <div class="Field-label">Name</div>
                                        <div class="Field-content">
                                            <div class="selectoption">
                                                <div class="input-with-select">
                                                    <select name="salutation" id="salutation" class="form-group mb-0">
                                                        <option value="Mr">Mr</option>
                                                        <option value="Mrs">Mrs</option>
                                                        <option value="Ms">Ms</option>
                                                        <option value="M/S">M/S</option>
                                                    </select>
                                                </div>
                                                <div class="Field-wrapper">
                                                    <input class="Field-el" type="text" name="name" id="name"
                                                        placeholder="Enter your Name" aria-label="Enter your Name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="Field Field--required mb-2">
                                        <div class="Field-label">PAN Number</div>
                                        <div class="Field-content">
                                            <div class="Field-wrapper">
                                                <input class="Field-el" type="text" name="pan_number" id="pan_number"
                                                    placeholder="Enter your PAN Number" aria-label="Enter your PAN Number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Field Field--required mb-2">
                                        <div class="Field-label">PAN Photo</div>
                                        <div class="Field-content">
                                            <div class="Field-wrapper">
                                                <input class="Field-el" type="file" name="pan_image" id="pan_image"
                                                    placeholder="Enter your PAN Number" aria-label="Enter your PAN Number">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="Field Field--required mb-2">
                                        <div class="Field-label">Email</div>
                                        <div class="Field-content">
                                            <div class="Field-wrapper">
                                                <input class="Field-el" type="email" name="email" id="email"
                                                    placeholder="Enter your Email" aria-label="Enter your Email">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="Field Field--required mb-2">
                                        <div class="Field-label">Mobile</div>
                                        <div class="Field-content">
                                            <div class="Field-wrapper">
                                                <input class="Field-el" type="tel" name="mobile" id="mobile"
                                                    placeholder="Enter your Mobile" maxlength="10" aria-label="Enter your Mobile">
                                            </div>
                                        </div>
                                    </div>

                                    <div id="form-footer" class="form-footer-payment mt-2">
                                        <img id="fin-logo" alt="pay-methods"
                                            src="https://cdn.razorpay.com/static/assets/pay_methods_branding.png" width="180">
                                        <button type="submit" class="btn btn--gradient" tabindex="0">
                                            Donate <span id="donate-amount-text">₹ 0.00</span>
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('fronted/assets/js/donate.js')}}"></script>
<script>
    $(document).ready(function () {
        $('input[name="amount"]').on('input', function () {
            let amount = $(this).val() || '0.00';
            $('#donate-amount-text').text('₹ ' + amount);
        });
    });

</script>
@endpush