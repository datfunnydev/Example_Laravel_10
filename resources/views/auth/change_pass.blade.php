@extends('layout.admin')
@section('content')
    <form class="form" autocomplete="off" id="form_change_pass">
        @csrf
        @method('PUT')
        <div class="card card-custom card-stretch">
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">{{ __('Đổi mật khẩu') }}</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">{{ __('Thay đổi mật khẩu của bạn') }}</span>
                </div>
                <div class="card-toolbar">
                    <button type="submit" class="btn btn-success mr-2">{{ __('Cập nhật') }}</button>
                </div>
            </div>
            <div class="card-body">
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label for="old_password">{{ __('Mật khẩu cũ') }}:</label>
                        <input id="old_password" class="form-control form-control-solid" type="password"
                               placeholder="{{ __('Mật khẩu cũ') }}"
                               name="old_password"/>
                    </div>
                    <div class="form-group">
                        <label for="password">{{ __('Mật khẩu mới') }}:</label>
                        <input id="password" class="form-control form-control-solid" type="password"
                               placeholder="{{ __('Mật khẩu mới') }}" name="password"/>
                    </div>
                    <div class="form-group">
                        <label for="re_password">{{ __('Nhập lại mật khẩu') }}:</label>
                        <input id="re_password" class="form-control form-control-solid" type="password"
                               placeholder="{{ __('Nhập lại mật khẩu') }}" name="re_password"/>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script type="text/javascript">
        let validation;
        let form = KTUtil.getById('form_change_pass');
        FormValidation.validators.checkPassword = strongPassword;
        validation = FormValidation.formValidation(
            form, {
                fields: {
                    old_password: {
                        validators: {
                            notEmpty: {
                                message: '{{ __('Vui lòng không để trống mục này') }}'
                            },
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: '{{ __('Vui lòng không để trống mục này') }}'
                            },
                            checkPassword: {
                                message: '{{ __('Vui lòng điền mật khẩu mạnh hơn (bao gồm cả chữ và số)') }}'
                            },
                        }
                    },
                    re_password: {
                        validators: {
                            notEmpty: {
                                message: '{{ __('Vui lòng không để trống mục này') }}'
                            },
                            identical: {
                                compare: function () {
                                    return form.querySelector('[name="password"]').value;
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
        $('#form_change_pass').on('submit', function (e) {
            e.preventDefault();
            let form = $(this);
            validation.validate().then(function (status) {
                if (status !== 'Valid') {
                    mess_trial()
                } else {
                    axios({
                        method: 'POST',
                        url: 'change-pass',
                        data: form.serialize()
                    }).then((response) => {
                        if (response.data.status) {
                            mess_success(response.data.title, response.data.message)
                        } else {
                            mess_error(response.data.title, response.data.message)
                        }
                    });
                }
            });
        });
    </script>
@endpush
