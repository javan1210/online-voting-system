<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Online Voting System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f0f4f8; }
        .navbar { background: linear-gradient(135deg, #1F4E79, #2E75B6); }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .btn-primary { background: #1F4E79; border-color: #1F4E79; }
        .btn-primary:hover { background: #2E75B6; border-color: #2E75B6; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark px-4 py-3">
        <a class="navbar-brand fw-bold fs-4" href="/"><i class="bi bi-check2-square me-2"></i>Online Voting System</a>
        @if(session('voter_id'))
            <div class="d-flex align-items-center gap-3">
                <span class="text-white"><i class="bi bi-person-circle me-1"></i>{{ session('voter_name') }}</span>
                <form method="POST" action="{{ route('voter.logout') }}">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            </div>
        @elseif(session('admin_id'))
            <div class="d-flex align-items-center gap-3">
                <span class="text-white"><i class="bi bi-shield-check me-1"></i>{{ session('admin_name') }}</span>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            </div>
        @endif
    </nav>
    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>