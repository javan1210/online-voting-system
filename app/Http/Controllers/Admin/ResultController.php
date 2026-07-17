<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Models\Vote;
use App\Models\Candidate;
use Illuminate\Support\Facades\Crypt;

class ResultController extends Controller
{
    public function index() {
        if (!session('admin_id')) return redirect()->route('admin.login');
        $elections = Election::all();
        return view('admin.results.index', compact('elections'));
    }

    public function show(Election $election) {
        if (!session('admin_id')) return redirect()->route('admin.login');

        $candidates = Candidate::where('election_id', $election->id)->get();
        $votes = Vote::where('election_id', $election->id)->get();

        // Tally votes by decrypting each one
        $tally = [];
        foreach ($candidates as $candidate) {
            $tally[$candidate->id] = 0;
        }

        $totalVotes = 0;
        $invalidVotes = 0;

        foreach ($votes as $vote) {
            try {
                $candidateId = (int) Crypt::decryptString($vote->encrypted_vote);
                if (isset($tally[$candidateId])) {
                    $tally[$candidateId]++;
                    $totalVotes++;
                } else {
                    $invalidVotes++;
                }
            } catch (\Exception $e) {
                $invalidVotes++;
            }
        }

        // Build results array with percentages
        $results = [];
        foreach ($candidates as $candidate) {
            $count = $tally[$candidate->id] ?? 0;
            $percentage = $totalVotes > 0 ? round(($count / $totalVotes) * 100, 1) : 0;
            $results[] = [
                'candidate' => $candidate,
                'votes' => $count,
                'percentage' => $percentage,
            ];
        }

        // Sort by votes descending
        usort($results, fn($a, $b) => $b['votes'] - $a['votes']);

        return view('admin.results.show', compact('election', 'results', 'totalVotes', 'invalidVotes'));
    }
}