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
<div class="page-programs activities-list">
    <div class="container">
        <div class="row">
            @if($activities->count()>0)
                @foreach($activities as $activity)
                    <div class="col-lg-4 col-md-6">
                        <div class="program-item wow fadeInUp">
                            <div class="program-image">
                                <a href="{{ route('activities.details', $activity->slug) }}">
                                    <figure class="image-anime">
                                        @if($activity->main_image)
                                            <img src="{{asset('upload/activities/'.$activity->main_image)}}" alt="{{$activity->title}}">
                                        @elseif ($activity->page_image)
                                            <img src="{{asset('upload/activities/'.$activity->page_image)}}" alt="{{$activity->title}}">
                                        @else
                                            <img src="{{asset('fronted/assets/images/program-1.jpg')}}" alt="">
                                        @endif
                                    </figure>
                                </a>
                            </div>
                            <div class="program-body">
                                <div class="program-content">
                                    <h3><a href="{{ route('activities.details', $activity->slug) }}">{{ $activity->title }}</a></h3>
                                    @if(!empty($activity->short_content))
                                        <p>
                                            {!! (Str::limit(strip_tags($activity->short_content), 200)) !!}
                                        </p>
                                    @else
                                        <p>
                                            {!! (Str::limit(strip_tags($activity->long_content), 200)) !!}
                                        </p>
                                    @endif
                                </div>
                                <div class="program-button">
                                    <a href="{{ route('activities.details', $activity->slug) }}" class="readmore-btn">
                                        Read More
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-12">
                    {{ $activities->links('vendor.pagination.bootstrap-4') }}
                </div>
            @endif
        </div>  
        <div class="activities-video-section">      
            <div class="row">

            </div>
        </div>
        <div class="activities-image-section">      
            <div class="row">

            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

@endpush