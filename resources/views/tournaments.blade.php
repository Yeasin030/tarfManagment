<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tournaments | TurfBooking</title>
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
            <li class="nav-item"><a class="nav-link active" href="{{ route('tournaments') }}">Tournaments</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('membership') }}">Membership</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('offers') }}">Offers</a></li>
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

    <!-- Header Section -->
    <section class="mt-5 pt-5 pb-4" style="background: linear-gradient(to bottom, #111a14, #0b0f0d);">
      <div class="container py-5 text-center">
        <h1 class="display-4 fw-bold text-white mb-3 animate-fade-in-up">Upcoming <span class="text-gradient">Tournaments</span></h1>
        <p class="text-muted fs-5 animate-fade-in-up delay-100">Compete with the best teams and win exciting prizes.</p>
      </div>
    </section>

    <!-- Content -->
    <section class="container py-5 mb-5">
      <div class="row g-4">
        @forelse($tournaments as $index => $tournament)
        <div class="col-md-6 animate-fade-in-up delay-{{ ($index % 2 + 1) * 100 }}">
          <div class="card h-100 border-secondary bg-dark">
            <div style="height: 200px; background: url('{{ $tournament->image_path ?? '/hero-bg.jpg' }}') center/cover; position: relative; {{ $tournament->status == 'completed' ? 'filter: grayscale(80%);' : '' }}">
               <div class="position-absolute top-0 start-0 p-2 m-2">
                 @if($tournament->status == 'open')
                    <span class="badge bg-danger">Registration Open</span>
                 @elseif($tournament->status == 'closed')
                    <span class="badge bg-secondary">Registration Closed</span>
                 @else
                    <span class="badge bg-info">Completed</span>
                 @endif
               </div>
            </div>
            <div class="card-body p-4">
              <h4 class="card-title text-white mb-1">{{ $tournament->name }}</h4>
              <p class="text-muted small mb-3">📍 {{ $tournament->location }} • {{ \Carbon\Carbon::parse($tournament->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($tournament->end_date)->format('M d, Y') }}</p>
              <div class="d-flex flex-wrap gap-2 mb-4">
                <span class="badge bg-dark border border-secondary text-light">{{ $tournament->format }}</span>
                <span class="badge bg-dark border border-secondary text-light">Prize: ৳{{ number_format($tournament->prize_pool, 0) }}</span>
                <span class="badge bg-dark border border-secondary text-light">Entry: ৳{{ number_format($tournament->entry_fee, 0) }}</span>
              </div>
            </div>
            <div class="card-footer bg-transparent border-top border-secondary p-3">
               @if($tournament->status == 'open')
                   <button class="btn btn-primary w-100">Register Team</button>
               @elseif($tournament->status == 'closed')
                   <button class="btn btn-outline-secondary w-100" disabled>Registration Full</button>
               @else
                   <button class="btn btn-outline-secondary w-100" disabled>View Results</button>
               @endif
            </div>
          </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <h3 class="text-muted">No upcoming tournaments</h3>
            <p class="text-muted mb-0">Check back later for exciting events!</p>
        </div>
        @endforelse
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
