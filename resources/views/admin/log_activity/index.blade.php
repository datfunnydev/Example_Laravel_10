@extends('layout.admin')
@section('content')
    <div class="card card-custom">
        @include('admin.log_activity.header')
        @include('admin.log_activity.table_only_view')
    </div>
@endsection
