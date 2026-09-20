@extends('layouts.app')

@section('title', 'Search Results | TurfBooking')

@section('content')

    <!-- Search Section (Compact) -->
    <section class="container mt-5 pt-5 pb-4">
      <div class="search-container animate-fade-in-up">
        <form action="{{ route('search') }}" method="GET" class="row g-3 align-items-end">
          <div class="col-md-3">
            <label class="form-label text-muted small mb-1">Location</label>
            <input type="text" name="location" class="form-control" placeholder="City or Area" value="{{ request('location') }}">
          </div>
          <div class="col-md-3">
            <label class="form-label text-muted small mb-1">Date</label>
            <input type="date" name="date" class="form-control" value="{{ request('date') }}">
          </div>
          <div class="col-md-3">
            <label class="form-label text-muted small mb-1">Players</label>
            <select name="type" class="form-select">
              <option value="Any" {{ request('type') == 'Any' ? 'selected' : '' }}>Any</option>
              <option value="5-a-side" {{ request('type') == '5-a-side' ? 'selected' : '' }}>5-a-side</option>
              <option value="7-a-side" {{ request('type') == '7-a-side' ? 'selected' : '' }}>7-a-side</option>
              <option value="9-a-side" {{ request('type') == '9-a-side' ? 'selected' : '' }}>9-a-side</option>
              <option value="11-a-side" {{ request('type') == '11-a-side' ? 'selected' : '' }}>11-a-side</option>
            </select>
          </div>
          <div class="col-md-3">
            <button type="submit" class="btn btn-primary w-100">Update Search</button>
          </div>
        </form>
      </div>
    </section>

    <!-- Search Results -->
    <section class="container py-4 mb-5">
      <h2 class="section-title text-start mb-4">Found <span class="text-gradient">{{ $turfs->count() }} Turfs</span></h2>
      
      @if($turfs->isEmpty())
        <div class="text-center py-5">
            <h3 class="text-muted">No turfs found matching your criteria.</h3>
            <p class="text-muted">Try adjusting your filters or location.</p>
        </div>
      @else
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
               <a href="{{ url('/turf/'.$turf->slug) }}" class="btn btn-outline-primary flex-grow-1">Details</a>
               <a href="{{ url('/book/'.$turf->slug) }}" class="btn btn-primary flex-grow-1">Book</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @endif
    </section>

@endsection
