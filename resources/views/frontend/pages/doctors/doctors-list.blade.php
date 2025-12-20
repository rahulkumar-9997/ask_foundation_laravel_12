@extends('frontend.layouts.master')
@section('title','Our Doctors | Expert Medical Team at ASK Foundation')
@section('description', 'Meet the experienced doctors and medical experts at ASK Foundation dedicated to bone health, preventive medicine, education, and community care.')
@section('main-content')
<div class="page-header parallaxie breakpoint-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque"><span>Our</span> Doctors</h1>
                    <p>Meet our dedicated Doctors of healthcare professionals committed to providing exceptional care and support.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-team">
    <div class="container">
        <div class="row">
            @if(isset($doctors) && $doctors->count() > 0)
                @foreach($doctors as $doctor)
                <div class="col-lg-4 col-md-6">
                    <div class="team-item wow fadeInUp">
                        <div class="team-image">
                            <a href="{{ route('doctor.details', $doctor->slug) }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    @if($doctor->image)
                                    <img src="{{ asset('upload/doctors/' . $doctor->image) }}" alt="{{ $doctor->doctor_name }}">
                                    @else
                                    <img src="{{ asset('fronted/assets/ask-img/doctor2.svg') }}" alt="{{ $doctor->doctor_name }}">
                                    @endif
                                </figure>
                            </a>
                        </div>
                        <div class="team-content">
                            <h2><a href="{{ route('doctor.details', $doctor->slug) }}">{{ $doctor->doctor_name }}</a></h2>
                            <h3>{{ $doctor->department }}</h3>
                            @if($doctor->experience || $doctor->work_location)
                            <p>
                                @if($doctor->experience)
                                Experience: {{ $doctor->experience }}<br>
                                @endif
                            </p>
                            @endif
                        </div>
                        <!--<div class="team-social-icon">
                            <ul>
                                <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>-->
                    </div>
                </div>
                @endforeach
                <div class="col-lg-12">
                    {{ $doctors->links('vendor.pagination.bootstrap-4') }}
                </div>
            @else
                <div class="col-12">
                    <p class="text-center">No doctors found.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
@push('scripts')

@endpush