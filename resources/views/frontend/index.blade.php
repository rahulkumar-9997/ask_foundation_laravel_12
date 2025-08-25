@extends('frontend.layouts.master')
@section('title','Ask Foundation')
@section('description', 'To create comprehensive awareness about bone health and road safety, empowering communities with knowledge and resources for prevention.')
@section('main-content')
@if (!empty($data['bannerVideo']) && $data['bannerVideo']->count() > 0)
<div class="hero hero-video">
   <div class="hero-bg-video">
      @if($data['bannerVideo']->desktop_video_url)
      <video autoplay muted loop id="myVideo" class="desktopvideo">
         <source src="{{ asset('upload/banner/' . $data['bannerVideo']->desktop_video_url) }}" type="video/mp4">
      </video>
      @else
      <video autoplay muted loop id="myVideo" class="desktopvideo">
         <source src="https://inforbit.in/ask2.mp4" type="video/mp4">
      </video>
      @endif
      @if($data['bannerVideo']->mobile_video_url)
      <video autoplay muted loop id="myVideo" class="mobilevideo">
         <source src="{{ asset('upload/banner/' . $data['bannerVideo']->mobile_video_url) }}" type="video/mp4">
      </video>
      @else
      <video autoplay muted loop id="myVideo" class="mobilevideo">
         <source src="{{asset('fronted/assets/ask-img/vertical-banner-video.mp4')}}" type="video/mp4">
      </video>
      @endif
      <div class="video-overlay"></div>
   </div>
   <div class="container container-for-mobile">
      <div class="row align-items-center">
         <div class="col-lg-8">
            <div class="hero-content">
               <div class="section-title">
                  <!-- <h3 class="wow fadeInUp">{{ $data['bannerVideo']->title }}</h3> -->
                  <h1 class="text-anime-style-2" data-cursor="-opaque">
                     {!! $data['bannerVideo']->subtitle !!}
                  </h1>
                  <p class="wow fadeInUp" data-wow-delay="0.2s">
                     {{ $data['bannerVideo']->description }}
                  </p>
               </div>
               <div class="hero-body wow fadeInUp" data-wow-delay="0.4s">
                  @if($data['bannerVideo']->button_link)
                  <div class="hero-btn">
                     <a href="{{ $data['bannerVideo']->button_link}}" target="_blank" class="btn-default">Know More</a>
                  </div>
                  @endif
                  <!-- <div class="video-play-button">
                     <p>play video</p>
                     <a href="#" class="popup-video" data-cursor-text="Play">
                        <i class="fa-solid fa-play"></i>
                     </a>
                  </div> -->
               </div>
               <!-- @if($data['bannerVideo']->features)
               <div class="hero-footer wow fadeInUp" data-wow-delay="0.6s">
                  <div class="hero-list">
                     <ul>
                        @foreach ($data['bannerVideo']->features as $feature)
                        <li>{{ $feature }}</li>
                        @endforeach
                     </ul>
                  </div>
               </div>
               @endif -->
            </div>
         </div>
      </div>
   </div>
