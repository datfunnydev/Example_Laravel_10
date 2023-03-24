<form class=form id=kt_login_forgot_form novalidate>
    @csrf
    <div class="pb-8 text-center">
        <h2 class="font-size-h1-lg font-size-h2 font-weight-bolder text-dark">{{ __('Quên mật khẩu') }}</h2>
        <p class="font-size-h4 font-weight-bold text-muted">{{ __('Điền email để lấy lại mật khẩu') }}
    </div>
    <div class=form-group>
        <input autocomplete=off class="font-size-h6 form-control form-control-solid h-auto px-6 py-7 rounded-lg" id=email_forgot name=email placeholder=Email type=email>
    </div>
    <div class="d-flex flex-center flex-wrap form-group pb-3 pb-lg-0">
        <button class="btn btn-primary font-size-h6 font-weight-bolder mx-4 my-3 px-8 py-4" id=kt_login_forgot_submit type=button>{{ __('Gửi') }}</button>
        <button class="btn btn-light-primary font-size-h6 font-weight-bolder mx-4 my-3 px-8 py-4" id=kt_login_forgot_cancel type=button>{{ __('Thoát') }}</button>
    </div>
</form>
@push('scripts')
    <script type="text/javascript">
        let validation_reset;
        let form = KTUtil.getById('kt_login_reset_form');
        FormValidation.validators.checkPassword = strongPassword;
        validation_reset = FormValidation.formValidation(
            form, {
                fields: {
                    token_reset: {
                        validators: {
                            notEmpty: {
                                message: '{{ __('Vui lòng điền mã xác nhận') }}'
                            }
                        }
                    },
                    password_reset: {
                        validators: {
                            notEmpty: {
                                message: '{{ __('Vui lòng điền mật khẩu') }}'
                            },
                            checkPassword: {
                                message: '{{ __('Vui lòng nhập mật khẩu mạnh hơn (bao gồm cả chữ thường và chữ hoa và số)') }}'
                            },
                        }
                    },
                    password_confirm: {
                        validators: {
                            notEmpty: {
                                message: '{{ __('Vui lòng nhập lại mật khẩu') }}'
                            },
                            identical: {
                                compare: function() {
                                    return form.querySelector('[name="password_reset"]').value;
                                },
                                message: '{{ __('Nhập lại mật khẩu không trùng khớp') }}'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );
        $('#kt_login_reset_submit').on('click', function(e) {
            e.preventDefault();
            validation_reset.validate().then(function(status) {
                if (status !== 'Valid') {
                    mess_trial()
                } else {
                    axios.post('reset-pass', {
                        email: $('#email_forgot').val(),
                        token_reset: $('#token_reset').val(),
                        password: $('#password_reset').val()
                    }).then(function(response) {
                        if (response.data.status) {
                            mess_success(response.data.title,response.data.message)
                            _showForm('signin');
                        } else {
                            mess_error(response.data.title,response.data.message)
                        }
                    });
                }
            });
        });
        $('#kt_login_reset_cancel').on('click', function(e) {
            e.preventDefault();
            _showForm('signin');
        });
    </script>
@endpush
