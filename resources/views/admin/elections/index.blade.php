@extends('layouts.app')
@section('title', 'Manage Elections')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0" style="color:#1F4E79"><i class="bi bi-calendar-check me-2"></i>Elections</h2>
    <a href="{{ route('admin.elections.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>New Election
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
    <div class="alert alert-info">No elections found. Create your first one!</div>
@else
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead style="background:#1F4E79; color:white;">
                <tr>
                    <th class="p-3">#</th>
                    <th class="p-3">Title</th>
                    <th class="p-3">Start Date</th>
                    <th class="p-3">End Date</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($elections as $i => $election)
                <tr>
                    <td class="p-3">{{ $i + 1 }}</td>
                    <td class="p-3 fw-semibold">{{ $election->title }}</td>
                    <td class="p-3">{{ $election->start_date->format('d M Y, H:i') }}</td>
                    <td class="p-3">{{ $election->end_date->format('d M Y, H:i') }}</td>
                    <td class="p-3">
                        @if($election->status === 'active')
                            <span class="badge bg-success fs-6">Active</span>
                        @elseif($election->status === 'pending')
                            <span class="badge bg-warning text-dark fs-6">Pending</span>
                        @else
                            <span class="badge bg-secondary fs-6">Closed</span>
                        @endif
                    </td>
                    <td class="p-3">
                        <a href="{{ route('admin.elections.edit', $election) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form method="POST" action="{{ route('admin.elections.destroy', $election) }}" class="d-inline"
                              onsubmit="return confirm('Delete this election?')">
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