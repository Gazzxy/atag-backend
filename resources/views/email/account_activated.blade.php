@extends('email.base')

@section('title')
    Account Activated
@endsection

@section('content')
    Hello {{ $name }}!<br><br>Your account has been activated and is ready to be used! Head over to the below URL and log in. In case you need help, contact us.
@endsection

@section('additional')
    <tr style="border-collapse:collapse">
        <td class="es-m-txt-l" bgcolor="#ffffff" align="left" style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:30px;padding-right:30px">
            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#2196F3">
                Username: <strong>{{ $username }}</strong>
                <br>
                Link to the app: <strong>{{ $app_url }}</strong>
            </p>
        </td>
    </tr>

    <tr style="border-collapse:collapse">
        <td align="center" style="Margin:0;padding-left:10px;padding-right:10px;padding-top:35px;padding-bottom:35px">
            <a href="{{ $app_url }}" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;font-size:20px;color:#FFFFFF;border-style:solid;border-color:#FFA73B;border-width:15px 30px;display:inline-block;background:#FFA73B;border-radius:2px;font-weight:normal;font-style:normal;line-height:24px;width:auto;text-align:center">Open Portal Login Page</a>
        </td>
    </tr>
@endsection
