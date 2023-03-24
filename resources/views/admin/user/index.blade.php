@extends('layout.admin')
@section('content')
    <div class="card card-custom">
        @include('admin.user.header')
        @include('admin.user.table_with_crud')
    </div>
@endsection
