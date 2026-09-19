@extends('admin.layout')

@section('title', 'Manage Turfs')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.turfs.create') }}" class="btn btn-primary">Add New Turf</a>
</div>
<div class="glass-card p-4">
    <div class="table-responsive">
        <table class="table table-dark table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Capacity</th>
                    <th>Price/Hr</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($turfs as $turf)
                <tr>
                    <td>#{{ $turf->id }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div style="width: 40px; height: 40px; border-radius: 8px; background: url('{{ $turf->images->first()?->image_path ?? '/hero-bg.jpg' }}') center/cover;"></div>
                            <div>
                                <h6 class="mb-0">{{ $turf->name }}</h6>
                                <small class="text-muted">{{ \Illuminate\Support\Str::limit($turf->address, 30) }}</small>
                            </div>
                        </div>
                    </td>
                    <td>{{ $turf->turf_type }}</td>
                    <td>{{ $turf->capacity }} Players</td>
                    <td>৳{{ number_format($turf->starting_price, 0) }}</td>
                    <td>
                        @if($turf->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.turfs.edit', $turf->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('admin.turfs.destroy', $turf->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this turf? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">No turfs found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $turfs->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
