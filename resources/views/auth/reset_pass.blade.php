<form autocomplete=off class=form id=kt_login_reset_form novalidate>
    @csrf
    <div class="pb-8 text-center">
        <h2 class="font-size-h1-lg font-size-h2 font-weight-bolder text-dark">{{ __('Lấy lại mật khẩu') }}</h2>
        <p class="font-size-h4 font-weight-bold text-muted">{{ __('Điền mã xác nhận và mật khẩu mới của bạn') }}
    </div>
    <div class=form-group>
        <input class="font-size-h6 form-control form-control-solid h-auto px-6 py-7 rounded-lg" id=token_reset name=token_reset placeholder="{{ __('Mã xác nhận') }}" type=text>
    </div>
    <div class=form-group>
        <input class="font-size-h6 form-control form-control-solid h-auto px-6 py-7 rounded-lg" id=password_reset name=password_reset placeholder="{{ __('Mật khẩu') }}" type=password></div>
    <div class=form-group>
        <input class="font-size-h6 form-control form-control-solid h-auto px-6 py-7 rounded-lg" id=password_confirm name=password_confirm placeholder="{{ __('Nhập lại mật khẩu') }}" type=password>
    </div>
    <div class="d-flex flex-center flex-wrap form-group pb-3 pb-lg-0">
        <button class="btn btn-primary font-size-h6 font-weight-bolder mx-4 my-3 px-8 py-4" id=kt_login_reset_submit type=button>{{ __('Lưu') }}</button>
        <button class="btn btn-light-primary font-size-h6 font-weight-bolder mx-4 my-3 px-8 py-4" id=kt_login_reset_cancel type=button>{{ __('Thoát') }}</button>
    </div>
</form>
@push('scripts')
    <script type="text/javascript">
        let validation_forgot;
        validation_forgot = FormValidation.formValidation(
            KTUtil.getById('kt_login_forgot_form'), {
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: '{{ __('Vui lòng điền email') }}'
                            },
                            emailAddress: {
                                message: '{{ __('Vui lòng kiểm tra lại email') }}'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );
        $('#kt_login_forgot_submit').on('click', function(e) {
            e.preventDefault();
            validation_forgot.validate().then(function(status) {
                if (status === 'Valid') {
                    axios.post('forgot-pass', {
                        email: $('#email_forgot').val(),
                    }).then(function(response) {
                        if (response.data.status) {
                            mess_success(response.data.title,response.data.message)
                            _showForm('reset');
                        } else {
                            mess_error(response.data.title,response.data.message)
                        }
                    })
                } else {
                    mess_trial()
                }
            });
        });
        $('#kt_login_forgot_cancel').on('click', function(e) {
            e.preventDefault();
            _showForm('signin');
        });
    </script>
@endpush
