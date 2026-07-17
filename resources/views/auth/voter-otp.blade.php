@extends('layouts.app')
@section('title', 'OTP Verification')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card p-4 text-center">
            <i class="bi bi-shield-lock fs-1 mb-3" style="color:#1F4E79"></i>
            <h3 class="fw-bold mb-2" style="color:#1F4E79">OTP Verification</h3>
            <p class="text-muted mb-4">Enter the 6-digit code sent to your phone/email.</p>
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
                </div>
            @endif
            @if(session('dev_otp'))
                <div class="alert alert-warning">
                    <strong>Dev Mode OTP:</strong> {{ session('dev_otp') }}
                </div>
            @endif
            <form method="POST" action="{{ route('voter.otp') }}">
                @csrf
                <div class="mb-4">
                    <input type="text" name="otp" class="form-control form-control-lg text-center fw-bold fs-4 letter-spacing-wide" maxlength="6" placeholder="000000" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Verify OTP</button>
            </form>
            <p class="text-center mt-3"><a href="{{ route('voter.login') }}">← Back to Login</a></p>
        </div>
    </div>
</div>
@endsection