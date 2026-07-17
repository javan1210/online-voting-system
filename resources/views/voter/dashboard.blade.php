@extends('layouts.app')
@section('title', 'Voter Dashboard')
@section('content')
<h2 class="fw-bold mb-4" style="color:#1F4E79">
    <i class="bi bi-speedometer2 me-2"></i>Welcome, {{ session('voter_name') }}
</h2>
@if($elections->isEmpty())
    <div class="alert alert-info"><i class="bi bi-info-circle me-2"></i>No active elections at the moment.</div>
@else
    <h5 class="mb-3 fw-semibold">Active Elections</h5>
    <div class="row g-4">
        @foreach($elections as $election)
        <div class="col-md-6">
            <div class="card p-4 h-100">
                <h5 class="fw-bold" style="color:#1F4E79">{{ $election->title }}</h5>
                <p class="text-muted">{{ $election->description }}</p>
                <p class="small text-muted">
                    <i class="bi bi-calendar me-1"></i>
                    Ends: {{ $election->end_date->format('d M Y, H:i') }}
                </p>
               <a href="{{ route('voter.voting.vote', $election) }}" class="btn btn-primary mt-auto">
    <i class="bi bi-check2-square me-2"></i>Vote Now
</a>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection