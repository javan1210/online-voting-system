@extends('layouts.app')
@section('title', 'Cast Your Vote')
@section('content')
<div class="row justify-content-center">
<div class="col-md-8">
    <div class="card p-4 mb-4" style="border-left: 5px solid #1F4E79;">
        <h3 class="fw-bold mb-1" style="color:#1F4E79">
            <i class="bi bi-check2-square me-2"></i>{{ $election->title }}
        </h3>
        <p class="text-muted mb-0">{{ $election->description }}</p>
        <small class="text-muted">
            <i class="bi bi-clock me-1"></i>Closes: {{ $election->end_date->format('d M Y, H:i') }}
        </small>
    </div>

    <div class="alert alert-warning">
        <i class="bi bi-exclamation-triangle me-2"></i>
        <strong>Important:</strong> Your vote is final and cannot be changed once submitted.
    </div>

    @if($candidates->isEmpty())
        <div class="alert alert-info">No candidates registered for this election yet.</div>
    @else
    <form method="POST" action="{{ route('voter.voting.cast', $election) }}"
          onsubmit="return validateAndConfirm()">
        @csrf
        <input type="hidden" name="candidate_id" id="selected_candidate" value="">

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
            </div>
        @endif

        <h5 class="fw-bold mb-3">Select a Candidate:</h5>
        <div class="row g-3 mb-4">
            @foreach($candidates as $candidate)
            <div class="col-md-6">
                <div class="candidate-card card p-3 h-100"
                     style="border: 2px solid #dee2e6; cursor:pointer; transition: all 0.2s;"
                     onclick="selectCandidate({{ $candidate->id }}, this)">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3 fw-bold text-white"
                             style="width:50px; height:50px; background:#1F4E79; font-size:1.2rem; flex-shrink:0">
                            {{ strtoupper(substr($candidate->full_name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="fw-bold">{{ $candidate->full_name }}</div>
                            <div class="text-muted small">{{ $candidate->party ?? 'Independent' }}</div>
                            <div class="badge bg-secondary">{{ $candidate->position }}</div>
                        </div>
                    </div>
                    @if($candidate->bio)
                    <p class="text-muted small mt-2 mb-0">{{ Str::limit($candidate->bio, 80) }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100 fw-semibold">
            <i class="bi bi-check2-circle me-2"></i>Submit My Vote
        </button>
    </form>
    @endif

    <div class="mt-3 text-center">
        <a href="{{ route('voter.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
        </a>
    </div>
</div>
</div>

<script>
function selectCandidate(id, el) {
    document.getElementById('selected_candidate').value = id;
    document.querySelectorAll('.candidate-card').forEach(c => {
        c.style.borderColor = '#dee2e6';
        c.style.background = '';
        c.style.boxShadow = '';
    });
    el.style.borderColor = '#159d66';
    el.style.background = '#616568';
    el.style.boxShadow = '0 0 0 3px rgba(31,78,121,0.2)';
}
function validateAndConfirm() {
    if (!document.getElementById('selected_candidate').value) {
        alert('Please click on a candidate card to select them before submitting.');
        return false;
    }
    return confirm('Are you sure you want to vote for this candidate? This action cannot be undone.');
}
</script>
@endsection