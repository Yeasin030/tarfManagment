<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'TurfBooking | Premium Football Turfs')</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: var(--nav-bg, rgba(11, 15, 13, 0.95)); backdrop-filter: blur(10px); border-bottom: 1px solid var(--nav-border, rgba(255,255,255,0.05));">
      <div class="container">
        <a class="navbar-brand text-body fw-bold d-flex align-items-center gap-2" href="{{ url('/') }}">
          <div class="bg-primary rounded-circle" style="width: 32px; height: 32px; display: grid; place-items: center;">
            <span class="text-white fw-bold">T</span>
          </div>
          TURFBOOKING
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('search*') ? 'active' : '' }}" href="{{ route('search') }}">Find Turf</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('tournaments*') ? 'active' : '' }}" href="{{ route('tournaments') }}">Tournaments</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('membership*') ? 'active' : '' }}" href="{{ route('membership') }}">Membership</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('offers*') ? 'active' : '' }}" href="{{ route('offers') }}">Offers</a>
            </li>
          </ul>
          <div class="d-flex gap-3 align-items-center">
            <!-- Theme Toggle Button -->
            <button id="theme-toggle" class="btn btn-link text-body text-decoration-none p-0 border-0" title="Toggle Theme">
              <svg id="theme-icon-moon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-moon-fill" viewBox="0 0 16 16">
                <path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278"/>
              </svg>
              <svg id="theme-icon-sun" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-sun-fill d-none" viewBox="0 0 16 16">
                <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708"/>
              </svg>
            </button>
            @auth
              <span class="text-muted small d-none d-md-inline">Hi, {{ explode(' ', Auth::user()->name)[0] }}</span>
              <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="btn btn-link text-body text-decoration-none p-0 border-0">Logout</button>
              </form>
            @else
              <a href="{{ route('login') }}" class="btn btn-link text-body text-decoration-none my-auto">Login</a>
              <a href="{{ route('register') }}" class="btn btn-outline-primary d-none d-lg-inline-block">Register</a>
            @endauth
          </div>
        </div>
      </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="mt-auto py-5 border-top border-secondary" style="background-color: var(--card-bg, #0b0f0d);">
      <div class="container py-4">
        <div class="row g-4">
          <div class="col-lg-4">
            <a class="navbar-brand font-heading fs-3 mb-3 d-block" href="{{ url('/') }}">TURF<span class="text-primary">BOOKING</span></a>
            <p class="text-muted pe-4">The ultimate digital platform for football turf booking, tournaments, and community management.</p>
          </div>
          <div class="col-lg-2 col-6">
            <h5 class="mb-3 font-heading">Platform</h5>
            <ul class="list-unstyled text-muted">
              <li class="mb-2"><a href="{{ route('search') }}" class="text-muted text-decoration-none">Find Turf</a></li>
              <li class="mb-2"><a href="{{ route('tournaments') }}" class="text-muted text-decoration-none">Tournaments</a></li>
              <li class="mb-2"><a href="{{ route('membership') }}" class="text-muted text-decoration-none">Membership</a></li>
              <li class="mb-2"><a href="{{ route('offers') }}" class="text-muted text-decoration-none">Offers</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-6">
            <h5 class="mb-3 font-heading">Support</h5>
            <ul class="list-unstyled text-muted">
              <li class="mb-2"><a href="#" class="text-muted text-decoration-none">FAQ</a></li>
              <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Terms</a></li>
              <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Privacy</a></li>
              <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Cancellation</a></li>
            </ul>
          </div>
          <div class="col-lg-4">
            <h5 class="mb-3 font-heading">Contact</h5>
            <ul class="list-unstyled text-muted">
              <li class="mb-2">📞 +880 1234 567890</li>
              <li class="mb-2">✉️ hello@turfbooking.com</li>
              <li class="mb-2">📍 Dhaka, Bangladesh</li>
            </ul>
          </div>
        </div>
        <div class="border-top border-secondary mt-4 pt-4 text-center text-muted small">
          &copy; 2026 TurfBooking. All rights reserved.
        </div>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
