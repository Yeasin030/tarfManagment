@extends('layouts.app')

@section('content')
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

    
@endsection

