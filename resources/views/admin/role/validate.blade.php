@push('scripts')
    <script type="text/javascript">
        let field = {
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
            desc: {
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