</div>
@endif
@php
$bgColors = ['#fff7ed', '#f0fdf4', '#faf5ff'];
$colorIndex = 0;
$features = $data['bannerVideo']->features ?? [];
@endphp
@if(count($features) > 0)
<div class="feature-area home-feature fa-negative home-features-section">
   <div class="container">
      <div class="row justify-content-md-center">
         <div class="col-xl-12 col-lg-12">
            <div class="feature-wrapper wow fadeInUp" data-wow-delay="0.6s">
               <div class="row justify-content-md-center">
                  @foreach ($features as $feature)
                  <div class="col-lg-4">
                     <div class="feature-item" style="background-color: {{ $bgColors[$colorIndex % count($bgColors)] }};">
                        <a href="#">
                           <div class="banner-feature" >
                              <h3>
                                 {{ $feature }}
                              </h3>
                           </div>
                        </a>
                     </div>
                  </div>
                  @php $colorIndex++; @endphp
                  @endforeach
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endif
<!-- Hero Section End -->
<!-- About Us Section Start -->
<div class="about-us">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-lg-6">
            <div class="about-us-images">
               <div class="about-img-1">
                  <figure class="image-anime">
                     <img src="{{asset('fronted/assets/ask-img/dr.sai-laxman-anne.jpg')}}" alt="">
                  </figure>
               </div>
               <div class="about-img-2">
                  <figure class="image-anime">
                     <img src="{{asset('fronted/assets/images/ask-1.png')}}" alt="">
                  </figure>
               </div>
               <div class="need-fund-box">
                  <img src="{{asset('fronted/assets/ask-img/icon/icon-funded-dollar.svg')}}" alt="">
                  <p>Promoting early detection and prevention of bone diseases.</p>
               </div>
            </div>
         </div>

         <div class="col-lg-6">
            <div class="about-us-content home-about-us-page">
               <div class="section-title">
                  <h2 class="text-anime-style-2 empowerh2" data-cursor="-opaque">
                     EMPOWER LIVES & <br>COMMUNITIES THROUGH <br><span class="spanabou"> PREVENTIVE CARE & EDUCATION</span>
                  </h2>
                  <p class="wow fadeInUp aboutP" data-wow-delay="0.2s">
                     Dr. Sai Laxman Anne is a highly accomplished Chief Consultant Orthopaedic and Joint Replacement Surgeon, holding an M.S. in Orthopaedics and distinguished by prestigious fellowships in Arthroplasty from both India and the UK. With a vast surgical experience that includes performing over 5,000 primary and 200 revision knee and hip replacements, his expertise is further demonstrated through his leadership roles as a Head of Department, Programme Director for Minimally Invasive Surgery, and Consultant Limb Reconstruction Surgeon. His practice incorporates advanced techniques, with special training in computer-navigated surgery and pain management from John Hopkins, USA. Deeply committed to serving the medical community and advancing the field, Dr. Anne actively contributes as a national faculty member at esteemed institutes, dedicating his time to training the next generation of surgeons through numerous workshops, publications, and presentations across the country.
                  </p>
               </div>
               <div class="about-btn wow fadeInUp mt-3" data-wow-delay="0.6s">
                  <a href="{{ route('about-us') }}" class="btn-default">about us</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- About Us Section End -->
