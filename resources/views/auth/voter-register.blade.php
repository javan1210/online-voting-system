@extends('layouts.app')
@section('title', 'Voter Registration')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card p-4">
            <h3 class="text-center mb-4 fw-bold" style="color:#1F4E79">
                <i class="bi bi-person-plus me-2"></i>Voter Registration
            </h3>
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
                </div>
            @endif
            <form method="POST" action="{{ route('voter.register') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">National ID</label>
                    <input type="text" name="national_id" class="form-control" value="{{ old('national_id') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Full Name</label>
                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Phone Number</label>
                    <input type="text" name="phone" class="form-control" placeholder="e.g. 0712345678" value="{{ old('phone') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Register</button>
            </form>
            <p class="text-center mt-3">Already registered? <a href="{{ route('voter.login') }}">Login here</a></p>
        </div>
    </div>
</div>
@endsection