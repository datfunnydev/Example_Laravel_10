@extends('layout.setup')
@section('content')
    <div class="row">
        <div class="col-12 text-center mt-3">
            <ul class="progressbar">
                <li class="active"><a href="/setup/step-1">{{ __('Yêu cầu máy chủ') }}</a></li>
                <li class="active"><a href="/setup/step-2">{{ __('Cài đặt') }}</a></li>
                <li class="active"><a href="/setup/step-3">{{ __('Cơ sở dữ liệu') }}</a></li>
                <li>{{ __('Xác nhận') }}</li>
            </ul>
        </div>
    </div>
    <div class="row mt-3 p-5">
        <div class="col-12">
            <form id="form_step_3">
                @csrf
                <p class="alert" id="message" style="display: none"></p>
                <label for="db_connection">{{ __('Chọn loại cơ sở dữ liệu') }}</label>
                <select class="form-control" id="db_connection" name="db_connection">
                    <option value="mysql">MySQL</option>
                </select>
                <label for="db_host" class="mt-1" id="db_host_label">DB Host</label>
                <input type="text" class="form-control" id="db_host" name="db_host" placeholder="127.0.0.1"
                       value="{{ $data['DB_HOST'] }}">
                <label for="db_port" class="mt-1" id="db_port_label">DB Port</label>
                <input type="text" class="form-control" id="db_port" name="db_port" placeholder="3306"
                       value="{{ $data['DB_PORT'] }}">
                <label for="db_database" class="mt-1" id="db_database_label">DB Database</label>
                <input type="text" class="form-control" id="db_database" name="db_database" placeholder="Database Name"
                       value="{{ $data['DB_DATABASE'] }}">
                <label for="db_username" class="mt-1" id="db_username_label">DB Username</label>
                <input type="text" class="form-control" id="db_username" name="db_username" placeholder="Username"
                       value="{{ $data['DB_USERNAME'] }}">
                <label for="db_password" class="mt-1" id="db_password_label">DB Password</label>
                <input type="text" class="form-control" id="db_password" name="db_password" placeholder="Password"
                       value="{{ $data['DB_PASSWORD'] }}">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <a href="/setup/step-2" class="btn btn-outline-danger mt-3"><i class="fa fa-angle-left"></i>
                            {{ __('Quay lại') }} </a>
                    </div>
                    <div class="col-6 col-md-6">
                        <button type="button" id="connect_database" class="btn btn-outline-danger mt-3 float-md-right">
                            {{ __('Kết nối') }} <i class="fa fa-angle-right"></i></button>
                        <a href="/setup/step-4">
                            <button type="button" id="next_step" class="btn btn-outline-danger mt-3 float-md-right" style="display: none"> {{ __('Tiếp tục') }} <i class="fa fa-angle-right"></i></button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $('#db_host').keyup(function (e) {
            e.preventDefault();
            $('#connect_database').css('display', 'block');
            $('#next_step').css('display', 'none');
        });
        $('#db_port').keyup(function (e) {
            e.preventDefault();
            $('#connect_database').css('display', 'block');
            $('#next_step').css('display', 'none');
        });
        $('#db_database').keyup(function (e) {
            e.preventDefault();
            $('#connect_database').css('display', 'block');
            $('#next_step').css('display', 'none');
        });
        $('#db_username').keyup(function (e) {
            e.preventDefault();
            $('#connect_database').css('display', 'block');
            $('#next_step').css('display', 'none');
        });
        $('#db_password').keyup(function (e) {
            e.preventDefault();
            $('#connect_database').css('display', 'block');
            $('#next_step').css('display', 'none');
        });
        $('#connect_database').click(function (e) {
            e.preventDefault();
            if ($('#db_host').val() === '') {
                $('#message').css('display', 'block').removeClass('alert-success').addClass('alert-danger').html(
                    '{{ __('Vui lòng điền DB host') }}');
            } else if ($('#db_port').val() === '') {
                $('#message').css('display', 'block').removeClass('alert-success').addClass('alert-danger').html(
                    '{{ __('Vui lòng điền DB port') }}');
            } else if ($('#db_database').val() === '') {
                $('#message').css('display', 'block').removeClass('alert-success').addClass('alert-danger').html(
                    '{{ __('Vui lòng điền DB database') }}');
            } else if ($('#db_username').val() === '') {
                $('#message').css('display', 'block').removeClass('alert-success').addClass('alert-danger').html(
                    '{{ __('Vui lòng điền DB username') }}');
            } else if ($('#db_password').val() === '') {
                $('#message').css('display', 'block').removeClass('alert-success').addClass('alert-danger').html(
                    '{{ __('Vui lòng điền DB password') }}');
            } else {
                axios({
                    method: 'POST',
                    url: '/setup/step-3',
                    data: $('#form_step_3').serialize(),
                }).then((response) => {
                    if (response.data.status) {
                        $('#message').css('display', 'block').removeClass('alert-danger').addClass(
                            'alert-success').html('{{ __('Kết nối thành công') }}');
                        $('#connect_database').css('display', 'none');
                        $('#next_step').css('display', 'block');
                    } else {
                        $('#message').css('display', 'block').removeClass('alert-success').addClass(
                            'alert-danger').html(response.data.message);
                    }
                });
            }
        });
    </script>
@endpush