<!-- Our Causes Section Start -->
<div class="our-causes health-focus-area">
   <div class="container">
      <div class="row section-row align-items-center">
         <div class="col-lg-12">
            <div class="section-title">
               <h2 class="text-anime-style-2" data-cursor="-opaque">Our Health Focus Areas</h2>
               <p class="wow fadeInUp" data-wow-delay="0.2s">
                  Targeted programs addressing critical health challenges in our communities
               </p>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-lg-6 col-md-6 mb-4">
            <div class="health-card health-card-bg1 wow fadeInUp">
               <div class="card-header">
                  <div class="header-content">
                     <div class="icon-container health-icon-bg1">
                        <svg class="card-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                           fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                           stroke-linejoin="round">
                           <path
                              d="M17 10c.7-.7 1.69 0 2.5 0a2.5 2.5 0 1 0 0-5 .5.5 0 0 1-.5-.5 2.5 2.5 0 1 0-5 0c0 .81.7 1.8 0 2.5l-7 7c-.7.7-1.69 0-2.5 0a2.5 2.5 0 0 0 0 5c.28 0 .5.22.5.5a2.5 2.5 0 1 0 5 0c0-.81-.7-1.8 0-2.5Z">
                           </path>
                        </svg>
                     </div>
                     <h3 class="card-title">Bone Health</h3>
                  </div>
                  <p class="card-description">
                     Comprehensive education on maintaining strong bones throughout life, proper
                     nutrition, and exercise for optimal bone density.
                  </p>
               </div>
               <div class="card-content">
                  <div class="topics-section">
                     <h4 class="section-title">Key Topics:</h4>
                     <div class="badges-container">
                        <span class="topic-badge">Calcium & Vitamin D</span>
                        <span class="topic-badge">Weight-bearing Exercise</span>
                        <span class="topic-badge">Bone Density Testing</span>
                        <span class="topic-badge">Lifestyle Factors</span>
                     </div>
                  </div>
                  <a href="#" class="learn-more-btn">Learn More</a>
               </div>
            </div>
         </div>
         <div class="col-lg-6 col-md-6 mb-4">
            <div class="health-card health-card-bg2 wow fadeInUp">
               <div class="card-header">
                  <div class="header-content">
                     <div class="icon-container health-icon-bg2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                           fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                           stroke-linejoin="round" class="lucide lucide-heart h-6 w-6 text-white">
                           <path
                              d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z">
                           </path>
                        </svg>
                     </div>
                     <h3 class="card-title">Osteoporosis Prevention</h3>
                  </div>
                  <p class="card-description">
                     Early detection strategies, risk assessment, and evidence-based prevention methods to
                     reduce fracture risk.
                  </p>
               </div>
               <div class="card-content">
                  <div class="topics-section">
                     <h4 class="section-title">Key Topics:</h4>
                     <div class="badges-container">
                        <span class="topic-badge">Risk Factors</span>
                        <span class="topic-badge">Early Screening</span>
                        <span class="topic-badge">Medication Options</span>
                        <span class="topic-badge">Fall Prevention</span>
                     </div>
                  </div>
                  <a href="#" class="learn-more-btn">Learn More</a>
               </div>
            </div>
         </div>

         <div class="col-lg-6 col-md-6 mb-4">
            <div class="health-card health-card-bg3 wow fadeInUp">
               <div class="card-header">
                  <div class="header-content">
                     <div class="icon-container health-icon-bg3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                           fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                           stroke-linejoin="round" class="lucide lucide-shield h-6 w-6 text-white">
                           <path
                              d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z">
                           </path>
                        </svg>
                     </div>
                     <h3 class="card-title">Osteoarthritis Management</h3>
                  </div>
                  <p class="card-description">
                     Joint health maintenance, pain management strategies, and lifestyle modifications to
                     slow disease progression.
                  </p>
               </div>
               <div class="card-content">
                  <div class="topics-section">
                     <h4 class="section-title">Key Topics:</h4>
                     <div class="badges-container">
                        <span class="topic-badge">Joint Protection</span>
                        <span class="topic-badge">Physical Therapy</span>
                        <span class="topic-badge">Pain Management</span>
                        <span class="topic-badge">Nutrition Support</span>
                     </div>
                  </div>
                  <a href="#" class="learn-more-btn">Learn More</a>
               </div>
            </div>
         </div>

         <div class="col-lg-6 col-md-6 mb-4">
            <div class="health-card health-card-bg4 wow fadeInUp">
               <div class="card-header">
                  <div class="header-content">
                     <div class="icon-container health-icon-bg4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                           fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                           stroke-linejoin="round" class="lucide lucide-triangle-alert h-6 w-6 text-white">
                           <path
                              d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3">
                           </path>
                           <path d="M12 9v4"></path>
                           <path d="M12 17h.01"></path>
                        </svg>
                     </div>
                     <h3 class="card-title">Road Safety</h3>
                  </div>
                  <p class="card-description">
                     Comprehensive road traffic accident prevention through awareness, education, and safety
                     measure implementation.
                  </p>
               </div>
               <div class="card-content">
                  <div class="topics-section">
                     <h4 class="section-title">Key Topics:</h4>
                     <div class="badges-container">
                        <span class="topic-badge">Safe Driving</span>
                        <span class="topic-badge">Pedestrian Safety</span>
                        <span class="topic-badge">Traffic Rules</span>
                        <span class="topic-badge">Emergency Response</span>
                     </div>
                  </div>
                  <a href="#" class="learn-more-btn">Learn More</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Our Causes Section End -->
