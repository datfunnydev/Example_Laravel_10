<div class="card-body">
    {!!
        $dataTable->table([
            'class' => 'table table-separate table-head-custom table-checkable display nowrap',
            'id' => 'datatable_user',
        ])
    !!}
</div>
@push('scripts')
    {!! $dataTable->scripts() !!}
    <script type="text/javascript">
        let DatatableUser;
        $(document).ready(function() {
            DatatableUser = window.LaravelDataTables["datatable_user"];
        });
        $(document).on('click', '.view_user', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            axios.get('users/' + id)
                .then((response) => {
                    if (response.data.status) {
                        let user = response.data.data;
                        $('#update_id').val(user.id);
                        $('#update_email').val(user.email);
                        $('#update_name').val(user.name);
                        $('#update_phone').val(user.phone);
                        if (parseInt(user.gender) === 0) {
                            $("input[type='radio'][name='gender'][value='0']").prop("checked", true)
                        } else if (parseInt(user.gender) === 1)  {
                            $("input[type='radio'][name='gender'][value='1']").prop("checked", true)
                        } else {
                            $("input[type='radio'][name='gender'][value='0']").prop("checked", false)
                            $("input[type='radio'][name='gender'][value='1']").prop("checked", false)
                        }
                        $('#update_birthday').val(user.birthday ? moment(user.birthday).format('YYYY-MM-DD') : '');
                        $('#update_address').val(user.address);
                    } else {
                        mess_error(response.data.title, response.data.message)
                    }
                });
        });
    </script>
@endpush
