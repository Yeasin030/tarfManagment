@extends('layouts.app')

@section('content')
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

    
@endsection

