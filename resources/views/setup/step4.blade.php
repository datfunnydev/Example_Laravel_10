@extends('layout.setup')
@section('content')
    <div class="row">
        <div class="col-12 text-center mt-3">
            <ul class="progressbar">
                <li class="active"><a href="/setup/step-1">{{ __('Yêu cầu máy chủ') }}</a></li>
                <li class="active"><a href="/setup/step-2">{{ __('Cài đặt') }}</a></li>
                <li class="active"><a href="/setup/step-3">{{ __('Cơ sở dữ liệu') }}</a></li>
                <li class="active"><a href="/setup/step-4">{{ __('Xác nhận') }}</a></li>
            </ul>
        </div>
    </div>
    <div class="row mt-3 p-5 d-block" id="content">
        <div class="col-12">
            <form action="{{ url('/setup/step-4') }}" method="post">
                @csrf
                <h2 class="mb-5">{{ __('Bạn có muốn các cài đặt này thay đổi không?') }}</h2>
                <div id="tochange">
                    @if ($data['APP_NAME'] != 'old')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-6 text-truncate">{{ __('Tên ứng dụng') }}</div>
                                <div class="col-12 col-md-6 text-truncate"> {{ $data['APP_NAME'] }}</div>
                            </div>
                        </div>
                    @endif
                    @if ($data['APP_KEY'] != 'old')
                        <div class="form-group">
                            <div class="row">
                                <div
                                    class="col-12 col-md-6 text-truncate font-weight-bold">{{ __('Mã ứng dụng') }}</div>
                                <div class="col-12 col-md-6 text-truncate"> {{ $data['APP_KEY'] }}</div>
                            </div>
                        </div>
                    @endif
                    @if ($data['APP_DEBUG'] != 'old')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-6 text-truncate ">{{ __('Chế độ gỡ lỗi') }}</div>
                                <div class="col-12 col-md-6 text-truncate"> {{ $data['APP_DEBUG'] }}</div>
                            </div>
                        </div>
                    @endif
                    @if ($data['DB_HOST'] != 'old')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-6 text-truncate">Database Host</div>
                                <div class="col-12 col-md-6 text-truncate"> {{ $data['DB_HOST'] }}</div>
                            </div>
                        </div>
                    @endif
                    @if ($data['DB_DATABASE'] != 'old')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-6 text-truncate">Database Selected</div>
                                <div class="col-12 col-md-6 text-truncate"> {{ $data['DB_DATABASE'] }}</div>
                            </div>
                        </div>
                    @endif
                    @if ($data['DB_USERNAME'] != 'old')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-6 text-truncate">Database Username</div>
                                <div class="col-12 col-md-6 text-truncate"> {{ $data['DB_USERNAME'] }}</div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <a href="/setup/step-3" class="btn btn-outline-danger mt-3"><i class="fa fa-angle-left"></i>
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
