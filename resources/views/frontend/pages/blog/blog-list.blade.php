@extends('frontend.layouts.master')
@section('title','Blog | ASK Foundation')
@section('description', 'List of Our Doctors - Ask Foundation Healthcare Services and Support Programs')
@section('main-content')
<div class="page-header parallaxie breakpoint-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque"><span>B</span>log</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-blog">
    <div class="container">
        <div class="row">
            @if(isset($blogs) && $blogs->count() > 0)
                @foreach($blogs as $index => $blog)
                <div class="col-lg-4 col-md-6">
                    <div class="post-item wow fadeInUp" @if($index> 0) data-wow-delay="{{ 0.2 * $index }}s" @endif>
                        <div class="post-item-header">
                            <div class="post-item-meta">
                                <ul>
                                    <li>{{ $blog->created_at->format('d M, Y') }}</li>
                                </ul>
                            </div>
                            <div class="post-item-content">
                                <h2><a href="{{ route('blog.details', $blog->slug) }}">{{ $blog->title }}</a></h2>
                            </div>
                        </div>
                        <div class="post-featured-image">
                            <a href="{{ route('blog.details', $blog->slug) }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    @if($blog->featured_image)
                                    <img src="{{ asset('upload/blog/' . $blog->featured_image) }}" alt="{{ $blog->title }}">
                                    @else
                                    <img src="{{ asset('images/default-blog.jpg') }}" alt="{{ $blog->title }}">
                                    @endif
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
                    {{ $blogs->links('vendor.pagination.bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
@push('scripts')

@endpush