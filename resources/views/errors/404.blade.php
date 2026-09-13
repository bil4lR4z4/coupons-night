<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f8f9fa;
            height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            font-family:Arial, sans-serif;
        }

        .error-box{
            text-align:center;
        }

        .error-code{
            font-size:120px;
            font-weight:bold;
            color:#dc3545;
        }

        .error-text{
            font-size:28px;
            font-weight:600;
            margin-bottom:15px;
        }

        .error-desc{
            color:#6c757d;
            margin-bottom:25px;
        }
    </style>
</head>
<body>

    <div class="error-box">
        <div class="error-code">404</div>

        <div class="error-text">
            Oops! Page Not Found
        </div>

        <div class="error-desc">
            The page you are looking for does not exist.
        </div>

        <a href="{{ url('/') }}" class="btn btn-primary px-4">
            Go To Homepage
        </a>
    </div>

</body>
</html>