{{--todo create modal--}}
<div class="modal fade" id="addCategory" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="error"> </div>
                <form class="row g-3" id="addCategoryForm" action="{{route('createCategory')}}" method="post">
                    <div class="col-md-12">
                        <label for="category" class="form-label">Category Name</label>
                        <input type="text" name="categoryName" class="form-control" id="category">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- End Modal Dialog Scrollable-->

{{--todo edit modal--}}
<div class="modal fade" id="updateCategory" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="error"> </div>
                <form class="row g-3" id="updateCategoryForm" action="{{route('updateCategory')}}" method="post">
                    <div class="col-md-12">
                        <label for="category" class="form-label">Category Name</label>
                        <input type="text" id="categoryName" name="categoryName" class="form-control" id="category">
                        <input type="hidden" id="categoryId" name="categoryId" class="form-control" id="category">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- End Modal Dialog Scrollable-->

