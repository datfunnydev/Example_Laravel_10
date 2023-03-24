@extends('layout.error')

@section('title', '403')
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Trang này bị cấm'))
