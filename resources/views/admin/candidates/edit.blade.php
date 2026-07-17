@extends('layouts.app')
@section('title', 'Edit Candidate')
@section('content')
<div class="row justify-content-center">
<div class="col-md-7">
<div class="card p-4">
    <h3 class="fw-bold mb-4" style="color:#1F4E79"><i class="bi bi-pencil me-2"></i>Edit Candidate</h3>
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
        </div>
    @endif
    <form method="POST" action="{{ route('admin.candidates.update', $candidate) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label fw-semibold">Election</label>
            <select name="election_id" class="form-select" required>
                @foreach($elections as $election)
                    <option value="{{ $election->id }}" {{ $candidate->election_id == $election->id ? 'selected' : '' }}>
                        {{ $election->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Full Name</label>
            <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $candidate->full_name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Political Party</label>
            <input type="text" name="party" class="form-control" value="{{ old('party', $candidate->party) }}">
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Position / Seat</label>
            <input type="text" name="position" class="form-control" value="{{ old('position', $candidate->position) }}" required>
        </div>
        <div class="mb-4">
            <label class="form-label fw-semibold">Bio / Description</label>
            <textarea name="bio" class="form-control" rows="3">{{ old('bio', $candidate->bio) }}</textarea>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check2 me-2"></i>Update Candidate</button>
            <a href="{{ route('admin.candidates.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
</div>
</div>
@endsection