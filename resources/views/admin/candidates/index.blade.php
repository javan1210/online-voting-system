@extends('layouts.app')
@section('title', 'Manage Candidates')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0" style="color:#1F4E79"><i class="bi bi-person-badge me-2"></i>Candidates</h2>
    <a href="{{ route('admin.candidates.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add Candidate
    </a>
</div>
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if($candidates->isEmpty())
    <div class="alert alert-info">No candidates yet. Add your first candidate!</div>
@else
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead style="background:#1F4E79; color:white;">
                <tr>
                    <th class="p-3">#</th>
                    <th class="p-3">Full Name</th>
                    <th class="p-3">Party</th>
                    <th class="p-3">Position</th>
                    <th class="p-3">Election</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidates as $i => $candidate)
                <tr>
                    <td class="p-3">{{ $i + 1 }}</td>
                    <td class="p-3 fw-semibold">{{ $candidate->full_name }}</td>
                    <td class="p-3">{{ $candidate->party ?? '—' }}</td>
                    <td class="p-3">{{ $candidate->position }}</td>
                    <td class="p-3">
                        <span class="badge bg-primary">{{ $candidate->election->title }}</span>
                    </td>
                    <td class="p-3">
                        <a href="{{ route('admin.candidates.edit', $candidate) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form method="POST" action="{{ route('admin.candidates.destroy', $candidate) }}" class="d-inline"
                              onsubmit="return confirm('Delete this candidate?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
<div class="mt-3">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
    </a>
</div>
@endsection