<table class="table">
    <thead class="thead-light">
        <tr>
            <th width="10%">Sr. No.</th>
            <th width="40%">Title</th>
            <th width="20%">Status</th>
            <th width="30%">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($awardCategory) && $awardCategory->count() > 0)
            @foreach($awardCategory as $key => $award_category_row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $award_category_row->title }}</td>
                <td>
                    @if($award_category_row->status == 1)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </td>
                <td class="action-table-data">
                    <div class="edit-delete-action">
                        <a class="btn btn-sm btn-primary me-2 p-2"
                        href="javascript:;" 
                        data-title="Edit awards category" 
                        data-size="md"
                        data-awcateid="{{ $award_category_row->id }}"
                        data-award-category-edit="true" 
                        data-url="{{ route('manage-award-category.edit', $award_category_row->id) }}"
                        title="Edit">
                            <i data-feather="edit" class="feather-edit"></i>
                        </a>
                        <form action="{{ route('manage-award-category.destroy', $award_category_row->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger show_confirm" data-name="{{ $award_category_row->title }}" title="Delete">
                                <i data-feather="trash-2" class="feather-trash-2"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" class="text-center">No years found.</td>
            </tr>
        @endif
    </tbody>
</table>