<!-- Header Start -->
<header class="main-header active-sticky-header">
    <div class="header-sticky">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Logo Start -->
                <div class="logo-area">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{asset('fronted/assets/ask-img/logo-horizantal.png')}}" alt="Logo" class="for_desktop_logo">
                        <img src="{{asset('fronted/assets/ask-img/logo-vertical.png')}}" alt="Logo" class="for_mobile_logo">
                    </a>
                </div>

                <!-- Logo End -->

                <!-- Main Menu Start -->
                <div class="collapse navbar-collapse main-menu">
                    <div class="nav-menu-wrapper">
                        <ul class="navbar-nav mr-auto" id="menu">

                            <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
                            <li class="nav-item submenu"><a class="nav-link" href="#">Focus Areas</a>
                                <ul>
                                    <li class="nav-item"><a class="nav-link" href="#">Bone Health and
                                            Orthopedics</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Road safety programs</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Preventive Medicine and
                                            Medical Camps</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Medical Education and skill
                                            building </a></li>

                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#">Patient Support</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Our Doctors</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Blogs</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
                        </ul>
                    </div>
                    <!-- Contact Now Box Start -->
                    <div class="contact-now-box">
                        <div class="icon-box">
                            <img src="{{asset('fronted/assets/images/icon-phone.svg')}}" alt="">
                        </div>
                        <div class="contact-now-box-content">
                            <p>need help !</p>
                            <h3><a href="tel:789987645">(+91) 99350 70000</a></h3>
                        </div>
                    </div>
                </div>
                <div class="navbar-toggle"></div>
            </div>
        </nav>
        <div class="responsive-menu"></div>
    </div>
</header>
<!-- Header End -->