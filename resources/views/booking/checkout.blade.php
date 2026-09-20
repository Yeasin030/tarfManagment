@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5 pb-5">
      <div class="row justify-content-center mt-4">
        <div class="col-lg-8 animate-fade-in-up">
          <h2 class="fw-bold mb-4">Complete Your Booking</h2>
          
          <div class="card bg-dark border-secondary mb-4">
            <div class="card-body p-4">
              <h4 class="card-title text-white mb-4">Booking Summary</h4>
              
              <div class="d-flex mb-3">
                <div class="me-3" style="width: 100px; height: 80px; background: url('{{ $turf->images->first()?->image_path ?? '/hero-bg.jpg' }}') center/cover; border-radius: 8px;"></div>
                <div>
                  <h5 class="text-white mb-1">{{ $turf->name }}</h5>
                  <p class="text-muted small mb-0">📍 {{ $turf->address }}</p>
                  <span class="badge bg-primary mt-2">{{ $turf->turf_type }}</span>
                </div>
              </div>
              
              <hr class="border-secondary my-4">
              
              <div class="row g-3">
                <div class="col-sm-6">
                  <p class="text-muted small mb-1">Date</p>
                  <p class="text-white fw-bold mb-0">{{ \Carbon\Carbon::parse($date)->format('l, d M Y') }}</p>
                </div>
                <div class="col-sm-6">
                  <p class="text-muted small mb-1">Time</p>
                  <p class="text-white fw-bold mb-0">
                    {{ \Carbon\Carbon::parse($time)->format('h:i A') }} - 
                    {{ \Carbon\Carbon::parse($time)->addHour()->format('h:i A') }}
                  </p>
                </div>
              </div>
            </div>
          </div>
          
          <div class="card bg-dark border-secondary animate-fade-in-up delay-100">
            <div class="card-body p-4">
              <h4 class="card-title text-white mb-4">Payment Details</h4>
              
              <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Turf Fee (1 Hour)</span>
                <span class="text-white">৳{{ number_format($turf->starting_price, 0) }}</span>
              </div>
              <div class="d-flex justify-content-between mb-3">
                <span class="text-muted">Platform Fee</span>
                <span class="text-white">৳50</span>
              </div>
              <hr class="border-secondary">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <span class="fs-5 text-white fw-bold">Total Amount</span>
                <span class="fs-4 text-primary fw-bold">৳{{ number_format($turf->starting_price + 50, 0) }}</span>
              </div>
              
              <form action="{{ route('booking.store', $turf->slug) }}" method="POST">
                @csrf
                <input type="hidden" name="date" value="{{ $date }}">
                <input type="hidden" name="time" value="{{ $time }}">
                
                @if ($errors->any())
                  <div class="alert alert-danger mb-4 border-danger bg-danger bg-opacity-10 text-danger">
                    <ul class="mb-0">
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                
                <div class="alert alert-info bg-primary bg-opacity-10 border-primary text-primary mb-4">
                  <i class="bi bi-info-circle me-2"></i> Payment gateway integration will be implemented in a future phase. For now, booking will be confirmed without payment.
                </div>
                
                <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">Confirm Booking</button>
              </form>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </body>
</html>
