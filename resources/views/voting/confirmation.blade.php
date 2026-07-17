@extends('layouts.app')
@section('title', 'Vote Confirmed')
@section('content')
<div class="row justify-content-center">
<div class="col-md-6">
<div class="card p-5 text-center">
    <div class="mb-4">
        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
             style="width:80px; height:80px; background:#d4edda;">
            <i class="bi bi-check-circle-fill text-success" style="font-size:2.5rem;"></i>
        </div>
        <h2 class="fw-bold" style="color:#1F4E79">Vote Cast Successfully!</h2>
        <p class="text-muted">Your vote for <strong>{{ $election->title }}</strong> has been securely recorded.</p>
    </div>

    <div class="alert alert-info text-start">
        <i class="bi bi-shield-check me-2"></i>
        <strong>Your vote is protected:</strong>
        <ul class="mb-0 mt-2">
            <li>Your vote has been encrypted with AES-256</li>
            <li>Your identity is not linked to your vote choice</li>
            <li>The vote has been recorded with a unique hash</li>
        </ul>
    </div>

    <div class="d-grid gap-2 mt-3">
        <a href="{{ route('voter.dashboard') }}" class="btn btn-primary">
            <i class="bi bi-speedometer2 me-2"></i>Back to Dashboard
        </a>
    </div>
</div>
</div>
</div>
@endsection