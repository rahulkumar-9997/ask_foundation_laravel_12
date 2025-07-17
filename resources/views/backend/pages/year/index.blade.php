@extends('backend.layouts.master')
@section('title','Year List')
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
                <h6>Manage Year</h6>
            </div>
        </div>
        <div class="page-btn">
            <a href="javascript:;" data-title="Add new Year" data-size="md" data-year-add="true" data-url="{{ route('manage-year.create') }}" class="btn btn-primary">
                <i class="ti ti-circle-plus me-1"></i>
                Create New Year
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <h5>Years List</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <div class="display-years">
                    @include('backend.pages.year.partials.year-list', ['years' => $years])
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{asset('backend/assets/js/pages/year.js')}}"></script>
@endpush