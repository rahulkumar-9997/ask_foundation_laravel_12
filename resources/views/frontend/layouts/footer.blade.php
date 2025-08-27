<!-- Main Footer Section Start -->
<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-footer-box">
                    <div class="footer-about">
                        <div class="footer-logo">
                            <img src="{{asset('fronted/assets/ask-img/logo-horizantal.png')}}" alt="">
                        </div>
                        <div class="footer-contact-detail1">
                            <div class="footer-contact-item">
                                <p>Connect with us</p>
                                <h3><a href="tel:+919010844055">+91 9010844055</a></h3>
                            </div>
                            <div class="footer-contact-item">
                                <h3><a href="mailto:info@askfoundation.com">info@askfoundation.com</a></h3>
                            </div>
                        </div>
                        <div class="footer-social-links">
                            <ul>
                                <li>
                                    <a href="https://www.youtube.com/@AskTheFoundation" target="_blank">
                                        <i class="fa-brands fa fa-youtube"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.facebook.com/people/Ask-The-Foundation/61578640861940/" target="_blank">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/askthefoundation/" target="_blank">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer-links-box">
                        <div class="footer-links">
                            <h3>Quick link</h3>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ route('about-us') }}">About us</a></li>
                                <li><a href="{{ route('our-doctors') }}">Our Doctors</a></li>
                                <li><a href="{{ route('blog') }}">Blog</a></li>
                                <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                                <li><a href="{{ route('donate-us')}}">Donate Us</a></li>
                            </ul>
                        </div>
                        <div class="footer-links footer-service-links">
                            <h3>Key Focus Areas</h3>
                            <ul>
                                <li><a href="#">Bone Health and Orthopedics</a></li>
                                <li><a href="#">Road Safety Programs</a></li>
                                <li><a href="#">Preventive Medicine and Medical Camps</a></li>
                                <li><a href="#">Medical Education and skill building </a></li>
                            </ul>
                        </div>
                        <div class="footer-links">
                            <h3>support</h3>
                            <ul>
                                <li><a href="#">Patient Support</a></li>
                                <li><a href="#">Team of Doctors</a></li>
                                <li><a href="#">privacy policy</a></li>
                                <li><a href="#">terms & conditions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright-text">
                        <p>Copyright © 2025 All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="position-fixed start-0 end-0" style="z-index: 11; bottom: 50px">
    <div id="liveToast" class="toast align-items-center mx-auto" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<!--Toast notification-->