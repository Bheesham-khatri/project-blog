<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                <form method="POST" id="sample_form" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Confirmation..</h5>
                    </div>
                    <div class="modal-body">
                        <h4 align="center" style="margin:0;">Are you sure you want to remove this post?</h4>
                    </div>
                    <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">YES</button>
                    <button type="button"  name="close_btn" data-dismiss="modal"  id="close_btn" class="btn btn-secondary">
                        Close
                    </button>

                    </div>
                </form>
                </div>
                </div>
    </div>
</div>