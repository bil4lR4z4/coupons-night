<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: #f4f6f9;">

<div class="container">
    <div class="row justify-content-center align-items-center vh-100">

        <div class="col-md-5">
            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-body p-4">

                    <h3 class="text-center mb-4 fw-bold">Admin Panel Login</h3>

                    <x-form method="POST" action="{{ route('login') }}">
                        <x-input 
                            name="login"
                            label="Email Address / Username"
                            type="text"
                            placeholder="Enter your email / username"
                            required="true"
                        />

                        <x-password
                            name="password"
                            label="Password"
                            placeholder="Enter password"
                        />

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>
                
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary rounded-3">
                                Login
                            </button>
                        </div>
                    </x-form>
                </div>
            </div>

            <p class="text-center mt-3 text-muted">
                © {{ date('Y') }} Admin Panel
            </p>
        </div>

    </div>
</div>

</body>
</html>