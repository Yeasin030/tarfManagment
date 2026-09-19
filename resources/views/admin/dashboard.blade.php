@extends('admin.layout')

@section('title', 'Dashboard Overview')

@section('content')
<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="glass-card p-4">
            <h6 class="text-muted mb-2">Total Bookings</h6>
            <h2 class="font-heading mb-0">{{ number_format($totalBookings) }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="glass-card p-4">
            <h6 class="text-muted mb-2">Revenue (Completed)</h6>
            <h2 class="font-heading mb-0 text-primary">৳{{ number_format($totalRevenue) }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="glass-card p-4">
            <h6 class="text-muted mb-2">Total Users</h6>
            <h2 class="font-heading mb-0">{{ number_format($totalUsers) }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="glass-card p-4">
            <h6 class="text-muted mb-2">Active Turfs</h6>
            <h2 class="font-heading mb-0">{{ number_format($totalTurfs) }}</h2>
        </div>
    </div>
</div>

<div class="glass-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="font-heading mb-0">Recent Bookings</h4>
        <a href="{{ route('admin.bookings') }}" class="btn btn-sm btn-outline-primary">View All</a>
    </div>
    <div class="table-responsive">
        <table class="table table-dark table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Turf</th>
                    <th>Date & Time</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentBookings as $booking)
                <tr>
                    <td>#{{ $booking->id }}</td>
                    <td>{{ $booking->user->name ?? 'Deleted User' }}</td>
                    <td>{{ $booking->turf->name ?? 'Deleted Turf' }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($booking->date)->format('M d, Y') }}<br>
                        <small class="text-muted">{{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}</small>
                    </td>
                    <td>৳{{ number_format($booking->total_price, 2) }}</td>
                    <td>
                        @if($booking->status == 'confirmed')
                            <span class="badge bg-success">Confirmed</span>
                        @elseif($booking->status == 'cancelled')
                            <span class="badge bg-danger">Cancelled</span>
                        @else
                            <span class="badge bg-info">Completed</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">No bookings found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
