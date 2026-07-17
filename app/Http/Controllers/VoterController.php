<?php
namespace App\Http\Controllers;

use App\Models\Election;
use Illuminate\Http\Request;

class VoterController extends Controller
{
    public function dashboard() {
        if (!session('voter_id')) {
            return redirect()->route('voter.login');
        }
        $elections = Election::where('status', 'active')->get();
        return view('voter.dashboard', compact('elections'));
    }
}