<!-- What We Do Section Start -->
<div class="what-we-do">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-lg-6">
            <div class="what-we-do-content">
               <div class="section-title">
                  <h3 class="wow fadeInUp">what we do</h3>
                  <h2 class="text-anime-style-2" data-cursor="-opaque">Building hope creating lasting change
                  </h2>
               </div>
               <div class="what-we-list">
                  <div class="what-we-item wow fadeInUp" data-wow-delay="0.2s">
                     <div class="icon-box">
                        <img src="{{asset('fronted/assets/ask-img/icon/icon-what-we-1.svg')}}" alt="">
                     </div>
                     <div class="what-we-item-content">
                        <h3>economic empowerment</h3>
                        <p>Empowering individuals through job training, financial literacy, and small
                           business support to create sustainable livelihoods.</p>
                     </div>
                  </div>
                  <div class="what-we-item wow fadeInUp" data-wow-delay="0.4s">
                     <div class="icon-box">
                        <img src="{{asset('fronted/assets/ask-img/icon/icon-what-we-2.svg')}}" alt="">
                     </div>
                     <div class="what-we-item-content">
                        <h3>clean water and sanitation</h3>
                        <p>Empowering individuals through job training, financial literacy, and small
                           business support to create sustainable livelihoods.</p>
                     </div>
                  </div>
                  <div class="what-we-item wow fadeInUp" data-wow-delay="0.6s">
                     <div class="icon-box">
                        <img src="{{asset('fronted/assets/ask-img/icon/icon-what-we-3.svg')}}" alt="">
                     </div>
                     <div class="what-we-item-content">
                        <h3>economic empowerment</h3>
                        <p>Empowering individuals through job training, financial literacy, and small
                           business support to create sustainable livelihoods.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="what-we-do-images">
               <div class="what-we-do-img-1">
                  <figure class="image-anime reveal">
                     <img src="{{asset('fronted/assets/images/ask-3.png')}}" alt="">
                  </figure>
               </div>
               <div class="what-we-do-img-2">
                  <figure class="image-anime">
                     <img src="{{asset('fronted/assets/images/ask-e.png')}}" alt="">
                  </figure>
               </div>
               <div class="donate-now-box">
                  <a href="donation.html">
                     <img src="{{asset('fronted/assets/ask-img/icon/icon-donate-now.svg')}}" alt="">
                     donate now
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- What We Do Section End -->
<!-- Why Choose Us Section Start -->
<div class="why-choose-us">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-lg-5">
            <div class="why-choose-images">
               <div class="why-choose-image-1">
                  <figure class="image-anime">
                     <img src="{{asset('fronted/assets/images/why-choose-img-1.jpg')}}" alt="">
                  </figure>
               </div>
               <div class="why-choose-image-2">
                  <figure class="image-anime">
                     <img src="{{asset('fronted/assets/images/team-1.jpg')}}" alt="">
                  </figure>
               </div>
            </div>5
         </div>

         <div class="col-lg-7">
            <div class="why-choose-content">
               <div class="section-title">
                  <h3 class="wow fadeInUp">why choose us</h3>
                  <h2 class="text-anime-style-2" data-cursor="-opaque">
                     Building Stronger Bones & Safer Roads
                  </h2>
                  <p class="wow fadeInUp" data-wow-delay="0.2s">
                     ASK Foundation is dedicated to creating awareness about bone health, preventing
                     osteoporosis and osteoarthritis, and promoting road traffic safety to build healthier,
                     safer communities.
                  </p>
               </div>
               <div class="why-choose-counters">
                  <div class="why-choose-counter-item">
                     <h2><span class="counter">10</span>M+</h2>
                     <p>People Affected by Osteoporosis</p>
                  </div>
                  <div class="why-choose-counter-item">
                     <h2><span class="counter">1.3</span>M+</h2>
                     <p>Road Traffic Deaths Annually</p>
                  </div>
                  <div class="why-choose-counter-item">
                     <h2><span class="counter">90</span>%</h2>
                     <p>Preventable Through Awareness</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Why Choose Us Section End -->
