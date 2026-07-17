@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<h2 class="fw-bold mb-4" style="color:#1F4E79">
    <i class="bi bi-shield-check me-2"></i>Admin Dashboard
</h2>

{{-- Stats Row --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card p-3 text-center" style="border-left: 4px solid #1F4E79;">
            <div class="text-muted small">Total Voters</div>
            <div class="fw-bold fs-3" style="color:#1F4E79">{{ \App\Models\Voter::count() }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center" style="border-left: 4px solid #2E75B6;">
            <div class="text-muted small">Active Elections</div>
            <div class="fw-bold fs-3" style="color:#2E75B6">{{ \App\Models\Election::where('status','active')->count() }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center" style="border-left: 4px solid #28a745;">
            <div class="text-muted small">Total Votes Cast</div>
            <div class="fw-bold fs-3 text-success">{{ \App\Models\Vote::count() }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center" style="border-left: 4px solid #6c757d;">
            <div class="text-muted small">Total Candidates</div>
            <div class="fw-bold fs-3 text-secondary">{{ \App\Models\Candidate::count() }}</div>
        </div>
    </div>
</div>

{{-- Module Cards --}}
<div class="row g-4">
    <div class="col-md-3">
        <a href="{{ route('admin.voters.index') }}" class="text-decoration-none">
            <div class="card p-4 text-center h-100" style="cursor:pointer">
                <i class="bi bi-people fs-1 mb-2" style="color:#2E75B6"></i>
                <h5 class="fw-bold">Voters</h5>
                <p class="text-muted small">Manage registered voters</p>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('admin.elections.index') }}" class="text-decoration-none">
            <div class="card p-4 text-center h-100" style="cursor:pointer">
                <i class="bi bi-calendar-check fs-1 mb-2" style="color:#2E75B6"></i>
                <h5 class="fw-bold">Elections</h5>
                <p class="text-muted small">Create & manage elections</p>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('admin.candidates.index') }}" class="text-decoration-none">
            <div class="card p-4 text-center h-100" style="cursor:pointer">
                <i class="bi bi-person-badge fs-1 mb-2" style="color:#2E75B6"></i>
                <h5 class="fw-bold">Candidates</h5>
                <p class="text-muted small">Manage candidates</p>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('admin.results.index') }}" class="text-decoration-none">
            <div class="card p-4 text-center h-100" style="cursor:pointer">
                <i class="bi bi-bar-chart fs-1 mb-2" style="color:#2E75B6"></i>
                <h5 class="fw-bold">Results</h5>
                <p class="text-muted small">View election results</p>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('admin.audit.logs') }}" class="text-decoration-none">
            <div class="card p-4 text-center h-100" style="cursor:pointer">
                <i class="bi bi-journal-text fs-1 mb-2" style="color:#2E75B6"></i>
                <h5 class="fw-bold">Audit Logs</h5>
                <p class="text-muted small">View system activity</p>
            </div>
        </a>
    </div>
</div>
@endsection