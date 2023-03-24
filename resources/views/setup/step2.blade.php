@extends('layout.setup')
@section('content')
    <div class="row">
        <div class="col-12 text-center mt-3">
            <ul class="progressbar">
                <li class="active"><a href="/setup/step-1">{{ __('Yêu cầu máy chủ') }}</a></li>
                <li class="active"><a href="/setup/step-2">{{ __('Cài đặt') }}</a></li>
                <li>{{ __('Cơ sở dữ liệu') }}</li>
                <li>{{ __('Xác nhận') }}</li>
            </ul>
        </div>
    </div>
    <div class="row mt-3 p-5">
        <div class="col-12">
            <p class="alert alert-danger" id="message" style="display: none"></p>
            <form id="form_step_2">
                @csrf
                <div class="form-group">
                    <label for="app_name">{{ __('Tên ứng dụng của bạn') }}</label>
                    <input type="text" class="form-control" id="app_name" name="app_name"
                           value="{{ $data['APP_NAME'] }}" autofocus>
                </div>

                <div class="form-group">
                    <label for="app_env">{{ __('Chọn môi trường') }}</label>
                    <select class="form-control" id="app_env" name="app_env">
                        @if ($data['APP_ENV'] == 'local')
                            <option value="local">{{ __('Cục bộ') }}</option>
                            <option value="testing">{{ __('Thử nghiệm') }}</option>
                            <option value="production">{{ __('Sản phẩm') }}</option>
                        @elseif($data['APP_ENV'] == 'testing')
                            <option value="testing">{{ __('Thử nghiệm') }}</option>
                            <option value="local">{{ __('Cục bộ') }}</option>
                            <option value="production">{{ __('Sản phẩm') }}</option>
                        @else
                            <option value="production">{{ __('Sản phẩm') }}</option>
                            <option value="testing">{{ __('Thử nghiệm') }}</option>
                            <option value="local">{{ __('Cục bộ') }}</option>
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label for="app_debug">{{ __('Chế độ gỡ lỗi ứng dụng') }}</label>
                    <select class="form-control" id="app_debug" name="app_debug">
                        @if ($data['APP_DEBUG'] == 'true')
                            <option value="true">{{ __('Mở') }}</option>
                            <option value="false">{{ __('Tắt') }}</option>
                        @else
                            <option value="false">{{ __('Tắt') }}</option>
                            <option value="true">{{ __('Mở') }}</option>
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label for="app_key">{{ __('Khóa ứng dụng') }}</label>
                    <input type="text" class="form-control" id="app_key" name="app_key" value="{{ $data['APP_KEY'] }}"
                           readonly>
                    <button class="btn btn-outline-warning mt-3" id="generate_key">{{ __('Tạo khóa') }}</button>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <a href="/setup/step-1" class="btn btn-outline-danger mt-3"><i class="fa fa-angle-left"></i>
                            {{ __('Quay lại') }} </a>
                    </div>
                    <div class="col-6 col-md-6">
                        <button type="submit" class="btn btn-outline-danger mt-3 float-md-right"> {{ __('Tiếp tục') }}
                            <i class="fa fa-angle-right"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $('#generate_key').click(function (e) {
            e.preventDefault();
            axios.get('/setup/new-key')
                .then((response) => {
                    $('#app_key').val(response.data);
                })
        });
        $('#form_step_2').submit(function (e) {
            e.preventDefault();
            if ($('#app_name').val() === '') {
                $('#message').css('display', 'block').html('{{ __('Vui lòng điền tên ứng dụng của bạn') }}');
            } else {
                axios({
                    method: 'POST',
                    url: '/setup/step-2',
                    data: $('#form_step_2').serialize(),
                }).then(function () {
                    window.location = '/setup/step-3'
                });
            }
        });
    </script>
@endpush
