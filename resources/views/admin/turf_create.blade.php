@extends('admin.layout')

@section('title', 'Create New Turf')

@section('content')
<div class="glass-card p-4 mx-auto" style="max-width: 900px;">
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.turfs.store') }}" method="POST">
        @csrf

        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label text-muted">Turf Name</label>
                <input type="text" name="name" class="form-control bg-dark text-white border-secondary" value="{{ old('name') }}" required>
            </div>
            
            <div class="col-md-6">
                <label class="form-label text-muted">Slug (Auto-generated)</label>
                <input type="text" class="form-control bg-dark text-white border-secondary" placeholder="Will be created automatically" disabled>
            </div>

            <div class="col-12">
                <label class="form-label text-muted">Description</label>
                <textarea name="description" rows="3" class="form-control bg-dark text-white border-secondary">{{ old('description') }}</textarea>
            </div>

            <div class="col-12">
                <label class="form-label text-muted">Address</label>
                <input type="text" name="address" class="form-control bg-dark text-white border-secondary" value="{{ old('address') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label text-muted">Phone Number</label>
                <input type="text" name="phone" class="form-control bg-dark text-white border-secondary" value="{{ old('phone') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label text-muted">Email (Optional)</label>
                <input type="email" name="email" class="form-control bg-dark text-white border-secondary" value="{{ old('email') }}">
            </div>

            <div class="col-md-6">
                <label class="form-label text-muted">Opening Time</label>
                <input type="time" name="opening_time" class="form-control bg-dark text-white border-secondary" value="{{ old('opening_time', '08:00') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label text-muted">Closing Time</label>
                <input type="time" name="closing_time" class="form-control bg-dark text-white border-secondary" value="{{ old('closing_time', '22:00') }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label text-muted">Turf Type</label>
                <select name="turf_type" class="form-select bg-dark text-white border-secondary" required>
                    <option value="" disabled selected>Select Type</option>
                    <option value="5-a-side" {{ old('turf_type') == '5-a-side' ? 'selected' : '' }}>5-a-side</option>
                    <option value="7-a-side" {{ old('turf_type') == '7-a-side' ? 'selected' : '' }}>7-a-side</option>
                    <option value="9-a-side" {{ old('turf_type') == '9-a-side' ? 'selected' : '' }}>9-a-side</option>
                    <option value="11-a-side" {{ old('turf_type') == '11-a-side' ? 'selected' : '' }}>11-a-side</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label text-muted">Capacity (Players)</label>
                <input type="number" name="capacity" class="form-control bg-dark text-white border-secondary" value="{{ old('capacity') }}">
            </div>

            <div class="col-md-4">
                <label class="form-label text-muted">Starting Price (৳/Hr)</label>
                <input type="number" step="0.01" name="starting_price" class="form-control bg-dark text-white border-secondary" value="{{ old('starting_price') }}" required>
            </div>

            <div class="col-12 mt-4">
                <div class="form-check form-switch fs-5">
                    <input class="form-check-input" type="checkbox" role="switch" id="isActiveSwitch" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label class="form-check-label ms-2 mt-1 fs-6" for="isActiveSwitch">Turf is Active (Visible to users)</label>
                </div>
            </div>

            <div class="col-12 mt-5 text-end border-top border-secondary pt-4">
                <a href="{{ route('admin.turfs') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary px-5">Create Turf</button>
            </div>
        </div>
    </form>
</div>
@endsection