<!-- Our Program Section Start -->
<div class="our-program about-ask-foundation-section">
   <div class="container">
      <div class="row section-row align-items-center">
         <div class="col-lg-12">
            <div class="section-title">
               <h3 class="wow fadeInUp">Some Facts of our Society</h3>
               <h2 class="text-anime-style-2" data-cursor="-opaque">About ASK Foundation</h2>
               <p class="wow fadeInUp" data-wow-delay="0.2s">
                  Dedicated to improving lives through comprehensive health education and safety awareness
                  programs
               </p>
            </div>
         </div>
      </div>

      <div class="row align-items-center">
         <div class="col-lg-6">
            <div class="row">
               <div class="col-lg-6 col-md-6">
                  <div class="about-ask-foundation-card wow fadeInUp">
                     <div class="about-ask-foundation-content">
                        <div class="about-ask-foundation-icon-container about-ask-icon-bg1">
                           <svg class="about-ask-foundation-icon" xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                              stroke-linecap="round" stroke-linejoin="round">
                              <circle cx="12" cy="12" r="10"></circle>
                              <circle cx="12" cy="12" r="6"></circle>
                              <circle cx="12" cy="12" r="2"></circle>
                           </svg>
                        </div>
                        <h3 class="about-ask-foundation-title">Our Mission</h3>
                        <p class="about-ask-foundation-description">
                           To create comprehensive awareness about bone health and road safety, empowering
                           communities with knowledge and resources for prevention.
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6">
                  <div class="about-ask-foundation-card wow fadeInUp">
                     <div class="about-ask-foundation-content">
                        <div class="about-ask-foundation-icon-container about-ask-icon-bg2">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                              fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" class="lucide lucide-users h-8 w-8 text-white">
                              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                              <circle cx="9" cy="7" r="4"></circle>
                              <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                              <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                           </svg>
                        </div>
                        <h3 class="about-ask-foundation-title">Community Impact</h3>
                        <p class="about-ask-foundation-description">
                           Building a network of informed individuals who can make healthier choices and contribute
                           to safer communities for everyone.
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6">
                  <div class="about-ask-foundation-card wow fadeInUp">
                     <div class="about-ask-foundation-content">
                        <div class="about-ask-foundation-icon-container about-ask-icon-bg3">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                              fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" class="lucide lucide-book-open h-8 w-8 text-white">
                              <path d="M12 7v14"></path>
                              <path
                                 d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z">
                              </path>
                           </svg>
                        </div>
                        <h3 class="about-ask-foundation-title">Education Focus</h3>
                        <p class="about-ask-foundation-description">
                           Providing evidence-based information about osteoporosis, osteoarthritis prevention, and
                           road traffic safety measures.
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6">
                  <div class="about-ask-foundation-card wow fadeInUp">
                     <div class="about-ask-foundation-content">
                        <div class="about-ask-foundation-icon-container about-ask-icon-bg4">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                              fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" class="lucide lucide-lightbulb h-8 w-8 text-white">
                              <path
                                 d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5">
                              </path>
                              <path d="M9 18h6"></path>
                              <path d="M10 22h4"></path>
                           </svg>
                        </div>
                        <h3 class="about-ask-foundation-title">Innovation</h3>
                        <p class="about-ask-foundation-description">
                           Developing innovative approaches to health education and safety awareness through modern
                           communication channels.
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="about-video-section">
               <div class="about-video-item video-container">
                  <video
                     class="tag-video"
                     controls
                     autoplay
                     muted
                     playsinline
                     loop
                     preload="metadata"
                     loading="lazy">
                     <source src="{{asset('fronted/assets/ask-img/about-video.mp4')}}" type="video/mp4">
                     <source src="{{asset('fronted/assets/ask-img/about-video.webm')}}" type="video/webm">
                     Your browser does not support HTML5 video.
                  </video>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Our Program Section End -->
