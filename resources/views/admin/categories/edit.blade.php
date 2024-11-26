
<form action="{{ route('admin.categories.update', $category->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="modal fade" id="editCategory-{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" name="name" value="{{ $category->name }}"
                                class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option disabled>Status </option>
                                <option value="1"@selected($category->status == 1)>Active</option>
                                <option value="0"@selected($category->status == 0)> Not Active</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </div>
            </div>
        </div>
    </div>
</form>