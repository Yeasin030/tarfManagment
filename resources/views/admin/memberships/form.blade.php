@extends('admin.layout')

@section('title', isset($membership) ? 'Edit Membership Plan' : 'Create Membership Plan')

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

    <form action="{{ isset($membership) ? route('admin.memberships.update', $membership->id) : route('admin.memberships.store') }}" method="POST">
        @csrf
        @if(isset($membership))
            @method('PUT')
        @endif

        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label text-muted">Plan Name</label>
                <input type="text" name="name" class="form-control bg-dark text-white border-secondary" value="{{ old('name', $membership->name ?? '') }}" required placeholder="e.g. Pro Squad">
            </div>
            
            <div class="col-md-3">
                <label class="form-label text-muted">Price (৳)</label>
                <input type="number" step="0.01" name="price" class="form-control bg-dark text-white border-secondary" value="{{ old('price', $membership->price ?? '0') }}" required>
            </div>

            <div class="col-md-3">
                <label class="form-label text-muted">Billing Cycle</label>
                <input type="text" name="billing_cycle" class="form-control bg-dark text-white border-secondary" value="{{ old('billing_cycle', $membership->billing_cycle ?? '/mo') }}" required placeholder="e.g. /mo">
            </div>

            <div class="col-md-12">
                <label class="form-label text-muted">Features (One per line)</label>
                <textarea name="features" class="form-control bg-dark text-white border-secondary" rows="5" required placeholder="✓ 15% Off all bookings&#10;✓ Priority peak-hour access">{{ old('features', isset($membership) && is_array($membership->features) ? implode("\n", $membership->features) : '') }}</textarea>
                <small class="text-muted">Enter each feature on a new line. They will be displayed as a list.</small>
            </div>

            <div class="col-md-6 mt-4">
                <div class="form-check form-switch fs-5">
                    <input class="form-check-input" type="checkbox" role="switch" id="isPopularSwitch" name="is_popular" value="1" {{ old('is_popular', $membership->is_popular ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label ms-2 mt-1 fs-6" for="isPopularSwitch">Mark as "Most Popular"</label>
                </div>
            </div>

            <div class="col-md-6 mt-4">
                <div class="form-check form-switch fs-5">
                    <input class="form-check-input" type="checkbox" role="switch" id="isActiveSwitch" name="is_active" value="1" {{ old('is_active', $membership->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label ms-2 mt-1 fs-6" for="isActiveSwitch">Plan is Active</label>
                </div>
            </div>

            <div class="col-12 mt-5 text-end border-top border-secondary pt-4">
                <a href="{{ route('admin.memberships.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary px-5">{{ isset($membership) ? 'Update' : 'Create' }} Plan</button>
            </div>
        </div>
    </form>
</div>
@endsection
