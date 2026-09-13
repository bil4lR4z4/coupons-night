@php
$setting = \App\Models\Setting::first();
@endphp

<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>

        .info-table{
            width:100%;
            border-collapse:collapse;
        }

        .info-table td{
            padding:12px;
            vertical-align:top;
            word-break:break-word;
        }

        .info-table td:first-child{
            width:140px;
            font-weight:bold;
        }

        @media only screen and (max-width:600px){

            .info-table,
            .info-table tbody,
            .info-table tr,
            .info-table td{
                display:block;
                width:100% !important;
            }

            .info-table td{
                padding:6px 0;
            }

            .info-table td:first-child{
                width:100%;
                padding-top:15px;
            }

        }

    </style>

</head>

<body style="margin:0;padding:40px 20px;background:#f5f5f5;font-family:Arial,sans-serif;">

    <div style="max-width:700px;margin:auto;background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 5px 20px rgba(0,0,0,0.08);">

        <!-- Header -->
        <div style="padding:35px 30px;text-align:center;border-bottom:1px solid #ececec;">

            <img src="{{ config('app.url').'/'.$setting->site_logo }}"
                 alt="Logo"
                 style="max-height:55px;max-width:220px;">

        </div>

        <!-- Content -->
        <div style="padding:20px 35px;color:#333;line-height:1.8;">
            @yield('content')
        </div>

        <!-- Divider -->
        <div style="height:1px;background:#ececec;"></div>

        <!-- Footer -->
        <div style="padding:25px;text-align:center;background:#fafafa;">

            <p style="margin:0;color:#777;font-size:14px;">
                Thank you for choosing {{ config('app.name') }}
            </p>

            <p style="margin-top:10px;color:#999;font-size:13px;">
                © {{ date('Y') }} {{ config('app.name') }}. All Rights Reserved.
            </p>

        </div>

    </div>

</body>

</html>