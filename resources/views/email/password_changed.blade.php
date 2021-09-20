@extends('email.base')

@section('title')
    Hello {{ $full_name }}
@endsection

@section('content')
    Your password for accessing BrightFM Management Portal has been reset successfully.
@endsection
