@extends('admin.layout')

@section('title', 'Manage Offers')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.offers.create') }}" class="btn btn-primary">Add New Offer</a>
</div>
<div class="glass-card p-4">
    <div class="table-responsive">
        <table class="table table-dark table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Code</th>
                    <th>Badge</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($offers as $offer)
                <tr>
                    <td>{{ $offer->title }}</td>
                    <td>{{ $offer->code ?: '-' }}</td>
                    <td>{{ $offer->badge_text ?: '-' }}</td>
                    <td>
                        @if($offer->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.offers.edit', $offer->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('admin.offers.destroy', $offer->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">No offers found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $offers->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
