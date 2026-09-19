<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TurfBooking | Premium Football Turfs</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;700;800&display=swap" rel="stylesheet">
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
      <div class="container">
        <a class="navbar-brand font-heading" href="#">TURF<span class="text-primary">BOOKING</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('search') }}">Find Turf</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('tournaments') }}">Tournaments</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('membership') }}">Membership</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('offers') }}">Offers</a>
            </li>
          </ul>
          <div class="d-flex gap-3 align-items-center">
            @auth
              <span class="text-muted small d-none d-md-inline">Hi, {{ explode(' ', Auth::user()->name)[0] }}</span>
              <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="btn btn-link text-white text-decoration-none p-0 border-0">Logout</button>
              </form>
            @else
              <a href="{{ route('login') }}" class="btn btn-link text-white text-decoration-none my-auto">Login</a>
              <a href="{{ route('register') }}" class="btn btn-outline-primary d-none d-lg-inline-block">Register</a>
            @endauth
          </div>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
      <div class="container text-center">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <h1 class="hero-title animate-fade-in-up">PLAY. BOOK. <span class="text-gradient">COMPETE.</span></h1>
            <p class="hero-subtitle animate-fade-in-up delay-100">Find and book the best premium football turfs near you instantly.</p>
            <div class="d-flex gap-3 justify-content-center mt-4 animate-fade-in-up delay-200">
              <button class="btn btn-primary btn-lg">Find a Turf</button>
              <button class="btn btn-outline-primary btn-lg">Explore Tournaments</button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Search Section -->
    <section class="container" style="position: relative; z-index: 20;">
      <div class="search-container animate-fade-in-up delay-300">
        <form action="{{ route('search') }}" method="GET" class="row g-3 align-items-end">
          <div class="col-md-3">
            <label class="form-label text-muted small mb-1">Location</label>
            <input type="text" name="location" class="form-control form-control-lg" placeholder="City or Area">
          </div>
          <div class="col-md-3">
            <label class="form-label text-muted small mb-1">Date</label>
            <input type="date" name="date" class="form-control form-control-lg">
          </div>
          <div class="col-md-3">
            <label class="form-label text-muted small mb-1">Players</label>
            <select name="type" class="form-select form-select-lg">
              <option value="Any">Any</option>
              <option value="5-a-side">5-a-side</option>
              <option value="7-a-side">7-a-side</option>
              <option value="9-a-side">9-a-side</option>
              <option value="11-a-side">11-a-side</option>
            </select>
          </div>
          <div class="col-md-3">
            <button type="submit" class="btn btn-primary btn-lg w-100">Search Turfs</button>
          </div>
        </form>
      </div>
    </section>

    <!-- Featured Turfs -->
    <section class="container py-5 mt-5">
      <h2 class="section-title">Featured <span class="text-gradient">Turfs</span></h2>
      <div class="row g-4">
        
        @foreach ($turfs as $index => $turf)
        <div class="col-md-4 animate-fade-in-up delay-{{ ($index % 3 + 1) * 100 }}">
          <div class="card h-100 overflow-hidden border-0">
            <div style="height: 200px; background: url('{{ $turf->images->first()?->image_path ?? '/hero-bg.jpg' }}') center/cover; position: relative;">
               <div class="position-absolute top-0 end-0 p-2">
                 <span class="badge bg-dark">★ {{ number_format(rand(40, 50) / 10, 1) }}</span>
               </div>
            </div>
            <div class="card-body p-4">
              <h4 class="card-title mb-1">{{ $turf->name }}</h4>
              <p class="text-muted small mb-3">📍 {{ $turf->address }}</p>
              
              <div class="d-flex flex-wrap gap-2 mb-4">
                <span class="badge bg-dark border border-secondary text-light">⚽ {{ $turf->turf_type }}</span>
                <span class="badge bg-dark border border-secondary text-light">👥 {{ $turf->capacity }} Players</span>
              </div>
              
              <div class="d-flex justify-content-between align-items-center mt-auto">
                <div>
                  <small class="text-muted d-block">Starting from</small>
                  <span class="fs-5 fw-bold text-white">৳{{ number_format($turf->starting_price, 0) }} <small class="text-muted fs-6 fw-normal">/ hr</small></span>
                </div>
              </div>
            </div>
            <div class="card-footer bg-transparent border-top border-secondary p-3 d-flex gap-2">
               <a href="{{ route('turf.show', $turf->slug) }}" class="btn btn-outline-primary flex-grow-1">Details</a>
               <a href="{{ url('/book/'.$turf->slug) }}" class="btn btn-primary flex-grow-1">Book</a>
            </div>
          </div>
        </div>
        @endforeach

      </div>
    </section>

    <!-- How It Works -->
    <section class="py-5" style="background-color: #080c0a;">
      <div class="container py-5">
        <h2 class="section-title">How It <span class="text-gradient">Works</span></h2>
        <div class="row text-center g-4">
          <div class="col-md-4 animate-fade-in-up delay-100">
            <div class="p-4 glass-card h-100 border-0">
              <h1 class="display-3 text-primary font-heading opacity-50 mb-3">01</h1>
              <h3 class="font-heading mb-3">Find</h3>
              <p class="text-muted">Find your favorite premium football turf using our advanced search and filters.</p>
            </div>
          </div>
          <div class="col-md-4 animate-fade-in-up delay-200">
            <div class="p-4 glass-card h-100 border-0">
              <h1 class="display-3 text-primary font-heading opacity-50 mb-3">02</h1>
              <h3 class="font-heading mb-3">Book</h3>
              <p class="text-muted">Select your date, preferred time slot, and securely pay online or at venue.</p>
            </div>
          </div>
          <div class="col-md-4 animate-fade-in-up delay-300">
            <div class="p-4 glass-card h-100 border-0">
              <h1 class="display-3 text-primary font-heading opacity-50 mb-3">03</h1>
              <h3 class="font-heading mb-3">Play</h3>
              <p class="text-muted">Arrive with your team, scan your booking QR, and enjoy your game.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 border-top" style="border-color: rgba(255,255,255,0.05) !important; background-color: var(--card-bg);">
      <div class="container py-4">
        <div class="row g-4">
          <div class="col-lg-4">
            <a class="navbar-brand font-heading fs-3 mb-3 d-block" href="#">TURF<span class="text-primary">BOOKING</span></a>
            <p class="text-muted pe-4">The ultimate digital platform for football turf booking, tournaments, and community management.</p>
          </div>
          <div class="col-lg-2 col-6">
            <h5 class="text-white mb-3 font-heading">Platform</h5>
            <ul class="list-unstyled text-muted">
              <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Find Turf</a></li>
              <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Tournaments</a></li>
              <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Membership</a></li>
              <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Offers</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-6">
            <h5 class="text-white mb-3 font-heading">Support</h5>
            <ul class="list-unstyled text-muted">
              <li class="mb-2"><a href="#" class="text-muted text-decoration-none">FAQ</a></li>
              <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Terms</a></li>
              <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Privacy</a></li>
              <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Cancellation</a></li>
            </ul>
          </div>
          <div class="col-lg-4">
            <h5 class="text-white mb-3 font-heading">Contact</h5>
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

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

