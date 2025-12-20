@extends('frontend.layouts.master')
@section('title','Contact ASK Foundation | Get Support & Information')
@section('description', 'Get in touch with ASK Foundation for healthcare programs, awareness initiatives, donations, volunteering, and general inquiries.')
@section('main-content')
<div class="page-header parallaxie breakpoint-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque">
                        <span>Contact</span>
                        Us
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-contact-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-info-box">
                    <div class="contact-info-item wow fadeInUp">
                        <div class="icon-box">
                            <img src="{{asset('fronted/assets/ask-img/icon/icon-phone-primary.svg')}}" alt="">
                        </div>
                        <div class="contact-info-content">
                            <h3>contact us</h3>
                            <p><a href="tel:+919010844055">+91 9010844055</a></p>
                        </div>
                    </div>
                    <div class="contact-info-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-box">
                            <img src="{{asset('fronted/assets/ask-img/icon/icon-mail.svg')}}" alt="">
                        </div>
                        <div class="contact-info-content">
                            <h3>e-mail us</h3>
                            <p><a href="mailto:info@askfoundation.com">info@askfoundation.com</a></p>
                        </div>
                    </div>
                    <div class="contact-info-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="icon-box">
                            <img src="{{asset('fronted/assets/ask-img/icon/icon-location.svg')}}" alt="">
                        </div>
                        <div class="contact-info-content">
                            <h3>Location</h3>
                            <p>20/A  Road no.13,  Phase-2,<br> Film Nagar, Jubilee Hills,<br> Hyderabad - 500033</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="contact-form-section">
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-lg-6 order-lg-1 order-2">
                <div class="google-map-iframe">				
                    <iframe loading="lazy" src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d60910.94027003806!2d78.37296665919177!3d17.414965918672!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e1!4m5!1s0x3bcb96cfeaa61d61%3A0xe5feac7b1423d773!2sPhase-2%2C%2020%2FA%2C%20Rd%20Number%2013%2C%20Phase%20II%2C%20Film%20Nagar%2C%20Hyderabad%2C%20Telangana%20500096!3m2!1d17.413750699999998!2d78.41696759999999!4m5!1s0x3bcb96c8e8ead805%3A0xafce7c95528696ed!2sFilm%20Nagar%2C%20Hyderabad%2C%20Telangana!3m2!1d17.4160258!2d78.4113656!5e0!3m2!1sen!2sin!4v1765363263407!5m2!1sen!2sin" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <div class="col-lg-6 order-lg-2 order-1">
                <div class="contact-form-box">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">contact us</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Get in to touch</h2>
                    </div>
                    <div class="contact-form">
                        <form id="contactForm" action="{{ route('contact-us.submit') }}" method="POST" class="wow fadeInUp" data-wow-delay="0.2s">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name">                                   
                                </div>                            

                                <div class="form-group col-md-6 mb-4">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter your e-mail">
                                </div>

                                <div class="form-group col-md-12 mb-4">
                                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter your phone no." pattern="[0-9]{10}" maxlength="10">
                                </div>

                                <div class="form-group col-md-12 mb-3">
                                    <textarea name="message" class="form-control" id="message" rows="3" placeholder="Write message"></textarea>                                    
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn-default">
                                        <span>Submit</span>
                                    </button>                            
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Contact Form End -->
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

@endpush