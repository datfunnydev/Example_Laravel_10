<div class="card-body">
    {!!
        $dataTable->table([
            'class' => 'table table-separate table-head-custom table-checkable display nowrap',
            'id' => 'datatable_role',
        ])
    !!}
</div>
@push('scripts')
    {!! $dataTable->scripts() !!}
    <script type="text/javascript">
        let DatatableRole;
        $(document).ready(function() {
            DatatableRole = window.LaravelDataTables["datatable_role"];
        });
        $(document).on('click', '.view_role', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            $('#form_update_role')[0].reset();
            axios.get('roles/' + id)
                .then((response) => {
                    if (response.data.status) {
                        let role = response.data.data;
                        $('#update_id').val(role.id);
                        $('#update_name').val(role.name);
                        $('#update_desc').val(role.phone);
                        for (let i = 0; i < role.permissions.length; i++) {
                            $('#update_permission_id_' + role.permissions[i].id).attr('checked','checked')
                        }
                    } else {
                        mess_error(response.data.title, response.data.message)
                    }
                });
        });
    </script>
@endpush
