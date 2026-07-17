<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Election;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index() {
        if (!session('admin_id')) return redirect()->route('admin.login');
        $candidates = Candidate::with('election')->latest()->get();
        return view('admin.candidates.index', compact('candidates'));
    }

    public function create() {
        if (!session('admin_id')) return redirect()->route('admin.login');
        $elections = Election::all();
        return view('admin.candidates.create', compact('elections'));
    }

    public function store(Request $request) {
        $request->validate([
            'election_id' => 'required|exists:elections,id',
            'full_name'   => 'required|string|max:255',
            'party'       => 'nullable|string|max:255',
            'position'    => 'required|string|max:255',
            'bio'         => 'nullable|string',
        ]);
        Candidate::create($request->all());
        return redirect()->route('admin.candidates.index')->with('success', 'Candidate added successfully!');
    }

    public function edit(Candidate $candidate) {
        if (!session('admin_id')) return redirect()->route('admin.login');
        $elections = Election::all();
        return view('admin.candidates.edit', compact('candidate', 'elections'));
    }

    public function update(Request $request, Candidate $candidate) {
        $request->validate([
            'election_id' => 'required|exists:elections,id',
            'full_name'   => 'required|string|max:255',
            'party'       => 'nullable|string|max:255',
            'position'    => 'required|string|max:255',
            'bio'         => 'nullable|string',
        ]);
        $candidate->update($request->all());
        return redirect()->route('admin.candidates.index')->with('success', 'Candidate updated successfully!');
    }

    public function destroy(Candidate $candidate) {
        $candidate->delete();
        return redirect()->route('admin.candidates.index')->with('success', 'Candidate deleted.');
    }
}