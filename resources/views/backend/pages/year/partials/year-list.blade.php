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
        @if(isset($years) && $years->count() > 0)
            @foreach($years as $key => $year)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $year->title }}</td>
                <td>
                    @if($year->status == 1)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </td>
                <td class="action-table-data">
                    <div class="edit-delete-action">
                        <a class="btn btn-sm btn-primary me-2 p-2"
                        href="javascript:;" 
                        data-title="Edit year" 
                        data-size="md"
                        data-yearid="{{ $year->id }}"
                        data-year-edit="true" 
                        data-url="{{ route('manage-year.edit', $year->id) }}"
                        title="Edit">
                            <i data-feather="edit" class="feather-edit"></i>
                        </a>
                        <form action="{{ route('manage-year.destroy', $year->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger show_confirm" data-name="{{ $year->title }}" title="Delete">
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