@extends('layouts.app')
@section('title', 'Audit Logs')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0" style="color:#1F4E79"><i class="bi bi-journal-text me-2"></i>Audit Logs</h2>
    <span class="badge bg-primary fs-6">{{ $logs->count() }} Entries</span>
</div>

@if($logs->isEmpty())
    <div class="alert alert-info">No activity recorded yet.</div>
@else
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0 small">
            <thead style="background:#1F4E79; color:white;">
                <tr>
                    <th class="p-3">Time</th>
                    <th class="p-3">User</th>
                    <th class="p-3">Type</th>
                    <th class="p-3">Action</th>
                    <th class="p-3">IP Address</th>
                    <th class="p-3">Outcome</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                <tr>
                    <td class="p-3 text-muted">{{ $log->created_at->format('d M Y, H:i:s') }}</td>
                    <td class="p-3">{{ $log->user_id ?? 'System' }}</td>
                    <td class="p-3">
                        <span class="badge bg-{{ $log->user_type === 'admin' ? 'danger' : 'primary' }}">
                            {{ ucfirst($log->user_type ?? 'system') }}
                        </span>
                    </td>
                    <td class="p-3">{{ $log->action }}
                        @if($log->notes)
                            <div class="text-muted">{{ $log->notes }}</div>
                        @endif
                    </td>
                    <td class="p-3 text-muted">{{ $log->ip_address ?? '—' }}</td>
                    <td class="p-3">
                        <span class="badge bg-{{ $log->outcome === 'success' ? 'success' : 'danger' }}">
                            {{ ucfirst($log->outcome) }}
                        </span>
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