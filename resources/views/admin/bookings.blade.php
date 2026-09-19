@extends('admin.layout')

@section('title', 'Manage Bookings')

@section('content')
<div class="glass-card p-4">
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
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
                    <td>
                        <form action="{{ route('admin.bookings.status', $booking->id) }}" method="POST" class="d-flex gap-2">
                            @csrf
                            <select name="status" class="form-select form-select-sm bg-dark text-white border-secondary" style="width: auto;" onchange="this.form.submit()">
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">No bookings found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $bookings->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
