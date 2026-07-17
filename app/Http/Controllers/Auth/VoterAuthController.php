<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Voter;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class VoterAuthController extends Controller
{
    // Show registration form
    public function showRegister() {
        return view('auth.voter-register');
    }

    // Handle registration
    public function register(Request $request) {
        $request->validate([
            'national_id' => 'required|string|max:20|unique:voters',
            'full_name'   => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'email'       => 'required|email|unique:voters',
            'phone'       => 'required|string|max:15|unique:voters',
            'password'    => 'required|string|min:8|confirmed',
        ]);

        $voter = Voter::create([
            'national_id'   => $request->national_id,
            'full_name'     => $request->full_name,
            'date_of_birth' => $request->date_of_birth,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'password'      => Hash::make($request->password),
            'is_verified'   => true,
        ]);

        AuditLog::record('Voter registered', $voter->id, 'voter');
        return redirect()->route('voter.login')->with('success', 'Registration successful! Please log in.');
    }

    // Show login form
    public function showLogin() {
        return view('auth.voter-login');
    }

    // Handle login - Step 1 (password check)
    public function login(Request $request) {
        $request->validate([
            'national_id' => 'required|string',
            'password'    => 'required|string',
        ]);

        $voter = Voter::where('national_id', $request->national_id)->first();

        // Check if account is locked
        if ($voter && $voter->locked_until && now()->lt($voter->locked_until)) {
            return back()->withErrors(['national_id' => 'Account locked. Try again after ' . $voter->locked_until->format('H:i:s')]);
        }

        if (!$voter || !Hash::check($request->password, $voter->password)) {
            if ($voter) {
                $voter->increment('login_attempts');
                if ($voter->login_attempts >= 5) {
                    $voter->update(['locked_until' => now()->addMinutes(15)]);
                }
            }
            AuditLog::record('Failed login attempt', $voter?->id, 'voter', 'failure');
            return back()->withErrors(['national_id' => 'Invalid credentials.']);
        }

        // Reset login attempts
        $voter->update(['login_attempts' => 0, 'locked_until' => null]);

        // Generate OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $voter->update([
            'otp_code'       => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        // Store voter id in session for OTP step
        session(['otp_voter_id' => $voter->id]);

        // For now we'll show OTP in session (later connect SMS gateway)
        session(['dev_otp' => $otp]);

        AuditLog::record('OTP generated', $voter->id, 'voter');
        return redirect()->route('voter.otp');
    }

    // Show OTP form
    public function showOtp() {
        if (!session('otp_voter_id')) {
            return redirect()->route('voter.login');
        }
        return view('auth.voter-otp');
    }

    // Verify OTP - Step 2
    public function verifyOtp(Request $request) {
        $request->validate(['otp' => 'required|string|size:6']);

        $voter = Voter::find(session('otp_voter_id'));

        if (!$voter || $voter->otp_code !== $request->otp || now()->gt($voter->otp_expires_at)) {
            AuditLog::record('Failed OTP attempt', $voter?->id, 'voter', 'failure');
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        // Clear OTP and log in
        $voter->update(['otp_code' => null, 'otp_expires_at' => null]);
        session()->forget(['otp_voter_id', 'dev_otp']);
        session(['voter_id' => $voter->id, 'voter_name' => $voter->full_name]);

        AuditLog::record('Voter logged in', $voter->id, 'voter');
        return redirect()->route('voter.dashboard');
    }

    // Logout
    public function logout() {
        AuditLog::record('Voter logged out', session('voter_id'), 'voter');
        session()->forget(['voter_id', 'voter_name']);
        return redirect()->route('voter.login')->with('success', 'Logged out successfully.');
    }
}