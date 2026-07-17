@extends('layouts.app')
@section('title', 'Results: ' . $election->title)
@section('content')
<h2 class="fw-bold mb-2" style="color:#1F4E79">
    <i class="bi bi-bar-chart-line me-2"></i>{{ $election->title }} — Results
</h2>
<p class="text-muted mb-4">{{ $election->description }}</p>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card p-3 text-center">
            <div class="text-muted small">Total Valid Votes</div>
            <div class="fs-3 fw-bold" style="color:#1F4E79">{{ $totalVotes }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3 text-center">
            <div class="text-muted small">Candidates</div>
            <div class="fs-3 fw-bold" style="color:#1F4E79">{{ count($results) }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3 text-center">
            <div class="text-muted small">Invalid/Corrupted Votes</div>
            <div class="fs-3 fw-bold text-danger">{{ $invalidVotes }}</div>
        </div>
    </div>
</div>

@if(empty($results))
    <div class="alert alert-info">No candidates found for this election.</div>
@else
<div class="card p-4">
    @foreach($results as $i => $result)
    <div class="mb-4 {{ $i === 0 && $result['votes'] > 0 ? 'border border-success rounded p-3' : '' }}">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <div>
                <span class="fw-bold fs-5">{{ $result['candidate']->full_name }}</span>
                @if($i === 0 && $result['votes'] > 0)
                    <span class="badge bg-success ms-2"><i class="bi bi-trophy-fill me-1"></i>Leading</span>
                @endif
                <div class="text-muted small">{{ $result['candidate']->party ?? 'Independent' }} • {{ $result['candidate']->position }}</div>
            </div>
            <div class="text-end">
                <div class="fw-bold fs-4" style="color:#1F4E79">{{ $result['votes'] }}</div>
                <div class="text-muted small">{{ $result['percentage'] }}%</div>
            </div>
        </div>
        <div class="progress" style="height: 24px;">
            <div class="progress-bar" role="progressbar"
                 style="width: {{ $result['percentage'] }}%; background: {{ $i === 0 ? '#1F4E79' : '#2E75B6' }};"
                 aria-valuenow="{{ $result['percentage'] }}" aria-valuemin="0" aria-valuemax="100">
                {{ $result['percentage'] }}%
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

<div class="mt-3 d-flex gap-2">
    <a href="{{ route('admin.results.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Back to Results
    </a>
    <button onclick="window.print()" class="btn btn-outline-primary">
        <i class="bi bi-printer me-1"></i>Print Report
    </button>
</div>
@endsection