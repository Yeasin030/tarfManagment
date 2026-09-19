@extends('admin.layout')

@section('title', 'Manage Membership Plans')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.memberships.create') }}" class="btn btn-primary">Add New Plan</a>
</div>
<div class="glass-card p-4">
    <div class="table-responsive">
        <table class="table table-dark table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th>Plan Name</th>
                    <th>Price</th>
                    <th>Popular</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($plans as $plan)
                <tr>
                    <td>{{ $plan->name }}</td>
                    <td>৳{{ number_format($plan->price, 0) }} {{ $plan->billing_cycle }}</td>
                    <td>
                        @if($plan->is_popular)
                            <span class="badge bg-primary">Yes</span>
                        @endif
                    </td>
                    <td>
                        @if($plan->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.memberships.edit', $plan->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('admin.memberships.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">No membership plans found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $plans->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
