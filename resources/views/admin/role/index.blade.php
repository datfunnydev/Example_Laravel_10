@extends('layout.admin')
@section('content')
    <div class="card card-custom">
        @include('admin.role.header')
        @include('admin.role.table_with_crud')
    </div>
@endsection
