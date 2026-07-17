<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Election;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    public function index() {
        if (!session('admin_id')) return redirect()->route('admin.login');
        $elections = Election::latest()->get();
        return view('admin.elections.index', compact('elections'));
    }

    public function create() {
        if (!session('admin_id')) return redirect()->route('admin.login');
        return view('admin.elections.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after:start_date',
            'status'      => 'required|in:pending,active,closed',
        ]);
        Election::create($request->all());
        return redirect()->route('admin.elections.index')->with('success', 'Election created successfully!');
    }

    public function edit(Election $election) {
        if (!session('admin_id')) return redirect()->route('admin.login');
        return view('admin.elections.edit', compact('election'));
    }

    public function update(Request $request, Election $election) {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after:start_date',
            'status'      => 'required|in:pending,active,closed',
        ]);
        $election->update($request->all());
        return redirect()->route('admin.elections.index')->with('success', 'Election updated successfully!');
    }

    public function destroy(Election $election) {
        $election->delete();
        return redirect()->route('admin.elections.index')->with('success', 'Election deleted.');
    }
}