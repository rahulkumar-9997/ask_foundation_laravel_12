@extends('frontend.layouts.master')
@section('title','ASK Foundation | Bone Health, Road Safety & Medical Awareness NGO')
@section('description', 'ASK Foundation is a nonprofit organization promoting bone health, preventive medicine, road safety programs, and medical education for healthier communities.')
@section('main-content')
@if (!empty($data['bannerVideo']) && $data['bannerVideo']->count() > 0)
<div class="hero hero-video">
   <div class="hero-bg-video">
      <video autoplay muted loop playsinline
         id="myVideo"
         preload="none"
         class="desktopvideo"
         width="1920"
         height="844"
         >
         <source data-src="{{ asset('upload/banner/' . $data['bannerVideo']->desktop_video_url) }}" type="video/mp4">
      </video>
      <video autoplay muted loop playsinline id="myVideo" class="mobilevideo"         
         preload="none"
         poster="{{ asset('fronted/assets/images/hero-bg.jpg') }}"
         width="721"
         height="317">
         <source data-src="{{ asset('upload/banner/' . $data['bannerVideo']->mobile_video_url) }}" type="video/mp4">
      </video>
      <div class="video-overlay formobile-overlay"></div>
   </div>
   <div class="container container-for-mobile">
      <div class="row align-items-center">
         <div class="col-lg-8">
            <div class="hero-content">
               <div class="section-title banner-section-title">
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
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endif
@php
$bgColors = ['#ffff', '#ffff', '#ffff'];
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
                  <div class="col-lg-4 mb-3">
                     <div class="feature-item" style="background-color: {{ $bgColors[$colorIndex % count($bgColors)] }};">
                        <a href="#">
                           <div class="banner-feature fun-facts-box-item d-flex align-items-center gap-3">
                              @if(isset($feature['icon']) && !empty($feature['icon']))
                              <div class="feature-img-box">
                                 <figure class="mb-0 d-inline-block">
                                    <img src="{{ asset('upload/banner/features/' . $feature['icon']) }}" alt="{{ $feature['feature'] }}" class="feature-icon img-fluid" loading="lazy">
                                 </figure>
                              </div>
                              @endif
                              <div class="feature-text">
                                 <h2>
                                    {{ $feature['feature'] }}
                                 </h2>
                              </div>
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
                     <img src="{{asset('fronted/assets/ask-img/about-home/ask-foundation.jpg')}}" alt="ask foundation" loading="lazy">
                  </figure>
               </div>
               <!-- <div class="about-img-2">
                  <figure class="image-anime">
                     <img src="{{asset('fronted/assets/ask-img/about-home/dr-anne.jpg')}}" alt="ask foundation" loading="lazy">
                  </figure>
               </div> -->
               <!--div class="need-fund-box">
                  <img src="{{asset('fronted/assets/ask-img/icon/icon-funded-dollar.svg')}}" alt="ask foundation" loading="lazy">
                  <p>Promoting early detection and prevention of bone diseases.</p>
               </div-->
            </div>
         </div>

         <div class="col-lg-6">
            <div class="about-us-content home-about-us-page">
               <div class="section-title">
                  <h2 class="text-anime-style-2 empowerh2" data-cursor="-opaque">
                     <span class="spanabou"> ASK Foundation </span>
                  </h2>
                  <h3 class="text-anime-style-2 empowerh3" data-cursor="-opaque">
                     <span class="spanabou"> Care Today, Stronger Tomorrow</span>
                  </h3>
                  <h4 class="text-anime-style-2 empowerh4">Empowering Lives Through Preventive Care</h4>
               </div>
               <p class="wow fadeInUp aboutP" data-wow-delay="0.2s">
                  Founded by Dr. Sai Laxman Anne, Chief Consultant Orthopaedic and Joint Replacement Surgeon, the ASK Foundation is dedicated to preventive healthcare and community welfare. Named in honor of his mother, it reflects his commitment to awareness, education, and compassion.
               </p>
               <div class="section-title">
                  <h3 class="home-lives">Creating Healthier, Safer Communities</h3>
               </div>
               <p class="wow fadeInUp aboutP" data-wow-delay="0.2s">
                  The foundation conducts health camps, wellness drives, and awareness programs on bone health, road safety, and lifestyle diseases, while also supporting underprivileged orthopedic patients. With transparency and inclusivity, ASK Foundation welcomes doctors, professionals, students, and volunteers to help build healthier communities.
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
                  <a href="{{ route('focus.bone') }}" class="learn-more-btn">Learn More</a>
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
                  <a href="{{ route('focus.road') }}" class="learn-more-btn">Learn More</a>
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
                  <!--h3 class="wow fadeInUp">About Our Founder</h3-->
                  <h2 class="text-anime-style-2 mb-3 sai-laxam" data-cursor="-opaque">
                     Dr. Sai Laxman Anne: A Vision for Preventive Healthcare
                  </h2>
               </div>
               <div class="what-we-list">
                  <div class="what-we-item wow fadeInUp" data-wow-delay="0.2s">
                     <div class="icon-box">
                        <img src="{{asset('fronted/assets/ask-img/about-our-founder/preventive-healthcare.svg')}}" alt="A Vision for Preventive Healthcare" loading="lazy">
                     </div>
                     <div class="what-we-item-content">
                        <h5>A Vision for Preventive Healthcare</h5>
                        <p>
                           Dr. Sai Laxman Anne, a leading Orthopaedic and Joint Replacement Surgeon, founded ASK Foundation with the mission to go beyond treatment and focus on prevention, awareness, and community well-being.
                        </p>
                     </div>
                  </div>
                  <div class="what-we-item wow fadeInUp" data-wow-delay="0.4s">
                     <div class="icon-box">
                        <img src="{{asset('fronted/assets/ask-img/about-our-founder/orthopaedic-excellence.svg')}}" alt="Orthopaedic Excellence" loading="lazy">
                     </div>
                     <div class="what-we-item-content">
                        <h5>Orthopaedic Excellence</h5>
                        <p>With over 5,000 successful joint replacements and advanced training from India, the UK, and Johns Hopkins University, Dr. Anne brings unmatched expertise in bone and joint health.</p>
                     </div>
                  </div>
                  <div class="what-we-item wow fadeInUp" data-wow-delay="0.6s">
                     <div class="icon-box">
                        <img src="{{asset('fronted/assets/ask-img/about-our-founder/commitment-to-society.svg')}}" alt="Commitment to Society" loading="lazy">
                     </div>
                     <div class="what-we-item-content">
                        <h5>Commitment to Society</h5>
                        <p>Deeply inspired by his mother, Anne Santha Kumari, he has dedicated his career to giving back through free health camps, road safety initiatives, and support for underprivileged patients in need of orthopaedic care.</p>
                     </div>
                  </div>
                  <div class="what-we-item wow fadeInUp" data-wow-delay="0.6s">
                     <div class="icon-box">
                        <img src="{{asset('fronted/assets/ask-img/about-our-founder/educator-and-mentor.svg')}}" alt="Educator & Mentor" loading="lazy">
                     </div>
                     <div class="what-we-item-content">
                        <h5>Educator & Mentor</h5>
                        <p>As National Faculty at leading medical institutes, Dr. Anne shares his knowledge with young surgeons and inspires the next generation to combine skill with compassion.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="what-we-do-images">
               <div class="what-we-do-img-1">
                  <figure class="image-anime reveal">
                     <img src="{{asset('fronted/assets/ask-img/4.jpg')}}" alt="ask foundation" loading="lazy">
                  </figure>
               </div>
               <div class="what-we-do-img-2">
                  <figure class="image-anime">
                     <img src="{{asset('fronted/assets/images/founder-intro.png')}}" alt="ask foundation" loading="lazy">
                  </figure>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="our-program about-ask-foundation-section">
   <div class="container">
      <div class="row section-row align-items-center">
         <div class="col-lg-12">
            <div class="section-title">
               <h6 class="wow fadeInUp">Some Facts of our Society</h6>
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
<div class="why-choose-us">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-lg-5">
            <div class="why-choose-images">
               <div class="why-choose-image-1">
                  <figure class="image-anime">
                     <img src="{{asset('fronted/assets/images/why-choose-img-1.jpg')}}" alt="ask foundation" loading="lazy">
                  </figure>
               </div>
               <div class="why-choose-image-2">
                  <figure class="image-anime">
                     <img src="{{asset('fronted/assets/images/team-1.jpg')}}" alt="ask foundation" loading="lazy">
                  </figure>
               </div>
            </div>
         </div>

         <div class="col-lg-7">
            <div class="why-choose-content">
               <div class="section-title">
                  <h3 class="wow fadeInUp">Why choose ASK Foundation</h3>
                  <h2 class="text-anime-style-2" data-cursor="-opaque">
                     Building Stronger Bones & Safer Roads
                  </h2>
               </div>
               <p class="wow fadeInUp" data-wow-delay="0.2s">
                  ASK Foundation is dedicated to creating awareness about bone health, preventing
                  osteoporosis and osteoarthritis, and promoting road traffic safety to build healthier,
                  safer communities.
               </p>
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
               <div class="about-btn wow fadeInUp mt-5" data-wow-delay="0.6s">
                  <a href="{{ route('donate-us')}}" class="btn-default">Donate</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Scrolling Ticker Start -->
