@extends('backend.layouts.master')
@section('title','Awards Category List')
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
                <h6>Award Category</h6>
            </div>
        </div>
        <div class="page-btn">
            <a href="javascript:;" data-title="Add new Awards Category" data-size="md" data-awards-category-add="true" data-url="{{ route('manage-award-category.create') }}" class="btn btn-primary">
                <i class="ti ti-circle-plus me-1"></i>
                Create New Awards Category
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <h5>Award Category List</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <div class="display-awards-category">
                    @include('backend.pages.award-category.partials.award-category-list', ['awardCategory' => $awardCategory])
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{asset('backend/assets/js/pages/awardsCategory.js')}}"></script>

@endpush