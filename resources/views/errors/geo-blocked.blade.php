<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family: 'Inter', sans-serif;
            background:#f5f7fb;
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:30px;
            overflow:hidden;
            position:relative;
        }

        body::before{
            content:'';
            position:absolute;
            width:600px;
            height:600px;
            background:radial-gradient(circle,#eef2ff 0%, transparent 70%);
            top:-250px;
            right:-250px;
        }

        body::after{
            content:'';
            position:absolute;
            width:700px;
            height:700px;
            background:radial-gradient(circle,#ffeaea 0%, transparent 70%);
            bottom:-300px;
            left:-250px;
        }

        .geo-card{
            position:relative;
            width:100%;
            max-width:700px;
            background:#fff;
            border-radius:28px;
            padding:60px 50px;
            text-align:center;
            box-shadow:
                0 10px 40px rgba(0,0,0,0.08);
            z-index:2;
            border:1px solid #eceef5;
        }

        .icon-wrap{
            width:90px;
            height:90px;
            margin:auto;
            border-radius:50%;
            background:linear-gradient(135deg,#ff6b6b,#ff2e63);
            display:flex;
            align-items:center;
            justify-content:center;
            margin-bottom:35px;
            box-shadow:
                0 20px 40px rgba(255,70,70,0.25);
        }

        .icon-wrap svg{
            width:45px;
            height:45px;
            fill:#fff;
        }

        h1{
            font-size:32px;
            color:#111827;
            font-weight:700;
            margin-bottom:18px;
            letter-spacing:-1px;
        }

        .line{
            width:50px;
            height:3px;
            background:#ff4d4d;
            border-radius:50px;
            margin:0 auto 28px;
        }

        .desc{
            font-size:12px;
            line-height:1.8;
            color:#6b7280;
            max-width:520px;
            margin:auto auto 35px;
        }

        .country-box{
            display:flex;
            align-items:center;
            gap:18px;
            background:#fff5f5;
            border:1px solid #ffd6d6;
            border-radius:18px;
            padding:22px;
            margin:0 auto 35px;
            max-width:450px;
            text-align:left;
        }

        .country-icon{
            width:65px;
            height:65px;
            border-radius:50%;
            background:#ffe4e4;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:30px;
        }

        .country-text small{
            display:block;
            color:#6b7280;
            font-size:14px;
            margin-bottom:5px;
        }

        .country-text strong{
            color:#ff3b3b;
            font-size:30px;
            font-weight:700;
        }

        .info-box{
            border-top:1px solid #eceef5;
            padding-top:30px;
            margin-top:10px;
        }

        .info-box h3{
            font-size:28px;
            color:#111827;
            margin-bottom:15px;
        }

        .info-box p{
            color:#6b7280;
            font-size:17px;
            line-height:1.8;
            max-width:500px;
            margin:auto;
        }

        .btn{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:10px;
            margin-top:35px;
            text-decoration:none;
            background:linear-gradient(135deg,#2563eb,#1d4ed8);
            color:#fff;
            padding:16px 34px;
            border-radius:14px;
            font-size:16px;
            font-weight:600;
            transition:0.3s ease;
            box-shadow:
                0 12px 25px rgba(37,99,235,0.25);
        }

        .btn:hover{
            transform:translateY(-2px);
        }

        .footer{
            margin-top:45px;
            font-size:14px;
            color:#9ca3af;
        }

        @media(max-width:768px){

            .geo-card{
                padding:45px 25px;
            }

            h1{
                font-size:38px;
            }

            .desc{
                font-size:17px;
            }

            .country-box{
                flex-direction:column;
                text-align:center;
            }

        }

    </style>

</head>
<body>

    <div class="geo-card">

        <div class="icon-wrap">

            <svg viewBox="0 0 24 24">
                <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1ZM12 13.5C10.62 13.5 9.5 12.38 9.5 11C9.5 9.62 10.62 8.5 12 8.5C13.38 8.5 14.5 9.62 14.5 11C14.5 12.38 13.38 13.5 12 13.5ZM16 18H8V16.75C8 15.79 8.79 15 9.75 15H14.25C15.21 15 16 15.79 16 16.75V18Z"/>
            </svg>

        </div>

        <h1>Access Denied</h1>

        <div class="line"></div>

        <p class="desc">
            Sorry! This website or content is currently unavailable
            in your region due to geographical restrictions.
        </p>

        @isset($country)

        <div class="country-box">

            <div class="country-icon">
                🌍
            </div>

            <div class="country-text">
                <small>Your country code</small>
                <strong>{{ $country }}</strong>
            </div>

        </div>

        @endisset

        <div class="info-box">

            <h3>What can you do?</h3>

            <p>
                If you believe this restriction is a mistake,
                please contact our support team for further assistance.
            </p>

        </div>

        <div class="footer">
            © {{ date('Y') }} CouponNight. All rights reserved.
        </div>

    </div>

</body>
</html>