<!-- Scrolling Ticker Start -->
<div class="scrolling-ticker mb-3">
   <div class="scrolling-ticker-box">
      <div class="scrolling-content">
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" alt="">Bone Health and Orthopedics</span>
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" alt="">Road safety programs</span>
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" alt="">Preventive Medicine and Medical Camps</span>
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" alt="">Bone Health and Orthopedics</span>
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" alt="">Road safety programs</span>
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" alt="">Preventive Medicine and Medical Camps</span>
      </div>

      <div class="scrolling-content">
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" alt="">Bone Health and Orthopedics</span>
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" alt="">Road safety programs</span>
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" alt="">Preventive Medicine and Medical Camps</span>
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" alt="">Bone Health and Orthopedics</span>
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" alt="">Road safety programs</span>
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" alt="">Preventive Medicine and Medical Camps</span>
      </div>
   </div>
</div>
<!-- Scrolling Ticker End -->
<!-- Our Features Section Start -->
<div class="our-features the-number-tellstory-section">
   <div class="container">
      <div class="row section-row">
         <div class="col-lg-12">
            <div class="section-title">
               <h2 class="text-anime-style-2" data-cursor="-opaque">
                  The Numbers Tell the Story
               </h2>
               <p class="wow fadeInUp" data-wow-delay="0.2s">
                  Understanding the scope of health challenges we're addressing together
               </p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-3 col-md-6">
            <div class="number-tell-story-card">
               <div class="tell-story-content">
                  <div class="number-tell-story-stat story-color1">50%</div>
                  <div class="number-tell-story-title">Fracture Risk</div>
                  <div class="number-tell-story-description">For women over 50</div>
               </div>
            </div>
         </div>
         <div class="col-lg-3 col-md-6">
            <div class="number-tell-story-card">
               <div class="tell-story-content">
                  <div class="number-tell-story-stat story-color2">54M</div>
                  <div class="number-tell-story-title">Americans</div>
                  <div class="number-tell-story-description">With osteoarthritis</div>
               </div>
            </div>
         </div>
         <div class="col-lg-3 col-md-6">
            <div class="number-tell-story-card">
               <div class="tell-story-content">
                  <div class="number-tell-story-stat story-color3">200M</div>
                  <div class="number-tell-story-title">Women Worldwide</div>
                  <div class="number-tell-story-description">Affected by osteoporosis</div>
               </div>
            </div>
         </div>
         <div class="col-lg-3 col-md-6">
            <div class="number-tell-story-card">
               <div class="tell-story-content">
                  <div class="number-tell-story-stat story-color4">38,000</div>
                  <div class="number-tell-story-title">Lives Lost</div>
                  <div class="number-tell-story-description">Daily in road accidents</div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Our Features Section End -->
