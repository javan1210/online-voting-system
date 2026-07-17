<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voter;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class VoterManagementController extends Controller
{
    public function index() {
        if (!session('admin_id')) return redirect()->route('admin.login');
        $voters = Voter::latest()->get();
        return view('admin.voters.index', compact('voters'));
    }

    public function edit(Voter $voter) {
        if (!session('admin_id')) return redirect()->route('admin.login');
        return view('admin.voters.edit', compact('voter'));
    }

    public function update(Request $request, Voter $voter) {
        $request->validate([
            'full_name'     => 'required|string|max:255',
            'national_id'   => 'required|string|max:20|unique:voters,national_id,' . $voter->id,
            'email'         => 'required|email|unique:voters,email,' . $voter->id,
            'phone'         => 'required|string|max:15|unique:voters,phone,' . $voter->id,
            'date_of_birth' => 'required|date',
        ]);

        $voter->update($request->only(['full_name', 'national_id', 'email', 'phone', 'date_of_birth']));

        AuditLog::record('Voter updated by admin', session('admin_id'), 'admin', 'success', 'Voter #' . $voter->id);

        return redirect()->route('admin.voters.index')->with('success', 'Voter updated successfully!');
    }

    public function toggleVerify(Voter $voter) {
        $voter->update(['is_verified' => !$voter->is_verified]);
        $status = $voter->is_verified ? 'verified' : 'unverified';
        AuditLog::record("Voter $status by admin", session('admin_id'), 'admin', 'success', 'Voter #' . $voter->id);
        return redirect()->route('admin.voters.index')->with('success', "Voter $status successfully!");
    }

    public function destroy(Voter $voter) {
        AuditLog::record('Voter deleted by admin', session('admin_id'), 'admin', 'success', 'Voter #' . $voter->id . ' - ' . $voter->full_name);
        $voter->delete();
        return redirect()->route('admin.voters.index')->with('success', 'Voter deleted successfully.');
    }
}