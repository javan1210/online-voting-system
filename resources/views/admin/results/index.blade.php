@extends('layouts.app')
@section('title', 'Election Results')
@section('content')
<h2 class="fw-bold mb-4" style="color:#1F4E79"><i class="bi bi-bar-chart me-2"></i>Election Results</h2>

@if($elections->isEmpty())
    <div class="alert alert-info">No elections found.</div>
@else
<div class="row g-4">
    @foreach($elections as $election)
    <div class="col-md-6">
        <div class="card p-4">
            <h5 class="fw-bold" style="color:#1F4E79">{{ $election->title }}</h5>
            <p class="text-muted">{{ $election->description }}</p>
            <span class="badge bg-{{ $election->status === 'active' ? 'success' : ($election->status === 'closed' ? 'secondary' : 'warning') }} mb-3">
                {{ ucfirst($election->status) }}
            </span>
            <a href="{{ route('admin.results.show', $election) }}" class="btn btn-primary">
                <i class="bi bi-bar-chart-line me-2"></i>View Results
            </a>
        </div>
    </div>
    @endforeach
</div>
@endif

<div class="mt-3">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
    </a>
</div>
@endsection