<form class=form id=kt_login_signin_form novalidate>
    @csrf
    <div class="pb-8 text-center">
        <h2 class="font-size-h1-lg font-size-h2 font-weight-bolder text-dark">{{ __('Đăng nhập') }}</h2>
    </div>
    <div class=form-group>
        <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
        <input class="form-control form-control-solid h-auto px-6 py-7 rounded-lg" id=email name=username type=text></div>
    <div class=form-group>
        <div class="d-flex justify-content-between mt-n5">
            <label class="font-size-h6 font-weight-bolder pt-5 text-dark">{{ __('Mật khẩu') }}</label>
            <a class="font-size-h6 font-weight-bolder pt-5 text-hover-primary text-primary" href=javascript:; id=kt_login_forgot>{{ __('Quên mật khẩu') }}?</a>
        </div>
        <input class="form-control form-control-solid h-auto px-6 py-7 rounded-lg" id=password name=password type=password>
    </div>
    <div class="pt-2 text-center">
        <button class="btn btn-dark font-size-h6 font-weight-bolder my-3 px-8 py-4" id=kt_login_signin_submit>{{ __('Đăng nhập') }}</button>
    </div>
</form>
@push('scripts')
    <script type="text/javascript">
        let validation_sign_in;
        validation_sign_in = FormValidation.formValidation(
            KTUtil.getById('kt_login_signin_form'), {
                fields: {
                    username: {
                        validators: {
                            notEmpty: {
                                message: '{{ __('Vui lòng điền email') }}'
                            },
                            emailAddress: {
                                message: '{{ __('Vui lòng kiểm tra lại email') }}'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: '{{ __('Vui lòng điền mật khẩu') }}'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );
        $('#kt_login_signin_submit').on('click', function (e) {
            e.preventDefault();
            validation_sign_in.validate().then(function (status) {
                if (status !== 'Valid') {
                    mess_trial()
                } else {
                    axios.post('login', {
                        email: $('#email').val(),
                        password:  $('#password').val(),
                    }).then((response) => {
                        if (response.data.status) {
                            let url = location.search;
                            if (url !== '') {
                                window.location = url.replace('?next_url=', '');
                            } else {
                                window.location = response.data.data;
                            }
                        } else {
                            mess_error(response.data.title, response.data.message)
                        }
                    });
                }
            });
        });
        $('#kt_login_forgot').on('click', function(e) {
            e.preventDefault();
            _showForm('forgot');
        });
        $('#kt_login_reset').on('click', function(e) {
            e.preventDefault();
            _showForm('reset');
        });
    </script>
@endpush
