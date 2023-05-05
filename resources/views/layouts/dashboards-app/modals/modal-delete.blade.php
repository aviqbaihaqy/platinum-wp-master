<!-- MODAL BOX -->
<!-- Modal Delete -->
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content-a">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <h5>
                    Are you sure want to delete?
                </h5>
            </div>
            <div class="modal-footer">
                <form id="delete_form" method="POST" action="">
                    @csrf
                    @method('DELETE')
                </form>

                <button form="delete_form" type="submit" class="btn btn-d">Yes, remove</button>
                <button class="btn btn-c" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!-- /MODAL BOX -->