@include('admin.role.table')
@include('admin.role.validate')
@include('admin.role.modal_create')
@include('admin.role.modal_update')
@push('scripts')
    <script type="text/javascript">
        $(document).on('click', '.destroy_role', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                icon: "question",
                title: '{{__('Câu hỏi')}}',
                text: '{{__('Bạn có chắc chắn muốn xoá chức vụ này không?')}}',
                showCancelButton: true,
                confirmButtonText: '{{__('Đồng ý')}}',
                cancelButtonText: '{{__('Không')}}',
            }).then(function (result) {
                if (result.value) {
                    axios.delete('roles/' + id)
                        .then((response) => {
                            if (response.data.status) {
                                mess_success(response.data.title, response.data.message)
                                DatatableRole.ajax.reload(null, false);
                            } else {
                                mess_error(response.data.title, response.data.message)
                            }
                        });
                }
            });
        });
    </script>
@endpush
