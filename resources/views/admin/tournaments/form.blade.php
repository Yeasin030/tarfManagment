@extends('admin.layout')

@section('title', isset($tournament) ? 'Edit Tournament' : 'Create Tournament')

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

    <form action="{{ isset($tournament) ? route('admin.tournaments.update', $tournament->id) : route('admin.tournaments.store') }}" method="POST">
        @csrf
        @if(isset($tournament))
            @method('PUT')
        @endif

        <div class="row g-4">
            <div class="col-md-12">
                <label class="form-label text-muted">Tournament Name</label>
                <input type="text" name="name" class="form-control bg-dark text-white border-secondary" value="{{ old('name', $tournament->name ?? '') }}" required>
            </div>
            
            <div class="col-md-12">
                <label class="form-label text-muted">Location</label>
                <input type="text" name="location" class="form-control bg-dark text-white border-secondary" value="{{ old('location', $tournament->location ?? '') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label text-muted">Start Date</label>
                <input type="date" name="start_date" class="form-control bg-dark text-white border-secondary" value="{{ old('start_date', $tournament->start_date ?? '') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label text-muted">End Date</label>
                <input type="date" name="end_date" class="form-control bg-dark text-white border-secondary" value="{{ old('end_date', $tournament->end_date ?? '') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label text-muted">Format</label>
                <input type="text" name="format" class="form-control bg-dark text-white border-secondary" value="{{ old('format', $tournament->format ?? '5-a-side') }}" required placeholder="e.g. 5-a-side, 7-a-side">
            </div>

            <div class="col-md-6">
                <label class="form-label text-muted">Status</label>
                <select name="status" class="form-select bg-dark text-white border-secondary" required>
                    <option value="open" {{ old('status', $tournament->status ?? '') == 'open' ? 'selected' : '' }}>Registration Open</option>
                    <option value="closed" {{ old('status', $tournament->status ?? '') == 'closed' ? 'selected' : '' }}>Registration Closed</option>
                    <option value="completed" {{ old('status', $tournament->status ?? '') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label text-muted">Prize Pool (৳)</label>
                <input type="number" step="0.01" name="prize_pool" class="form-control bg-dark text-white border-secondary" value="{{ old('prize_pool', $tournament->prize_pool ?? '0') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label text-muted">Entry Fee (৳)</label>
                <input type="number" step="0.01" name="entry_fee" class="form-control bg-dark text-white border-secondary" value="{{ old('entry_fee', $tournament->entry_fee ?? '0') }}" required>
            </div>

            <div class="col-12 mt-5 text-end border-top border-secondary pt-4">
                <a href="{{ route('admin.tournaments.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary px-5">{{ isset($tournament) ? 'Update' : 'Create' }} Tournament</button>
            </div>
        </div>
    </form>
</div>
@endsection
