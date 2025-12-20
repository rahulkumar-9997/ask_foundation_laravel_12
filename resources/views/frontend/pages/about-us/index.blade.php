@extends('frontend.layouts.master')
@section('title','About ASK Foundation | Healthcare & Awareness NGO in India')
@section('description', 'Learn about ASK Foundation, our mission, vision, and commitment to improving bone health, preventive care, road safety awareness, and medical education.')
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
<div class="our-approach about-us-page">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-lg-12">
            <div class="our-approach-box-content">
               <div class="our-approach-content">
                  <div class="section-title">
                     <h2 class="text-anime-style-2" data-cursor="-opaque">
                        Who We Are ?
                     </h2>
                  </div>
                  <p class="wow fadeInUp" data-wow-delay="0.2s">
                     ASK Foundation was founded by Dr. Sai Laxman Anne, a highly accomplished Chief Consultant Orthopaedic and Joint Replacement Surgeon, with the purpose of giving back to society in a meaningful and impactful way. Inspired by his mother, the foundation carries forward his vision of creating healthier, safer communities through preventive healthcare and social awareness. Over the years, Dr. Anne has witnessed countless trauma cases and lifestyle-related health conditions that could have been avoided with timely education and preventive action. This realization shaped the philosophy of ASK Foundation—to go beyond treatment and create a platform that focuses on awareness, prevention, and long-term community well-being.
                  </p>
               </div>
               <div class="our-approach-image">
                  <figure class="image-anime">
                     <img src="{{asset('fronted/assets/ask-img/bng-2.jpg')}}" alt="about" loading="lazy">
                  </figure>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<section class="pt-0 pb-4">
   <div class="pd_top_30"></div>
   <div class="container">
      <div class="row m-0 bg-magenta1 vision-mission-card mb-4 align-items-center">
         <div class="col-sm-2 col-4">
            <img src="{{ asset('fronted/assets/ask-img/about-us/why-we-exit.svg') }}"
               alt="why we exist"
               class="img-fluid"
               loading="lazy">
         </div>
         <div class="col-lg-3 col-sm-4 col-8">
            <h3 class="text-white">Why We Exist ?</h3>
         </div>
         <div class="col-lg-7 col-sm-6 mt-sm-0 mt-3">
            <p class="text-white pe-sm-1">
               India is facing a dual challenge: on one hand, road traffic accidents claim hundreds of lives every day, and on the other, chronic health conditions such as osteoporosis, diabetes, hypertension, and obesity continue to rise sharply. In 2022 alone, over 4.6 lakh road accidents were reported, leading to more than 1.68 lakh deaths—mostly among young men in their most productive years, leaving families devastated. Similarly, more than 60 million Indians are affected by osteoporosis, while diabetes and hypertension are spreading at an alarming pace across urban and rural populations alike. These are not just numbers; they represent lives, families, and futures at risk. ASK Foundation exists to address these urgent concerns by spreading awareness, encouraging preventive practices, and equipping individuals and families with the knowledge to protect their health and well-being.
            </p>
         </div>
      </div>
      <div class="row m-0 bg-magenta2 vision-mission-card mb-4 align-items-center">
         <div class="col-sm-2 col-4">
            <img src="{{asset('fronted/assets/ask-img/about-us/what-we-do.svg')}}" alt="what we do" class="img-fluid" loading="lazy">
         </div>
         <div class="col-lg-3 col-sm-4 col-8">
            <h3 class="text-white">What We Do ?</h3>
         </div>
         <div class="col-lg-7 col-sm-7 mt-sm-0 mt-3">
            <p class="text-white pe-sm-1">
               The foundation is committed to taking healthcare awareness and preventive action to the grassroots level. Through regular health camps, wellness initiatives, and school and college outreach programs, ASK Foundation educates people about bone health, joint care, and lifestyle diseases. Road safety awareness campaigns are conducted to instill safe practices among children and young adults, helping to reduce preventable accidents. Preventive screenings for diabetes, hypertension, and other non-communicable diseases are organized to identify risks early and guide timely intervention. In addition, the foundation provides support to underprivileged orthopedic patients, ensuring that access to essential care is not limited by financial barriers. Every initiative is designed with inclusivity in mind, reaching people across diverse backgrounds and empowering them to take charge of their health.
            </p>
         </div>
      </div>
      <div class="row m-0 bg-magenta3 vision-mission-card align-items-center">
         <div class="col-sm-2 col-4">
            <img src="{{asset('fronted/assets/ask-img/about-us/our-approach.svg')}}" alt="what we do" class="img-fluid" loading="lazy">
         </div>
         <div class="col-lg-3 col-sm-4 col-8">
            <h3 class="text-white">Our Approach</h3>
         </div>
         <div class="col-lg-7 col-sm-7 mt-sm-0 mt-3">
            <p class="text-white pe-sm-1">
               At ASK Foundation, we believe that prevention is always better than cure. Our approach is built on four strong pillars: awareness, education, prevention, and support. By bringing healthcare knowledge directly to communities, we empower individuals to make informed decisions that can save lives and improve long-term health. Collaboration is at the heart of our work—we actively invite doctors, students, professionals, and volunteers to contribute their time, skills, or resources in building safer and healthier communities. With transparency, compassion, and inclusivity guiding every step, ASK Foundation is more than just an initiative—it is a movement towards reducing preventable health risks and creating resilience at the grassroots level. Together, we can build a future where communities are not only healthier but also stronger and better prepared for tomorrow.
            </p>
         </div>
      </div>
   </div>
   <div class="pd_top_30"></div>

</section>
@endsection
@push('scripts')

@endpush