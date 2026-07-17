<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin() {
        return view('auth.admin-login');
    }

    public function login(Request $request) {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            AuditLog::record('Failed admin login', $admin?->id, 'admin', 'failure');
            return back()->withErrors(['email' => 'Invalid admin credentials.']);
        }

        $admin->update(['last_login' => now()]);
        session(['admin_id' => $admin->id, 'admin_name' => $admin->username, 'admin_role' => $admin->role]);

        AuditLog::record('Admin logged in', $admin->id, 'admin');
        return redirect()->route('admin.dashboard');
    }

    public function logout() {
        AuditLog::record('Admin logged out', session('admin_id'), 'admin');
        session()->forget(['admin_id', 'admin_name', 'admin_role']);
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}