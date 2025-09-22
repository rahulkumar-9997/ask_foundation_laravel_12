@extends('frontend.layouts.master')
@section('title','About us | ASK Foundation')
<!-- @section('description', 'List of Our Doctors - Ask Foundation Healthcare Services and Support Programs') -->
@section('main-content')
<div class="page-header parallaxie breakpoint-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque">
                        <span>About</span>
                        Us
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
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
                        <img src="{{asset('fronted/assets/images/ask-1-old.png')}}" alt="" loading="lazy">
                     </figure>
                  </div>
                  <div class="how-it-work-content wow fadeInUp" data-wow-delay="0.4s">
                     <div class="icon-box">
                        <img src="{{asset('fronted/assets/ask-img/icon/icon-how-it-work-1.svg')}}" alt="" loading="lazy">
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
                        <img src="{{asset('fronted/assets/images/ask-a.png')}}" alt="" loading="lazy">
                     </figure>
                  </div>
                  <div class="how-it-work-content wow fadeInUp" data-wow-delay="0.4s">
                     <div class="icon-box">
                        <img src="{{asset('fronted/assets/ask-img/icon/icon-how-it-work-2.svg')}}" alt="" loading="lazy">
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
                        <img src="{{asset('fronted/assets/images/ask-b.png')}}" alt="" loading="lazy">
                     </figure>
                  </div>
                  <div class="how-it-work-content wow fadeInUp" data-wow-delay="0.6s">
                     <div class="icon-box">
                        <img src="{{asset('fronted/assets/ask-img/icon/icon-how-it-work-3.svg')}}" alt="" loading="lazy">
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
                        <img src="{{asset('fronted/assets/images/ask-3-old.png')}}" alt="" loading="lazy">
                     </figure>
                  </div>
                  <div class="how-it-work-content wow fadeInUp" data-wow-delay="0.6s">
                     <div class="icon-box">
                        <img src="{{asset('fronted/assets/ask-img/icon/icon-how-it-work-4.svg')}}" alt="" loading="lazy">
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
<div class="why-choose-us">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-lg-5">
            <div class="why-choose-images">
               <div class="why-choose-image-1">
                  <figure class="image-anime">
                     <img src="{{asset('fronted/assets/images/why-choose-img-1.jpg')}}" alt="" loading="lazy">
                  </figure>
               </div>
               <div class="why-choose-image-2">
                  <figure class="image-anime">
                     <img src="{{asset('fronted/assets/images/team-1.jpg')}}" alt="" loading="lazy">
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
@endsection
@push('scripts')

@endpush