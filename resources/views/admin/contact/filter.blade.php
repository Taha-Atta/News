<div class="card-body">
    <form action="{{ url()->current() }}" method="get">
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control" name="sort_by">
                        <option selected disabled value="">Sort By</option>
                        <option value="id">Id</option>
                        <option value="name">Name</option>
                        <option value="created_at">Created At</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control" name="order_by">
                        <option selected disabled value="">Order By</option>
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control" name="limit_by">
                        <option selected disabled value="">Limit By</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control" name="status">
                        <option selected disabled value="">Status</option>
                        <option value="1">Read</option>
                        <option value="0">Unread</option>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <input class="form-control" name="keyword" type="text" placeholder="Search here....">
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Search</button>
                </div>
            </div>
        </div>
    </form>
</div>