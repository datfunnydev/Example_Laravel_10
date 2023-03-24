@extends('layout.setup')
@section('content')
    <div class="row mt-3 p-5">
        <div class="col-12 text-center">
            <div class="col-12 mb-2"><i class="fa fa-check-circle fa-4x text-success" aria-hidden="true"></i>
                <h1>{{'Cài đặt thành công'}}</h1></div>
            <div
                class="col-12 mb-2">{{__('Các biến môi trường đã thay đổi của bạn được đặt trong Tệp .env ngay bây giờ.')}}</div>
            <div class="col-12 mb-2"><a
                    href="{{url('/login')}}">{{__('Nhấn vào đây')}}</a> {{__('để tiến hành đăng nhập và sử dụng phần mềm')}}
            </div>
        </div>
    </div>
@endsection
