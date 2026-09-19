@extends('admin.layout')

@section('title', 'Manage Tournaments')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.tournaments.create') }}" class="btn btn-primary">Add New Tournament</a>
</div>
<div class="glass-card p-4">
    <div class="table-responsive">
        <table class="table table-dark table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Dates</th>
                    <th>Format</th>
                    <th>Prize Pool</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tournaments as $tournament)
                <tr>
                    <td>{{ $tournament->name }}</td>
                    <td>{{ $tournament->location }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($tournament->start_date)->format('M d') }} - 
                        {{ \Carbon\Carbon::parse($tournament->end_date)->format('M d, Y') }}
                    </td>
                    <td>{{ $tournament->format }}</td>
                    <td>৳{{ number_format($tournament->prize_pool, 0) }}</td>
                    <td>
                        @if($tournament->status == 'open')
                            <span class="badge bg-success">Registration Open</span>
                        @elseif($tournament->status == 'closed')
                            <span class="badge bg-secondary">Registration Closed</span>
                        @else
                            <span class="badge bg-info">Completed</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.tournaments.edit', $tournament->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('admin.tournaments.destroy', $tournament->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">No tournaments found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $tournaments->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
