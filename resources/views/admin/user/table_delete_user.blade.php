<div class="modal fade" id="model_delete_user" tabindex="-1" role="dialog" aria-labelledby="labelModelEdit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Khôi phục tài khoản') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                {!!
                    $deletedUserDataTable->table([
                        'class' => 'table table-separate table-head-custom table-checkable display nowrap',
                        'id' => 'datatable_delete_user',
                    ])
                !!}
            </div>
        </div>
    </div>
</div>
@push('scripts')
    {!! $deletedUserDataTable->scripts() !!}
    <script type="text/javascript">
        let DatatableDeleteUser;
        $(document).ready(function() {
            DatatableDeleteUser = window.LaravelDataTables["datatable_delete_user"];
        });
        $(document).on('shown.bs.modal', '#model_delete_user', function () {
            DatatableDeleteUser.columns.adjust().responsive.recalc();
        });
        $(document).on('click', '.restore_user', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            axios.put('users/restore/' + id)
                .then((response) => {
                    if (response.data.status) {
                        mess_success(response.data.title, response.data.message)
                        DatatableUser.ajax.reload(null, false);
                        DatatableDeleteUser.ajax.reload(null, false);
                    } else {
                        mess_error(response.data.title, response.data.message)
                    }
                });
        });
    </script>
@endpush
