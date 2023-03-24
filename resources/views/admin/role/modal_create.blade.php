<div class="modal fade" id="model_create_role" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Thêm mới') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="form_create_role">
                    <div class="card-body">
                        @csrf
                        @include('admin.role.field',['type' => 'create_'])
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">{{ __('Thêm mới') }}</button>
                        <button type="reset" class="btn btn-secondary">{{ __('Nhập lại') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        let validation_create_role = FormValidation.formValidation(
            KTUtil.getById('form_create_role'), {
                fields: field,
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );
        $('#form_create_role').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            validation_create_role.validate().then(function (status) {
                if (status === 'Valid') {
                    axios({
                        method: 'POST',
                        url: 'roles',
                        data: form.serialize(),
                    }).then((response) => {
                        if (response.data.status) {
                            mess_success(response.data.title, response.data.message)
                            DatatableRole.ajax.reload(null, false);
                        } else {
                            mess_error(response.data.title, response.data.message)
                        }
                    });
                } else {
                    mess_trial()
                }
            });
        });
    </script>
@endpush
