@include('admin.user.table')
@include('admin.user.table_delete_user')
@include('admin.user.validate')
@include('admin.user.script')
@include('admin.user.modal_create')
@include('admin.user.modal_update')
@push('scripts')
    <script type="text/javascript">
        $(document).on('click', '.destroy_user', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                icon: "question",
                title: '{{__('Câu hỏi')}}',
                text: '{{__('Bạn có chắc chắn muốn xoá nhân viên này không?')}}',
                showCancelButton: true,
                confirmButtonText: '{{__('Đồng ý')}}',
                cancelButtonText: '{{__('Không')}}',
            }).then(function (result) {
                if (result.value) {
                    axios.delete('users/' + id)
                        .then((response) => {
                            if (response.data.status) {
                                mess_success(response.data.title, response.data.message)
                                DatatableUser.ajax.reload(null, false);
                                DatatableDeleteUser.ajax.reload(null, false);
                            } else {
                                mess_error(response.data.title, response.data.message)
                            }
                        });
                }
            });
        });
    </script>
@endpush
