@push('scripts')
    <script type="text/javascript">
        let field = {
            role_id: {
                validators: {
                    notEmpty: {
                        message: '{{__('Vui lòng chọn mục này')}}'
                    },
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: '{{__('Vui lòng chọn mục này')}}'
                    },
                    emailAddress: {
                        message: '{{__('Vui lòng kiểm tra lại định dạng email')}}'
                    },
                    stringLength: {
                        max: 255,
                        message: '{{__('Vui lòng không điền quá 255 kí tự')}}'
                    },
                }
            },
            name: {
                validators: {
                    notEmpty: {
                        message: '{{__('Vui lòng không để trống mục này')}}'
                    },
                    stringLength: {
                        max: 255,
                        message: '{{__('Vui lòng không điền quá 255 kí tự')}}'
                    },
                }
            },
            phone: {
                validators: {
                    phone: {
                        country: 'US',
                        message: '{{__('Vui lòng kiểm tra lại định dạng số điện thoại')}}'
                    },
                }
            },
            birthday: {
                validators: {
                    date: {
                        format: 'DD-MM-YYYY',
                        message: '{{__('Vui lòng kiểm tra lại định dạng ngày tháng năm')}}'
                    },
                }
            },
            address: {
                validators: {
                    stringLength: {
                        max: 255,
                        message: '{{__('Vui lòng không điền quá 255 kí tự')}}'
                    },
                }
            },
        }
    </script>
@endpush
