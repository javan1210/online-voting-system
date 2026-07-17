@extends('layouts.app')
@section('title', 'Voter Login')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card p-4">
            <h3 class="text-center mb-4 fw-bold" style="color:#1F4E79">
                <i class="bi bi-box-arrow-in-right me-2"></i>Voter Login
            </h3>
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
                </div>
            @endif
            <form method="POST" action="{{ route('voter.login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">National ID</label>
                    <input type="text" name="national_id" class="form-control" value="{{ old('national_id') }}" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Login</button>
            </form>
            <p class="text-center mt-3">Not registered? <a href="{{ route('voter.register') }}">Register here</a></p>
        </div>
    </div>
</div>
@endsection