@php
$metaTitle = $doctor->doctor_name . ' | ASK Foundation';
$metaDesc = $doctor->short_content ?? $doctor->content;
$metaDescription = \Illuminate\Support\Str::limit(strip_tags($metaDesc), 160);
@endphp

@extends('frontend.layouts.master')
@section('title', $metaTitle)
@section('description', $metaDescription)
@section('main-content')
<div class="page-header parallaxie breakpoint-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque"><span>Our</span> Doctors</h1>
                    <p>{{ $doctor->doctor_name }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Service Single Start -->
    <div class="page-service-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <!-- Page Single Sidebar Start -->
                    <div class="page-single-sidebar">
                        <!-- Page Sidebar Category List Start -->
                        <div class="page-sidebar-catagery-list wow fadeInUp">
                            <h3>services category</h3>
                            <ul>
                                <li><a href="#">food security initiatives</a></li>
                                <li><a href="#">healthcare access</a></li>
                                <li><a href="#">educational support</a></li>
                                <li><a href="#">women empowerment</a></li>
                                <li><a href="#">youth leadership programs</a></li>
                            </ul>
                        </div>
                        <!-- Page Sidebar Category List End -->

                        <!-- Sidebar CTA Box Start -->
                        <div class="sidebar-cta-box wow fadeInUp" data-wow-delay="0.2s">
                            <!-- Cta Content Start -->
                            <div class="icon-box">
                                <img src="images/icon-cta.svg" alt="">
                            </div>
                            
                            <!-- Sidebar CTA Content Start -->
                            <div class="sidebar-cta-content">
                                <p>small gifts, big changes</p>
                                <h3>empowering every child through education</h3>
                            </div>
                            <!-- Sidebar CTA Content End -->
                            
                            <!-- Sidebar CTA Button Start -->
                            <div class="sidebar-cta-btn">
                                <a href="contact.html" class="btn-default">Get a quote</a>
                            </div>
                            <!-- Sidebar CTA Button End -->
                        </div>
                        <!-- Sidebar CTA Box End -->
                    </div>
                    <!-- Page Single Sidebar End -->
                </div>
                <div class="col-lg-8">
                    <div class="service-single-contemt">
                        <div class="doctort_name_area">
                            @if($doctor->doctor_name)
                                <h1 class="doctor-name wow fadeInUp">
                                    {{ $doctor->doctor_name }}
                                    @if($doctor->experience)
                                        ({{ $doctor->experience }})
                                    @endif
                                </h1>
                            @endif
                            @if($doctor->department)
                                <h3 class="doctor_department wow fadeInUp">
                                    {{ $doctor->department }}
                                </h3>
                            @endif
                            @if($doctor->work_location)
                                <h4 class="doctor_work_location wow fadeInUp">
                                    {{ $doctor->work_location }}
                                </h4>
                            @endif
                        </div>
                        @if($doctor->image)
                            <div class="service-feature-image mt-3">
                                <figure class="image-anime reveal">
                                    <img src="{{ asset('upload/doctors/' . $doctor->image) }}" alt="{{ $doctor->doctor_name }}">
                                </figure>
                            </div>
                        @endif
                        <div class="service-entry">
                            @if($doctor->short_content)
                                <p>
                                    {{ $doctor->short_content }}
                                </p>
                            @endif
                            <div class="doctors-details-section">
                                <div class="doctors-details-content">
                                    {!! $doctor->content !!}
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

@endpush