<div class="scrolling-ticker mb-3">
   <div class="scrolling-ticker-box">
      <div class="scrolling-content">
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" loading="lazy" alt="ask foundation">Bone Health and Orthopedics</span>
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" loading="lazy" alt="ask foundation">Road safety programs</span>
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" loading="lazy" alt="ask foundation">Preventive Medicine and Medical Camps</span>
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" loading="lazy" alt="ask foundation">Bone Health and Orthopedics</span>
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" loading="lazy" alt="ask foundation">Road safety programs</span>
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" loading="lazy" alt="ask foundation">Preventive Medicine and Medical Camps</span>
      </div>

      <div class="scrolling-content">
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" loading="lazy" alt="ask foundation">Bone Health and Orthopedics</span>
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" loading="lazy" alt="ask foundation">Road safety programs</span>
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" loading="lazy" alt="ask foundation">Preventive Medicine and Medical Camps</span>
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" loading="lazy" alt="ask foundation">Bone Health and Orthopedics</span>
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" loading="lazy" alt="ask foundation">Road safety programs</span>
         <span><img src="{{asset('fronted/assets/ask-img/icon/icon-asterisk.svg')}}" loading="lazy" alt="ask foundation">Preventive Medicine and Medical Camps</span>
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
         <div class="col-lg-3 col-md-6 col-6">
            <div class="number-tell-story-card">
               <div class="tell-story-content">
                  <div class="number-tell-story-stat story-color1">50%</div>
                  <div class="number-tell-story-title">Fracture Risk</div>
                  <div class="number-tell-story-description">For women over 50</div>
               </div>
            </div>
         </div>
         <div class="col-lg-3 col-md-6 col-6">
            <div class="number-tell-story-card">
               <div class="tell-story-content">
                  <div class="number-tell-story-stat story-color2">54M</div>
                  <div class="number-tell-story-title">Americans</div>
                  <div class="number-tell-story-description">With osteoarthritis</div>
               </div>
            </div>
         </div>
         <div class="col-lg-3 col-md-6 col-6">
            <div class="number-tell-story-card">
               <div class="tell-story-content">
                  <div class="number-tell-story-stat story-color3">200M</div>
                  <div class="number-tell-story-title">Women Worldwide</div>
                  <div class="number-tell-story-description">Affected by osteoporosis</div>
               </div>
            </div>
         </div>
         <div class="col-lg-3 col-md-6 col-6">
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
               <h3 class="wow fadeInUp">How ASK Foundation works</h3>
               <h2 class="text-anime-style-2" data-cursor="-opaque">Step by step working process</h2>
               <p class="wow fadeInUp" data-wow-delay="0.2s">Our approach ensures lasting impact—identifying real needs, designing practical solutions, and creating healthier communities.
               </p>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-lg-12">
            <div class="how-it-work-list">
               <div class="how-it-work-item">
                  <div class="how-it-work-image">
                     <figure class="image-anime reveal">
                        <img src="{{asset('fronted/assets/images/ask-1-old.png')}}" alt="ask foundation" loading="lazy">
                     </figure>
                  </div>
                  <div class="how-it-work-content wow fadeInUp" data-wow-delay="0.4s">
                     <div class="icon-box">
                        <img src="{{asset('fronted/assets/ask-img/icon/icon-how-it-work-1.svg')}}" alt="ask foundation" loading="lazy">
                     </div>
                     <div class="how-it-work-body">
                        <h3>Identify Health Priorities</h3>
                        <p>We begin by listening to people and understanding the health concerns that affect their daily lives</p>
                     </div>
                  </div>
               </div>
               <div class="how-it-work-item">
                  <div class="how-it-work-image">
                     <figure class="image-anime reveal">
                        <img src="{{asset('fronted/assets/images/ask-a.png')}}" alt="ask foundation" loading="lazy">
                     </figure>
                  </div>
                  <div class="how-it-work-content wow fadeInUp" data-wow-delay="0.4s">
                     <div class="icon-box">
                        <img src="{{asset('fronted/assets/ask-img/icon/icon-how-it-work-2.svg')}}" alt="ask foundation" loading="lazy">
                     </div>
                     <div class="how-it-work-body">
                        <h3>Design Community Programs</h3>
                        <p>Customized medical camps, awareness drives, and preventive health initiatives are developed for each community.</p>
                     </div>
                  </div>
               </div>
               <div class="how-it-work-item">
                  <div class="how-it-work-image">
                     <figure class="image-anime reveal">
                        <img src="{{asset('fronted/assets/images/ask-b.png')}}" alt="ask foundation" loading="lazy">
                     </figure>
                  </div>
                  <div class="how-it-work-content wow fadeInUp" data-wow-delay="0.6s">
                     <div class="icon-box">
                        <img src="{{asset('fronted/assets/ask-img/icon/icon-how-it-work-3.svg')}}" alt="ask foundation" loading="lazy">
                     </div>
                     <div class="how-it-work-body">
                        <h3>Deliver Care and Awareness</h3>
                        <p>Our team of doctors, volunteers, and partners provide on-ground medical support and spread health education.</p>
                     </div>
                  </div>
               </div>
               <div class="how-it-work-item">
                  <div class="how-it-work-image">
                     <figure class="image-anime reveal">
                        <img src="{{asset('fronted/assets/images/ask-3-old.png')}}" alt="ask foundation" loading="lazy">
                     </figure>
                  </div>
                  <div class="how-it-work-content wow fadeInUp" data-wow-delay="0.6s">
                     <div class="icon-box">
                        <img src="{{asset('fronted/assets/ask-img/icon/icon-how-it-work-4.svg')}}" alt="ask foundation" loading="lazy">
                     </div>
                     <div class="how-it-work-body">
                        <h3>Ensure Sustainable Impact</h3>
                        <p>We follow up with guidance, resources, and partnerships so that communities continue to benefit long-term.</p>
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
               <h3 class="wow fadeInUp">Blogs about Bone Care & Ostoeporosis Prevention</h3>
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
                  <!--div class="post-item-meta">
                     <ul>
                        <li>{{ $blog->created_at->format('d M, Y') }}</li>
                     </ul>
                  </div-->
                  <div class="post-item-content">
                     <h6>
                        <a href="{{ route('blog.details', $blog->slug) }}">
                           {{ $blog->title }}
                        </a>
                     </h6>
                  </div>
               </div>
               <div class="post-featured-image">
                  <a href="{{ route('blog.details', $blog->slug) }}" data-cursor-text="View">
                     <figure class="image-anime">
                        <img src="{{ asset('upload/blog/' . $blog->featured_image) }}" alt="{{ $blog->title }}" loading="lazy">
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
<script>
   /*document.addEventListener("DOMContentLoaded", function() {
      let isMobile = window.innerWidth <= 768;
      let video = document.querySelector(isMobile ? ".mobilevideo" : ".desktopvideo");
      if (video) {
         let observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
               if (entry.isIntersecting) {
                  let source = document.createElement("source");
                  source.src = video.getAttribute("data-src");
                  source.type = "video/mp4";
                  video.appendChild(source);
                  video.load();

                  video.play().then(() => {
                     let placeholder = video.parentElement.querySelector(".video-placeholder");
                     if (placeholder) {
                        placeholder.classList.add("hide");
                     }
                  }).catch(() => {
                     console.log("Autoplay blocked");
                  });

                  obs.unobserve(video);
               }
            });
         }, {
            threshold: 0.2
         });

         observer.observe(video);
      }
   });
   */
  document.addEventListener("DOMContentLoaded", function () {
   const width = window.innerWidth;
   let video;
   if (width <= 767) {
      video = document.querySelector(".mobilevideo");
   } else {
      video = document.querySelector(".desktopvideo");
   }
   if (!video) return;
   const source = video.querySelector("source");
   const loadVideo = () => {
      if (source && source.dataset.src) {
         source.src = source.dataset.src;
         video.load();

         video.play().catch(() => {
            console.log("Autoplay prevented by browser");
         });
      }
   };
   if ("IntersectionObserver" in window) {
      const observer = new IntersectionObserver((entries, obs) => {
         entries.forEach(entry => {
            if (entry.isIntersecting) {
               loadVideo();
               obs.unobserve(video);
            }
         });
      }, {
         threshold: 0.25
      });
      observer.observe(video);
   } else {
      loadVideo();
   }

});
</script>
@endpush