<table class="table">
    <thead class="thead-light">
        <tr>
            <th>Sr. No.</th>
            <th>Title</th>
            <th style="width: 30%;">Details</th>
            <th>File</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($newsMediaCategories) && $newsMediaCategories->count() > 0)
            @foreach($newsMediaCategories as $newsMediaCategory)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $newsMediaCategory->title }}</td>
                <td>{{ $newsMediaCategory->description }}</td>
                <td>
                    @if($newsMediaCategory->file)
                        @php
                            $imagePath = public_path('upload/newsmediacat/' . $newsMediaCategory->file);
                            $imageExists = file_exists($imagePath);
                        @endphp
                        
                        @if($imageExists)
                            <div style="width: 100px; height: 70px; display: flex; justify-content: center; align-items: center; background: #f8f9fa;">
                                <img src="{{ asset('upload/newsmediacat/' . $newsMediaCategory->file) }}" 
                                    style="max-width: 100%; max-height: 100%; object-fit: contain;"
                                    alt="{{ $newsMediaCategory->title }}"
                                    title="{{ $newsMediaCategory->title }}">
                            </div>
                        @else
                            <span class="text-muted">Image missing</span>
                        @endif
                    @else
                        <span class="text-muted">No image</span>
                    @endif
                </td>
                <td>
                    @if($newsMediaCategory->status == '1')
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </td>
                <td class="action-table-data">
                    <div class="edit-delete-action">
                        <a class="btn btn-sm btn-primary me-2 p-2"
                        href="javascript:;" 
                        data-title="Edit News & Media Category" 
                        data-size="md"
                        data-id="{{ $newsMediaCategory->id }}"
                        data-url="{{ route('manage-news-media-category.edit', $newsMediaCategory->id) }}"
                        data-newmedia-cat-edit="true"
                        title="Edit">
                            <i data-feather="edit" class="feather-edit"></i>
                        </a>
                        <form action="{{ route('manage-news-media-category.destroy', $newsMediaCategory->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger show_confirm" data-name="{{ $newsMediaCategory->title }}" title="Delete">
                                <i data-feather="trash-2" class="feather-trash-2"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" class="text-center">No categories found.</td>
            </tr>
        @endif
    </tbody>
</table>