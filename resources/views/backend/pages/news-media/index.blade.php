@extends('backend.layouts.master')
@section('title','News and Media')
@push('styles')
<link rel="stylesheet" href="{{asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/plugins/tabler-icons/tabler-icons.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/css/dataTables.bootstrap5.min.css')}}">
@endpush
@section('main-content')
<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold"></h4>
                <h6>News and Media</h6>
            </div>
        </div>
        <div class="page-btn">
            <a href="javascript:;" data-title="Add new News and Media Category" data-size="md" data-news-media-category-add="true" data-url="{{ route('manage-news-media-category.create') }}" class="btn btn-primary">
                <i class="ti ti-circle-plus me-1"></i>
                Create News and Media
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <h5>News and Media</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <div class="display-newsmedia-category">
                    @if(isset($newsMediaCategories) && $newsMediaCategories->count() > 0)
                        @include('backend.pages.new-media-category.partials.news-media-category-list', ['newsMediaCategories' => $newsMediaCategories])
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{asset('backend/assets/js/pages/newAndMediaCategory.js')}}"></script>

@endpush