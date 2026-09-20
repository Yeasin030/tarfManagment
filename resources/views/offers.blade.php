@extends('layouts.app')

@section('content')
<!-- Header Section -->
    <section class="mt-5 pt-5 pb-4" style="background: linear-gradient(to bottom, #111a14, #0b0f0d);">
      <div class="container py-5 text-center">
        <h1 class="display-4 fw-bold text-white mb-3 animate-fade-in-up">Special <span class="text-gradient">Offers</span></h1>
        <p class="text-muted fs-5 animate-fade-in-up delay-100">Don't miss out on these limited-time deals for your next game.</p>
      </div>
    </section>

    <!-- Content -->
    <section class="container py-5 mb-5">
      <div class="row g-4">
        
        @forelse($offers as $index => $offer)
        <div class="col-md-6 animate-fade-in-up delay-{{ ($index % 2 + 1) * 100 }}">
          <div class="card h-100 border-primary bg-dark text-center p-5" style="background: radial-gradient(circle at center, rgba(10, 186, 129, 0.1), transparent); border-style: dashed !important;">
            <div class="card-body">
              @if($offer->badge_text)
                <span class="badge bg-primary mb-3">{{ $offer->badge_text }}</span>
              @endif
              <h3 class="text-white mb-3">{{ $offer->title }}</h3>
              <p class="text-muted mb-4">{{ $offer->description }}</p>
              
              @if($offer->code)
              <div class="p-3 bg-secondary bg-opacity-10 rounded d-inline-block border border-secondary mb-3">
                <h4 class="text-primary fw-bold mb-0 font-monospace tracking-wider">{{ $offer->code }}</h4>
              </div>
              @endif
            </div>
          </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <h3 class="text-muted">No active offers at the moment</h3>
            <p class="text-muted mb-0">Check back later for exciting deals!</p>
        </div>
        @endforelse

      </div>
    </section>

    
@endsection

