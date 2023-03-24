@extends('layout.admin')
@section('content')
    <form class="form" autocomplete="off" novalidate="novalidate" id="form_update">
        @csrf
        @method('PUT')
        <div class="card card-custom card-stretch">
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">{{ __('Cập nhật hồ sơ') }}</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">{{ __('Cập nhật hồ sơ của bạn') }}</span>
                </div>
                <div class="card-toolbar">
                    <button type="submit" class="btn btn-success mr-2">{{ __('Cập nhật') }}</button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{ __('Ảnh đại diện') }}</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="image-input image-input-outline image-input" id="kt_image_1">
                            @if (Auth::user()->avatar)
                                <div class="image-input-wrapper"
                                    style="background-image: url('storage/images/avatars/{{ Auth::user()->avatar }}')">
                                </div>
                            @else
                                <div class="image-input-wrapper"
                                     style="background-image:url('{{ asset('/assets/media/users/blank.png') }}')">
                                </div>
                            @endif
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title=""
                                data-original-title="Change avatar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="profile_avatar_remove" />
                            </label>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                        <span class="form-text text-muted">{{ __('Lưu ý: Chỉ có thể tải các file png, jpg, jpeg') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-xl-3 col-lg-3 col-form-label">{{ __('Họ và tên') }}:</label>
                    <div class="col-lg-9 col-xl-6">
                        <input id="name" name="name" value="{{ Auth::user()->name }}"
                            placeholder="{{ __('Họ và tên') }}"
                            class="form-control form-control-lg form-control-solid" type="text"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-xl-3 col-lg-3 col-form-label">{{ __('Số điện thoại') }}:</label>
                    <div class="col-lg-9 col-xl-6">
                        <input id="phone" name="phone" value="{{ Auth::user()->phone }}"
                               placeholder="{{ __('Số điện thoại') }}"
                               class="form-control form-control-lg form-control-solid" type="text"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{ __('Giới tính') }}:</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="radio-inline">
                            <label class="radio">
                                <input type="radio" name="gender" value="0" />
                                <span></span>{{ __('Nam') }}</label>
                            <label class="radio">
                                <input type="radio" name="gender" value="1" />
                                <span></span>{{ __('Nữ') }}</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="brith_day" class="col-xl-3 col-lg-3 col-form-label">{{ __('Ngày sinh') }}:</label>
                    <div class="col-lg-9 col-xl-6">
                        <input id="brith_day" name="brith_day" value="{{ Auth::user()->brith_day ? Carbon\Carbon::parse(Auth::user()->brith_day)->format('d-m-Y') : '' }}"
                               placeholder="{{ __('Ngày sinh') }}"
                               class="form-control form-control-lg form-control-solid" type="text"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-xl-3 col-lg-3 col-form-label">{{ __('Địa chỉ') }}:</label>
                    <div class="col-lg-9 col-xl-6">
                        <input id="address" name="address" value="{{ Auth::user()->address }}"
                               placeholder="{{ __('Địa chỉ') }}"
                               class="form-control form-control-lg form-control-solid" type="text"/>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script type="text/javascript">
        @if(Auth::user()->gender !== null)
            if ({{ Auth::user()->gender }} === 0) {
                $("input[type='radio'][name='gender'][value='0']").prop("checked", true)
            } else {
                $("input[type='radio'][name='gender'][value='1']").prop("checked", true)
            }
        @endif
        new KTImageInput('kt_image_1');
        $('#brith_day').datepicker({
            rtl: KTUtil.isRTL(),
            orientation: "top left",
            todayHighlight: true,
            format:"dd-mm-yyyy",
        });
        let validation;
        let form = KTUtil.getById('form_update');
        validation = FormValidation.formValidation(
            form, {
                fields: {
                    avatar: {
                        validators: {
                            file: {
                                extension: 'jpg,jpeg,png',
                                type: 'image/jpeg,image/png',
                                message: '{{ __('Vui lòng chọn đúng định dạng file') }}'
                            },
                        }
                    },
                    name: {
                        validators: {
                            notEmpty: {
                                message: '{{ __('Vui lòng không để trống mục này') }}'
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
                                message: '{{ __('Vui lòng kiểm tra lại số điện thoại') }}'
                            },
                        }
                    },
                    brith_day: {
                        validators: {
                            date: {
                                format: 'DD-MM-YYYY',
                                message: '{{__('Vui lòng kiểm tra lại thời gian')}}'
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
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );
        $('#form_update').on('submit', function(e) {
            e.preventDefault();
            const form = document.querySelector("#form_update");
            const formData = new FormData(form);
            validation.validate().then(function(status) {
                if (status !== 'Valid') {
                    mess_trial()
                } else {
                    axios({
                        method: 'POST',
                        url: '/profile',
                        data: formData,
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    }).then(function(response) {
                        if (response.data.status) {
                            Swal.fire({
                                icon: "question",
                                title: response.data.title,
                                text: response.data.message,
                                showCancelButton: false,
                                confirmButtonText: "{{ __('Đồng ý') }}",
                            }).then(function(result) {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        } else {
                            mess_error(response.data.title,response.data.message)
                        }
                    });
                }
            });
        });
    </script>
@endpush
