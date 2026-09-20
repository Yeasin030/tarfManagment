@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5 pb-5 text-center">
      <div class="row justify-content-center mt-5">
        <div class="col-lg-6 animate-fade-in-up">
          
          <div class="mb-4">
            <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-25 rounded-circle mb-4" style="width: 80px; height: 80px;">
              <span class="fs-1 text-success">✓</span>
            </div>
            <h2 class="fw-bold text-white mb-2">Booking Confirmed!</h2>
            <p class="text-muted">Your turf has been successfully reserved.</p>
          </div>
          
          <div class="card bg-dark border-secondary mb-4 text-start">
            <div class="card-body p-4">
              <h5 class="text-white mb-4 border-bottom border-secondary pb-3">Booking Reference: <span class="text-primary fw-bold">#BK-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</span></h5>
              
              <div class="row g-3 mb-4">
                <div class="col-6">
                  <p class="text-muted small mb-1">Turf</p>
                  <p class="text-white fw-bold mb-0">{{ $booking->turf->name }}</p>
                </div>
                <div class="col-6">
                  <p class="text-muted small mb-1">Location</p>
                  <p class="text-white fw-bold mb-0">{{ $booking->turf->address }}</p>
                </div>
                <div class="col-6">
                  <p class="text-muted small mb-1">Date</p>
                  <p class="text-white fw-bold mb-0">{{ \Carbon\Carbon::parse($booking->date)->format('d M Y') }}</p>
                </div>
                <div class="col-6">
                  <p class="text-muted small mb-1">Time</p>
                  <p class="text-white fw-bold mb-0">
                    {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} - 
                    {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}
                  </p>
                </div>
              </div>
              
              <div class="alert alert-dark bg-secondary bg-opacity-10 border-0 d-flex justify-content-between align-items-center mb-0">
                <span class="text-muted">Total Paid</span>
                <span class="fs-5 text-white fw-bold">৳{{ number_format($booking->total_price, 0) }}</span>
              </div>
            </div>
          </div>
          
          <div class="d-flex gap-3 justify-content-center">
            <a href="{{ url('/') }}" class="btn btn-outline-primary px-4">Back to Home</a>
          </div>
          
        </div>
      </div>
    </div>
  </body>
</html>
