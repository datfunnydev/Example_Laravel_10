<!doctype html>
<html lang=en-US>

<head>
    <meta content="text/html; charset=utf-8" http-equiv=Content-Type />
    <title>{{ __('Chào mừng gia nhập') }}</title>
    <meta name=description content="{{ __('Chào mừng gia nhập') }}">
    <style type=text/css>
        a:hover {
            text-decoration: underline !important
        }
    </style>
</head>

<body marginheight=0 topmargin=0 marginwidth=0 style=margin:0;background-color:#f2f3f8 leftmargin=0>
<table cellspacing=0 border=0 cellpadding=0 width=100% bgcolor=#f2f3f8
       style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700);font-family:'Open Sans',sans-serif">
    <tr>
        <td>
            <table style="background-color:#f2f3f8;max-width:670px;margin:0 auto" width=100% border=0 align=center
                   cellpadding=0 cellspacing=0>
                <tr>
                    <td style=height:80px>&nbsp;</td>
                </tr>
                <tr>
                    <td style=text-align:center>
                        <img height=75 src="https://i.ibb.co/vcDn8KN/FUNNYDEV-removebg-preview.png" alt=ogo border=0>
                    </td>
                </tr>
                <tr>
                    <td style=height:20px>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table width=95% border=0 align=center cellpadding=0 cellspacing=0
                               style="max-width:670px;background:#fff;border-radius:3px;text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06)">
                            <tr>
                                <td style=height:40px>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="padding:0 35px">
                                    <h1
                                        style="color:#1e1e2d;font-weight:500;margin:0;font-size:32px;font-family:'Rubik',sans-serif">
                                        {{ __('Chào mừng bạn đến với') }} {{ config('app.name') }}</h1>
                                    <span
                                        style="display:inline-block;vertical-align:middle;margin:29px 0 26px;border-bottom:1px solid #cecece;width:100px"></span>
                                    <p style=color:#455056;font-size:15px;line-height:24px;margin:0;text-align:left>
                                        {{ __('Xin chào') }}, {{ $res['name'] }}
                                    </p>
                                    <p style=color:#455056;font-size:15px;line-height:24px;margin:0;text-align:left>
                                        {{ __('Bạn được mời tham gia') }} {{ config('app.name') }}
                                        {{ __('bởi') }} {{ $res['created_by'] }}.
                                        {{ __('Đây là thông tin tài khoản của bạn') }}:
                                    </p>
                                    <div style="margin-left: 20px">
                                        <p
                                            style=color:#455056;font-size:15px;line-height:24px;margin:0;text-align:left>
                                            <strong>{{ __('Họ và tên') }}</strong>: {{ $res['name'] }}
                                        </p>
                                        <p
                                            style=color:#455056;font-size:15px;line-height:24px;margin:0;text-align:left>
                                            <strong>Email</strong>: {{ $res['email'] }}
                                        </p>
                                        <p
                                            style=color:#455056;font-size:15px;line-height:24px;margin:0;text-align:left>
                                            <strong>{{ __('Mật khẩu') }}</strong>: {{ $res['password'] }}
                                        </p>
                                    </div>
                                    <p style=color:#455056;font-size:15px;line-height:24px;margin:0;text-align:left>
                                        {{ __('Ngay bây giờ bạn có thể mở hệ thống để bổ sung thông tin & đổi mật khẩu và bắt đầu làm việc ngay lập tức') }}.
                                    </p>
                                    <h1
                                        style="background:#20e277;text-decoration:none!important;font-weight:500;margin-top:35px;color:#fff;text-transform:uppercase;font-size:20px;padding:15px 40px;display:inline-block;border-radius:50px">
                                        <a style="color: #fff" target="_blank"
                                           href="{{ $res['url'] }}">{{ __('Bắt đầu làm việc') }}</a>
                                    </h1>
                                </td>
                            </tr>
                            <tr>
                                <td style=height:40px>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                <tr>
                    <td style=height:20px>&nbsp;</td>
                </tr>
                <tr>
                    <td style=text-align:center>
                        <p style=font-size:14px;color:rgba(69,80,86,0.7411764705882353);line-height:18px;margin:0>
                            {{ date('Y') }} © {{ __('Công ty Cổ phần Giải pháp số Funny Dev') }}</p>
                    </td>
                </tr>
                <tr>
                    <td style=height:80px>&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>

</html>
