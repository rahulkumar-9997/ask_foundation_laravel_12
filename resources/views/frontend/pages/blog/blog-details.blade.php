@php
$metaTitle = $blog->meta_title ?? $blog->title. ' | ASK Foundation';
$metaDesc = $blog->meta_description ?? $blog->short_desc ?? $blog->content;
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
                    <h1 class="text-anime-style-2" data-cursor="-opaque"><span>B</span>log</h1>
                    <p>{{ $blog->title ?? $blog->short_desc }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-single-post">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="post-content">
                    @if($blog->featured_image)
                    <div class="post-image">
                        <figure class="image-anime reveal">
                            <img src="{{ asset('upload/blog/' . $blog->featured_image) }}"
                                alt="{{ $blog->title }}">
                        </figure>
                    </div>
                    @endif
                    @if($blog->short_desc)
                    <div class="blog-short-content">
                        <h6 class="short-title">
                            {{ $blog->short_desc }}
                        </h6>
                    </div>
                    @endif
                    <div class="post-entry blog-detail-entry">
                        <div class="blog-de-content">
                            {!! clean_html_content($blog->content) !!}
                        </div>
                        @if($blog->paragraphs && $blog->paragraphs->count() > 0)
                        <div class="blog-paragraph mt-4">
                            <div class="row blog-par-row">
                                <div class="col-lg-12">
                                    @foreach ($blog->paragraphs as $index => $paragraph)
                                    <div class="blog-paragraphs mb-4">
                                        <div class="row align-items-center">
                                            <div class="{{ $paragraph->image ? 'col-lg-8' : 'col-lg-12' }}">
                                                <div class="p-title">
                                                    <h5>
                                                        {{ $paragraph->title }}
                                                    </h5>
                                                </div>
                                                <div class="paragraphs-text">
                                                    {!! clean_html_content($paragraph->content) !!}
                                                </div>
                                            </div>
                                            @if($paragraph->image)
                                            <div class="col-lg-4">
                                                <div class="photo-gallery wow fadeInUp blog-p-img">
                                                    <a href="{{ asset('upload/blog/' . $paragraph->image) }}" data-cursor-text="View">
                                                        <figure class="para-img-se">
                                                            <img src="{{ asset('upload/blog/' . $paragraph->image) }}"
                                                                alt="{{ $paragraph->alt_text ?? $paragraph->title ?? 'Blog image' }}"
                                                                class="img-fluid">
                                                        </figure>
                                                    </a>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($blog->images && $blog->images->count() > 0)
                        <div class="blog-images-section mt-4">
                            <div class="row gallery-items page-gallery-box">
                                @foreach($blog->images as $index => $image)
                                <div class="col-lg-3 col-6">
                                    <div class="photo-gallery wow fadeInUp" @if($index> 0) data-wow-delay="{{ 0.2 * $index }}s" @endif>
                                        <a href="{{ asset('upload/blog/' . $image->image) }}" data-cursor-text="View">
                                            <figure class="image-anime">
                                                <img src="{{ asset('upload/blog/' . $image->image) }}" alt="{{ $image->alt_text }}">
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
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')

@endpush