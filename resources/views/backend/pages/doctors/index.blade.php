@extends('backend.layouts.master')
@section('title','Doctors List')
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
                <h6>Doctors List</h6>
            </div>
        </div>
        <div class="page-btn">
            <a href="{{ route('manage-doctors.create') }}" class="btn btn-primary">
                <i class="ti ti-circle-plus me-1"></i>
                Add New Doctors
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                @if(isset($doctors) && $doctors->count() > 0)
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>Doctor Name</th>
                            <th>Department</th>
                            <th>Experience</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($doctors->count() > 0)
                        @foreach($doctors as $doctor)
                        <tr>
                            <td>{{ $doctor->doctor_name }}</td>
                            <td>{{ $doctor->department }}</td>
                            <td>{{ $doctor->experience ?? 'N/A' }}</td>
                            <td>
                                @if($doctor->status == 1)
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                @if($doctor->image)
                                <img src="{{ asset('upload/doctors/' . $doctor->image) }}" alt="Doctor Image" width="100">
                                @else
                                <span class="badge bg-secondary">No Image</span>
                                @endif
                            </td>
                            <td class="action-table-data">
                                <div class="edit-delete-action">
                                    <a class="btn btn-sm btn-primary me-2 p-2" href="{{ route('manage-doctors.edit', $doctor->id) }}">
                                        <i data-feather="edit" class="feather-edit"></i>
                                    </a>
                                    <form action="{{ route('manage-doctors.destroy', $doctor->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger show_confirm" data-name="Delete Doctor">
                                            <i data-feather="trash-2" class="feather-trash-2"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6" class="text-center">No doctors found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="my-pagination mt-3 mb-3" id="doctor-list-pagination">
                    {{ $doctors->links('vendor.pagination.bootstrap-4') }}
                </div>                
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();

            Swal.fire({
                title: `Are you sure you want to delete this ${name}?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel",
                dangerMode: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

    });
</script>
@endpush