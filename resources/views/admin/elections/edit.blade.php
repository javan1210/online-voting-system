@extends('layouts.app')
@section('title', 'Edit Election')
@section('content')
<div class="row justify-content-center">
<div class="col-md-7">
<div class="card p-4">
    <h3 class="fw-bold mb-4" style="color:#1F4E79"><i class="bi bi-pencil me-2"></i>Edit Election</h3>
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
        </div>
    @endif
    <form method="POST" action="{{ route('admin.elections.update', $election) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label fw-semibold">Election Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $election->title) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $election->description) }}</textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Start Date & Time</label>
                <input type="datetime-local" name="start_date" class="form-control"
                    value="{{ old('start_date', $election->start_date->format('Y-m-d\TH:i')) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">End Date & Time</label>
                <input type="datetime-local" name="end_date" class="form-control"
                    value="{{ old('end_date', $election->end_date->format('Y-m-d\TH:i')) }}" required>
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label fw-semibold">Status</label>
            <select name="status" class="form-select">
                <option value="pending" {{ $election->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="active" {{ $election->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="closed" {{ $election->status == 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check2 me-2"></i>Update Election</button>
            <a href="{{ route('admin.elections.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
</div>
</div>
@endsection