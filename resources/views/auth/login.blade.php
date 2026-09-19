<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | TurfBooking</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
      body {
        background: radial-gradient(circle at top right, rgba(23, 37, 28, 0.4), transparent 50%),
                    radial-gradient(circle at bottom left, rgba(23, 37, 28, 0.4), transparent 50%),
                    #0b0f0d;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .auth-card {
        background-color: rgba(21, 26, 23, 0.7);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5">
          
          <div class="text-center mb-4 animate-fade-in-up">
            <a href="{{ url('/') }}" class="text-decoration-none d-inline-flex align-items-center gap-2 mb-3">
              <div class="bg-primary rounded-circle" style="width: 40px; height: 40px; display: grid; place-items: center;">
                <span class="text-dark fw-bold fs-5">T</span>
              </div>
              <span class="text-white fw-bold fs-4 tracking-wider">TURFBOOKING</span>
            </a>
            <h2 class="text-white fw-bold">Welcome Back</h2>
            <p class="text-muted">Enter your credentials to access your account</p>
          </div>

          <div class="auth-card p-4 p-md-5 animate-fade-in-up delay-100">
            <form method="POST" action="{{ route('login') }}">
              @csrf

              @if ($errors->any())
                  <div class="alert alert-danger bg-danger bg-opacity-10 border-danger text-danger">
                      <ul class="mb-0">
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif

              <div class="mb-4">
                <label for="email" class="form-label text-muted small fw-bold tracking-wider text-uppercase">Email Address</label>
                <input type="email" class="form-control form-control-lg bg-dark border-secondary text-white" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="name@example.com">
              </div>

              <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label for="password" class="form-label text-muted small fw-bold tracking-wider text-uppercase mb-0">Password</label>
                    <a href="#" class="small text-primary text-decoration-none">Forgot password?</a>
                </div>
                <input type="password" class="form-control form-control-lg bg-dark border-secondary text-white" id="password" name="password" required placeholder="••••••••">
              </div>

              <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input border-secondary" id="remember" name="remember">
                <label class="form-check-label text-muted small" for="remember">Remember me for 30 days</label>
              </div>

              <button type="submit" class="btn btn-primary btn-lg w-100 mb-4 fw-bold">Sign In</button>

              <p class="text-center text-muted small mb-0">
                Don't have an account? <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-bold">Create one now</a>
              </p>
            </form>
          </div>

        </div>
      </div>
    </div>
  </body>
</html>
