<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $turf->name }} | TurfBooking</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: rgba(11, 15, 13, 0.95); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(255,255,255,0.05);">
      <div class="container">
        <a class="navbar-brand text-white fw-bold d-flex align-items-center gap-2" href="{{ url('/') }}">
          <div class="bg-primary rounded-circle" style="width: 32px; height: 32px; display: grid; place-items: center;">
            <span class="text-dark fw-bold">T</span>
          </div>
          TURFBOOKING
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('search') }}">Find Turf</a></li>
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
            @endauth
          </div>
        </div>
      </div>
    </nav>

    <!-- Header Image -->
    <section class="mt-5 pt-5">
      <div class="container">
        <div style="height: 400px; background: url('{{ $turf->images->first()?->image_path ?? '/hero-bg.jpg' }}') center/cover; border-radius: 12px; position: relative;">
          <div class="position-absolute bottom-0 start-0 p-4 w-100" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); border-radius: 0 0 12px 12px;">
            <span class="badge bg-primary mb-2">★ {{ number_format(rand(40, 50) / 10, 1) }}</span>
            <h1 class="display-4 fw-bold text-white mb-0">{{ $turf->name }}</h1>
            <p class="text-white mb-0 fs-5">📍 {{ $turf->address }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Turf Details Content -->
    <section class="container py-5 mb-5">
      <div class="row g-5">
        
        <!-- Main Info -->
        <div class="col-lg-8 animate-fade-in-up">
          <div class="mb-5">
            <h3 class="mb-3">About the Turf</h3>
            <p class="text-muted fs-5" style="line-height: 1.8;">
              {{ $turf->description ?? 'Experience premium football on our high-quality artificial turf. Designed for maximum performance and safety, our facility is perfect for friendly matches, competitive tournaments, and corporate events.' }}
            </p>
          </div>
          
          <div class="mb-5">
            <h3 class="mb-3">Facilities</h3>
            <div class="row g-3">
              <div class="col-sm-6">
                <div class="p-3 rounded border border-secondary" style="background-color: rgba(255,255,255,0.02);">
                  <h5 class="mb-1">⚽ {{ $turf->turf_type }}</h5>
                  <p class="text-muted small mb-0">FIFA Standard Artificial Grass</p>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="p-3 rounded border border-secondary" style="background-color: rgba(255,255,255,0.02);">
                  <h5 class="mb-1">👥 {{ $turf->capacity }} Players</h5>
                  <p class="text-muted small mb-0">Recommended capacity</p>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="p-3 rounded border border-secondary" style="background-color: rgba(255,255,255,0.02);">
                  <h5 class="mb-1">💡 Floodlights</h5>
                  <p class="text-muted small mb-0">High-intensity LED lighting</p>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="p-3 rounded border border-secondary" style="background-color: rgba(255,255,255,0.02);">
                  <h5 class="mb-1">🚗 Parking</h5>
                  <p class="text-muted small mb-0">Free secure parking available</p>
                </div>
              </div>
            </div>
          </div>
          
          <div class="mb-5">
            <h3 class="mb-3">Location & Hours</h3>
            <div class="p-4 rounded border border-secondary" style="background-color: rgba(255,255,255,0.02);">
               <p class="text-muted mb-2"><strong>Address:</strong> {{ $turf->address }}</p>
               <p class="text-muted mb-2"><strong>Hours:</strong> {{ \Carbon\Carbon::parse($turf->opening_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($turf->closing_time)->format('h:i A') }}</p>
               <p class="text-muted mb-0"><strong>Phone:</strong> {{ $turf->phone ?? '+880 1234-567890' }}</p>
            </div>
          </div>
        </div>

        <!-- Booking Sidebar -->
        <div class="col-lg-4 animate-fade-in-up delay-200">
          <div class="card bg-dark border-secondary sticky-top" style="top: 100px;">
            <div class="card-body p-4">
              <h3 class="card-title text-white mb-4">Book a Slot</h3>
              
              <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom border-secondary">
                <span class="text-muted">Price per 90 mins</span>
                <span class="fs-4 fw-bold text-primary">৳{{ number_format($turf->starting_price, 0) }}</span>
              </div>
              
              <form action="{{ url('/book/'.$turf->slug) }}" method="GET">
                <div class="mb-3">
                  <label class="form-label text-muted small">Select Date</label>
                  <input type="date" name="date" class="form-control bg-transparent text-white border-secondary" required>
                </div>
                
                <div class="mb-4">
                  <label class="form-label text-muted small">Select Time</label>
                  <select name="time" class="form-select bg-transparent text-white border-secondary" required>
                    <option class="text-dark" value="" disabled selected>Choose a slot</option>
                    <option class="text-dark" value="16:30">4:30 PM - 6:00 PM</option>
                    <option class="text-dark" value="18:00">6:00 PM - 7:30 PM</option>
                    <option class="text-dark" value="19:30">7:30 PM - 9:00 PM</option>
                    <option class="text-dark" value="21:00">9:00 PM - 10:30 PM</option>
                    <option class="text-dark" value="22:30">10:30 PM - 12:00 AM</option>
                  </select>
                </div>
                
                <button type="submit" class="btn btn-primary btn-lg w-100">Proceed to Booking</button>
              </form>
              
              <p class="text-muted small text-center mt-3 mb-0">You won't be charged yet</p>
            </div>
          </div>
        </div>
        
      </div>
    </section>

    <!-- Footer -->
    <footer class="mt-auto py-5 border-top border-secondary" style="background-color: #0b0f0d;">
      <div class="container text-center">
        <p class="text-muted mb-0">&copy; 2026 TurfBooking. All rights reserved.</p>
      </div>
    </footer>
  </body>
</html>
