@extends('email.base')

@section('title')
    Hello {{ $full_name }}
@endsection

@section('content')

    <p>
        You are receiving this email in order to reset the password for accessing BrightFM Portal Application.
        If you didn't request the password to be reset, you can ignore this email.
    </p>

    <p>
        To reset the password, follow this link: <a href="{{ $reset_link }}">Reset Password</a>.
    </p>
@endsection

