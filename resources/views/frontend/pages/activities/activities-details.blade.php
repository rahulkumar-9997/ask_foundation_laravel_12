@php
$metaTitle = $activity->meta_title ?? $activity->title. ' | ASK Foundation';
$metaDesc = $activity->meta_description ?? $activity->short_content ?? $activity->long_content;
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
                    <h1 class="text-anime-style-2" data-cursor="-opaque">{{ $activity->title ?? $activity->short_content }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-programs activities-details">
    <div class="container">
        <div class="activities-details-box mb-3">
            <div class="row">
                <div class="col-lg-8">
                    <div class="activities-content">
                        <div class="section-title">
                            <h2 class="text-anime-style-2" data-cursor="-opaque">
                                {!! ($activity->short_content) !!}
                            </h2>
                        </div>
                        <div class="activities-long-content">
                            {!! ($activity->long_content) !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="activities-image">
                        @if($activity->main_image)
                        <figure class="image-anime">
                            <img src="{{asset('upload/activities/'.$activity->main_image)}}" alt="{{$activity->title}}" class="img-fluid w-100 border-radius">
                        </figure>
                        @elseif ($activity->page_image)
                        <figure class="image-anime">
                            <img src="{{asset('upload/activities/'.$activity->page_image)}}" alt="{{$activity->title}}" class="img-fluid w-100 border-radius">
                        </figure>
                        @else
                        <figure class="image-anime">
                            <img src="{{asset('fronted/assets/images/program-1.jpg')}}" alt="default" class="img-fluid w-100 border-radius">
                        </figure>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if($activity->videos->count() > 0)
        <div class="activities-video-section mb-3">
            <div class="row justify-content-center">
                @foreach($activity->videos as $video)
                <div class="col-lg-4 col-md-12 mb-4">
                    <div class="video-item wow fadeInUp">
                        <div class="video-body">
                            <div class="video-content">
                                @if($video->video_path)
                                <div class="video-container my-3">
                                    <video controls class="w-100 rounded shadow-sm" style="max-height: 350px;">
                                        <source src="{{ asset('upload/activities/videos/'.$video->video_path) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                @elseif($video->video_link)
                                @php
                                    $embedUrl = $video->video_link ? 'https://www.youtube.com/embed/' . $video->video_link : null;
                                @endphp
                                <div class="video-embed-container my-3">
                                    <div class="ratio ratio-16x9 rounded shadow-sm overflow-hidden">
                                        <iframe
                                            src="{{ $embedUrl }}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                </div>
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        @if($activity->images->count() > 0)
        <div class="activities-image-section mb-3">
            <div class="row gallery-items page-gallery-box activities-gallery">
                @foreach($activity->images as $image)
                    <div class="col-lg-3 col-6">
                        <div class="photo-gallery wow fadeInUp" data-wow-delay="{{ $loop->iteration * 0.2 }}s">
                            <a href="{{ asset('upload/activities/' . $image->image) }}" 
                            data-cursor-text="View" 
                            title="Activity Image {{ $loop->iteration }}">
                                <figure class="image-anime">
                                    <img src="{{ asset('upload/activities/' . $image->image) }}" 
                                        alt="Activity Image {{ $loop->iteration }}" 
                                        class="img-fluid">
                                </figure>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        @endif
    </div>
</div>
@endsection