<!-- How It Work Section Start -->
<div class="how-it-work">
   <div class="container">
      <div class="row section-row">
         <div class="col-lg-12">
            <div class="section-title">
               <h3 class="wow fadeInUp">How it works</h3>
               <h2 class="text-anime-style-2" data-cursor="-opaque">Step by step working process</h2>
               <p class="wow fadeInUp" data-wow-delay="0.2s">Our step-by-step process ensures meaningful
                  change: identifying community needs, designing tailored programs, implementing sustainable
                  solutions.</p>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-lg-12">
            <div class="how-it-work-list">
               <div class="how-it-work-item">
                  <div class="how-it-work-image">
                     <figure class="image-anime reveal">
                        <img src="{{asset('fronted/assets/images/ask-1.png')}}" alt="">
                     </figure>
                  </div>
                  <div class="how-it-work-content wow fadeInUp" data-wow-delay="0.4s">
                     <div class="icon-box">
                        <img src="{{asset('fronted/assets/ask-img/icon/icon-how-it-work-1.svg')}}" alt="">
                     </div>
                     <div class="how-it-work-body">
                        <h3>healthcare support</h3>
                        <p>Provide essential healthcare service and resources to communities.</p>
                     </div>
                  </div>
               </div>
               <div class="how-it-work-item">
                  <div class="how-it-work-image">
                     <figure class="image-anime reveal">
                        <img src="{{asset('fronted/assets/images/ask-a.png')}}" alt="">
                     </figure>
                  </div>
                  <div class="how-it-work-content wow fadeInUp" data-wow-delay="0.4s">
                     <div class="icon-box">
                        <img src="{{asset('fronted/assets/ask-img/icon/icon-how-it-work-2.svg')}}" alt="">
                     </div>
                     <div class="how-it-work-body">
                        <h3>Plan and design</h3>
                        <p>Provide essential healthcare service and resources to communities.</p>
                     </div>
                  </div>
               </div>
               <div class="how-it-work-item">
                  <div class="how-it-work-image">
                     <figure class="image-anime reveal">
                        <img src="{{asset('fronted/assets/images/ask-b.png')}}" alt="">
                     </figure>
                  </div>
                  <div class="how-it-work-content wow fadeInUp" data-wow-delay="0.6s">
                     <div class="icon-box">
                        <img src="{{asset('fronted/assets/ask-img/icon/icon-how-it-work-3.svg')}}" alt="">
                     </div>
                     <div class="how-it-work-body">
                        <h3>Implement solutions</h3>
                        <p>Provide essential healthcare service and resources to communities.</p>
                     </div>
                  </div>
               </div>
               <div class="how-it-work-item">
                  <div class="how-it-work-image">
                     <figure class="image-anime reveal">
                        <img src="{{asset('fronted/assets/images/ask-3.png')}}" alt="">
                     </figure>
                  </div>
                  <div class="how-it-work-content wow fadeInUp" data-wow-delay="0.6s">
                     <div class="icon-box">
                        <img src="{{asset('fronted/assets/ask-img/icon/icon-how-it-work-4.svg')}}" alt="">
                     </div>
                     <div class="how-it-work-body">
                        <h3>Report and share</h3>
                        <p>Provide essential healthcare service and resources to communities.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- How It Work Section End -->
@if (!empty($data['blog']) && $data['blog']->count() > 0)
<div class="our-blog">
   <div class="container">
      <div class="row section-row">
         <div class="col-lg-12">
            <div class="section-title">
               <h3 class="wow fadeInUp">latest post</h3>
               <h2 class="text-anime-style-2" data-cursor="-opaque">Stories of impact and hope</h2>
               <p class="wow fadeInUp" data-wow-delay="0.2s">Explore inspiring stories and updates about our
                  initiatives, successes, and the lives we've touched. See how your support is creating real,
                  lasting change in communities worldwide.</p>
            </div>
         </div>
      </div>

      <div class="row">
         @foreach ($data['blog'] as $blog)
         <div class="col-lg-4 col-md-6">
            <div class="post-item wow fadeInUp">
               <div class="post-item-header">
                  <div class="post-item-meta">
                     <ul>
                        <li>{{ $blog->created_at->format('d M, Y') }}</li>
                     </ul>
                  </div>
                  <div class="post-item-content">
                     <h2>
                        <a href="{{ route('blog.details', $blog->slug) }}">
                           {{ $blog->title }}
                        </a>
                     </h2>
                  </div>
               </div>
               <div class="post-featured-image">
                  <a href="{{ route('blog.details', $blog->slug) }}" data-cursor-text="View">
                     <figure class="image-anime">
                        <img src="{{ asset('upload/blog/' . $blog->featured_image) }}" alt="{{ $blog->title }}">
                     </figure>
                  </a>
               </div>
               <div class="blog-item-btn">
                  <a href="{{ route('blog.details', $blog->slug) }}" class="readmore-btn">read more</a>
               </div>
            </div>
         </div>
         @endforeach
         <div class="col-lg-12">
            <div class="wow fadeInUp text-end" data-wow-delay="0.6s">
               <a href="{{ route('blog') }}" class="btn-default">View all Post</a>
            </div>
         </div>
      </div>
   </div>
</div>
@endif
@endsection
@push('scripts')

@endpush