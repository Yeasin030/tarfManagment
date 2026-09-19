<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email | TurfBooking</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100" style="background-color: var(--bg-color);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card p-4">
                    <div class="text-center mb-4">
                        <div class="bg-primary rounded-circle mx-auto mb-3" style="width: 48px; height: 48px; display: grid; place-items: center;">
                            <span class="text-dark fw-bold fs-4">T</span>
                        </div>
                        <h2 class="card-title text-white h3 mb-2">Verify Your Email</h2>
                        <p class="text-muted">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?</p>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success bg-success bg-opacity-10 text-success border-success text-center" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="d-grid gap-3">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">
                                Resend Verification Email
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary w-100">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
