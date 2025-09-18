@if($activities->count() > 0)
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Status</th>
                <th>Main Image</th>
                <th>More Images</th>
                <th>Video</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $activity)
            <tr>
                <td>{{ $activity->title }}</td>
                <td>
                    {!! Str::limit($activity->long_content, 50) !!}
                </td>
                <td>
                    @if($activity->status == 1)
                    <span class="badge bg-success">Active</span>                    
                    @else
                    <span class="badge bg-danger">Inactive</span>
                    @endif
                </td>
                <td>
                    @if($activity->main_image)
                        <img src="{{ asset('upload/activities/' . $activity->main_image) }}" alt="Image" width="100">
                    @endif
                </td>
                <td>
                    @if($activity->images->count() > 0)
                        <span class="badge bg-info">{{ $activity->images->count() }} Images</span>
                    @else
                        <span class="badge bg-secondary">No Images</span>   
                    @endif
                </td>
                <td>
                    @if($activity->videos->count() > 0)
                        <span class="badge bg-purple">{{ $activity->videos->count() }} Video</span>
                    @else
                        <span class="badge bg-secondary">No Video</span>   
                    @endif
                </td>                
                <td class="action-table-data">
                    <div class="edit-delete-action">
                        <a class="btn btn-sm btn-primary me-2 p-2" href="{{ route('manage-activities.edit', $activity->id) }}">
                            <i data-feather="edit" class="feather-edit"></i>
                        </a>
                        <form action="{{ route('manage-activities.destroy', $activity->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger show_confirm" data-name="Delete Activities">
                                <i data-feather="trash-2" class="feather-trash-2"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
<div class="my-pagination mt-3 mb-3" id="blog-list-pagination">
    {{ $activities->links('vendor.pagination.bootstrap-4') }}
</div>  
@endif