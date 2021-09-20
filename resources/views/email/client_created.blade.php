@extends('email.base')

@section('title')
    Welcome {{ $client_name }}
@endsection

@section('content')
    We're excited to have you on board! To start using the Bright FM Group Management Application, we need you to
    confirm the account that's been created for you.
    <br><br>
    After confirming the account, we'll need you to specify the account password. Make sure you select a strong
    password that can't be guessed, we're counting on you helping us keep your account safe :)
    <br><br><br>
    Here's the username you'll be using to access the application from now on:&nbsp;
    <br><br><br>
    <p style="margin:0;color:#2196F3">
        Username: <strong>{{ $username }}</strong>
        <br><br>
        Link to the app: <a href="{{ $app_url }}"><strong>{{ $app_url }}</strong></a>
    </p>

    <p style="text-align: center">
        <span class="es-button-border"
              style="border-style:solid;border-color:#FFA73B;background:1px;border-width:1px;display:inline-block;border-radius:2px;width:auto"><a
                href="{{ $confirm_url }}"
                class="es-button" target="_blank"
                style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;font-size:20px;color:#FFFFFF;border-style:solid;border-color:#FFA73B;border-width:15px 30px;display:inline-block;background:#FFA73B;border-radius:2px;font-weight:normal;font-style:normal;line-height:24px;width:auto;text-align:center">
                Confirm Account
            </a>
        </span>
    </p>

{{--    <p>--}}
{{--        If you have any questions, hit us up via email —we're always happy to help out.--}}
{{--        <br><br>--}}
{{--        Cheers,--}}
{{--        <br><br>--}}
{{--        Bright FM Group--}}
{{--    </p>--}}
@endsection
