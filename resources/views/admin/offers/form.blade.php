@extends('admin.layout')

@section('title', isset($offer) ? 'Edit Offer' : 'Create Offer')

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

    <form action="{{ isset($offer) ? route('admin.offers.update', $offer->id) : route('admin.offers.store') }}" method="POST">
        @csrf
        @if(isset($offer))
            @method('PUT')
        @endif

        <div class="row g-4">
            <div class="col-md-12">
                <label class="form-label text-muted">Offer Title</label>
                <input type="text" name="title" class="form-control bg-dark text-white border-secondary" value="{{ old('title', $offer->title ?? '') }}" required>
            </div>
            
            <div class="col-md-12">
                <label class="form-label text-muted">Description</label>
                <textarea name="description" class="form-control bg-dark text-white border-secondary" rows="3" required>{{ old('description', $offer->description ?? '') }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label text-muted">Promo Code (Optional)</label>
                <input type="text" name="code" class="form-control bg-dark text-white border-secondary" value="{{ old('code', $offer->code ?? '') }}" placeholder="e.g. EARLY20">
            </div>

            <div class="col-md-6">
                <label class="form-label text-muted">Badge Text (Optional)</label>
                <input type="text" name="badge_text" class="form-control bg-dark text-white border-secondary" value="{{ old('badge_text', $offer->badge_text ?? '') }}" placeholder="e.g. Weekend Special">
            </div>

            <div class="col-12 mt-4">
                <div class="form-check form-switch fs-5">
                    <input class="form-check-input" type="checkbox" role="switch" id="isActiveSwitch" name="is_active" value="1" {{ old('is_active', $offer->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label ms-2 mt-1 fs-6" for="isActiveSwitch">Offer is Active</label>
                </div>
            </div>

            <div class="col-12 mt-5 text-end border-top border-secondary pt-4">
                <a href="{{ route('admin.offers.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary px-5">{{ isset($offer) ? 'Update' : 'Create' }} Offer</button>
            </div>
        </div>
    </form>
</div>
@endsection
