@extends('layouts.app')
@section('title', 'Manage Voters')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0" style="color:#1F4E79"><i class="bi bi-people me-2"></i>Registered Voters</h2>
    <span class="badge bg-primary fs-6">{{ $voters->count() }} Total</span>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($voters->isEmpty())
    <div class="alert alert-info">No voters registered yet.</div>
@else
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead style="background:#1F4E79; color:white;">
                <tr>
                    <th class="p-3">#</th>
                    <th class="p-3">Full Name</th>
                    <th class="p-3">National ID</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Phone</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Registered</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($voters as $i => $voter)
                <tr>
                    <td class="p-3">{{ $i + 1 }}</td>
                    <td class="p-3 fw-semibold">{{ $voter->full_name }}</td>
                    <td class="p-3">{{ $voter->national_id }}</td>
                    <td class="p-3">{{ $voter->email }}</td>
                    <td class="p-3">{{ $voter->phone }}</td>
                    <td class="p-3">
                        @if($voter->is_verified)
                            <span class="badge bg-success">Verified</span>
                        @else
                            <span class="badge bg-secondary">Unverified</span>
                        @endif
                        @if($voter->locked_until && now()->lt($voter->locked_until))
                            <span class="badge bg-danger">Locked</span>
                        @endif
                    </td>
                    <td class="p-3 small text-muted">{{ $voter->created_at->format('d M Y') }}</td>
                    <td class="p-3">
                        <div class="d-flex gap-1 flex-wrap">
                            <a href="{{ route('admin.voters.edit', $voter) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.voters.toggleVerify', $voter) }}" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-outline-{{ $voter->is_verified ? 'warning' : 'success' }}">
                                    <i class="bi bi-{{ $voter->is_verified ? 'x-circle' : 'check-circle' }}"></i>
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.voters.destroy', $voter) }}" class="d-inline"
                                  onsubmit="return confirm('Delete this voter? This cannot be undone.')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
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