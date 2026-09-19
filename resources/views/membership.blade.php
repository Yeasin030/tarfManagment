<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Membership | TurfBooking</title>
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
            <li class="nav-item"><a class="nav-link" href="{{ route('tournaments') }}">Tournaments</a></li>
            <li class="nav-item"><a class="nav-link active" href="{{ route('membership') }}">Membership</a></li>
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
        <h1 class="display-4 fw-bold text-white mb-3 animate-fade-in-up">Pro <span class="text-gradient">Membership</span></h1>
        <p class="text-muted fs-5 animate-fade-in-up delay-100">Unlock exclusive discounts, priority bookings, and more.</p>
      </div>
    </section>

    <!-- Content -->
    <section class="container py-5 mb-5">
      <div class="row justify-content-center g-4">
        
        @forelse($plans as $index => $plan)
        <div class="col-md-4 animate-fade-in-up delay-{{ ($index % 3 + 1) * 100 }}">
          <div class="card h-100 bg-dark {{ $plan->is_popular ? '' : 'border-secondary' }}" style="{{ $plan->is_popular ? 'border: 2px solid var(--primary-color);' : '' }}">
            <div class="card-body p-5 {{ $plan->is_popular ? 'position-relative' : 'text-center' }}">
              @if($plan->is_popular)
                <span class="position-absolute top-0 start-50 translate-middle badge bg-primary px-3 py-2">Most Popular</span>
              @endif
              
              <h4 class="text-white mb-3 {{ $plan->is_popular ? 'text-center' : '' }}">{{ $plan->name }}</h4>
              
              <h2 class="display-5 fw-bold {{ $plan->price > 0 ? 'text-primary' : 'text-white' }} mb-4 {{ $plan->is_popular ? 'text-center' : '' }}">
                @if($plan->price > 0)
                    ৳{{ number_format($plan->price, 0) }}<span class="fs-5 text-muted fw-normal">{{ $plan->billing_cycle }}</span>
                @else
                    Free
                @endif
              </h2>
              
              <ul class="list-unstyled text-start mb-4 {{ $plan->is_popular ? 'text-white' : 'text-muted' }}">
                @if(is_array($plan->features))
                    @foreach($plan->features as $feature)
                        <li class="mb-3">{{ $feature }}</li>
                    @endforeach
                @endif
              </ul>
              
              <button class="btn {{ $plan->is_popular ? 'btn-primary' : 'btn-outline-primary' }} w-100 mt-auto">
                 @if($plan->price == 0)
                    Current Plan
                 @else
                    Upgrade to {{ $plan->name }}
                 @endif
              </button>
            </div>
          </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <h3 class="text-muted">No membership plans available</h3>
            <p class="text-muted mb-0">Check back later!</p>
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
