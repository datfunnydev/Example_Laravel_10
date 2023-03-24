<div class="modal fade" id="model_update_role" tabindex="-1" role="dialog" aria-labelledby="labelModelEdit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Cập nhật') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="form_update_role">
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        @include('admin.role.field',['type' => 'update_'])
                        <input type="hidden" id="update_id">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">{{ __('Cập nhật') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            let validation_update_role = FormValidation.formValidation(
                KTUtil.getById('form_update_role'), {
                    fields: field,
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap()
                    }
                }
            );
            $('#form_update_role').submit(function (e) {
                e.preventDefault();
                let form = $(this);
                let id = $('#update_id').val();
                validation_update_role.validate().then(function (status) {
                    if (status === 'Valid') {
                        axios({
                            method: 'POST',
                            url: 'roles/' + id,
                            data: form.serialize(),
                        }).then((response) => {
                            if (response.data.status) {
                                mess_success(response.data.title, response.data.message)
                                DatatableRole.ajax.reload(null, false);
                                $('#model_update_role').closest('.modal').modal('toggle');
                            } else {
                                mess_error(response.data.title, response.data.message)
                            }
                        });
                    } else {
                        mess_trial()
                    }
                });
            });
        });
    </script>
@endpush
