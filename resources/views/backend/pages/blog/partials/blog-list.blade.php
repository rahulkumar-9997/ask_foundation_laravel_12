<table class="table datatable">
    <thead class="thead-light">
        <tr>
            <th>Title</th>
            <th>Subtitle</th>
            <th>Status</th>
            <th>Desktop Video</th>
            <th>Mobile Video</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if($banners->count() > 0)
        @foreach($banners as $banner)
        <tr>
            <td>{{ $banner->title }}</td>
            <td>{{ $banner->subtitle }}</td>
            <td>
                @if($banner->is_active==1)
                <span class="badge bg-success">Active</span>
                @else
                <span class="badge bg-danger">Inactive</span>
                @endif
            </td>
            <td>
                @if($banner->desktop_video_url)
                <video width="200" controls>
                    <source src="{{ asset('upload/banner/' . $banner->desktop_video_url) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                @endif
            </td>
            <td>
                @if($banner->mobile_video_url)
                <video width="200" controls>
                    <source src="{{ asset('upload/banner/' . $banner->mobile_banner_url) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                @endif
            </td>
            <td class="action-table-data">
                <div class="edit-delete-action">
                    <a class="btn btn-sm btn-primary me-2 p-2" href="{{ route('manage-banner.edit', $banner->id) }}">
                        <i data-feather="edit" class="feather-edit"></i>
                    </a>
                    <form action="{{ route('manage-banner.destroy', $banner->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger show_confirm" data-name="Delete Banner">
                            <i data-feather="trash-2" class="feather-trash-2"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="6" class="text-center">No blog found.</td>
        </tr>
        @endif
    </tbody>
</table>