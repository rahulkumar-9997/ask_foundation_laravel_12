@extends('frontend.layouts.master')
@section('title','Our Activities | ASK Foundation')
@section('description', 'List of Our Doctors - Ask Foundation Healthcare Services and Support Programs')
@section('main-content')
<div class="page-header parallaxie breakpoint-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque"><span>Our</span> Activities</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-programs">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="program-item wow fadeInUp">
                    <div class="program-image">
                        <a href="#" data-cursor-text="View">
                            <figure class="image-anime">
                                <img src="{{asset('fronted/assets/images/program-1.jpg')}}" alt="">
                            </figure>
                        </a>
                    </div>
                    <div class="program-body">
                        <div class="program-content">
                            <h3><a href="program-single.html">Women's empowerment</a></h3>
                            <p>Providing resources, education, and advocacy for women's rights.</p>
                        </div>
                        <div class="program-button">
                            <a href="program-single.html" class="readmore-btn">read more</a>
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