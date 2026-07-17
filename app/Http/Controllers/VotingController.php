<?php
namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Candidate;
use App\Models\Vote;
use App\Models\VoterElection;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class VotingController extends Controller
{
    public function showVote(Election $election) {
        if (!session('voter_id')) {
            return redirect()->route('voter.login');
        }

        if (!$election->isActive()) {
            return redirect()->route('voter.dashboard')->with('error', 'This election is not currently active.');
        }

        $alreadyVoted = VoterElection::where('voter_id', session('voter_id'))
                        ->where('election_id', $election->id)
                        ->where('has_voted', true)
                        ->exists();

        if ($alreadyVoted) {
            return redirect()->route('voter.dashboard')->with('error', 'You have already voted in this election.');
        }

        $candidates = Candidate::where('election_id', $election->id)->get();
        return view('voting.vote', compact('election', 'candidates'));
    }

    public function castVote(Request $request, Election $election) {
        if (!session('voter_id')) {
            return redirect()->route('voter.login');
        }

        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        $voterId = session('voter_id');

        $alreadyVoted = VoterElection::where('voter_id', $voterId)
                        ->where('election_id', $election->id)
                        ->where('has_voted', true)
                        ->exists();

        if ($alreadyVoted) {
            return redirect()->route('voter.dashboard')->with('error', 'You have already voted in this election.');
        }

        $candidate = Candidate::where('id', $request->candidate_id)
                    ->where('election_id', $election->id)
                    ->firstOrFail();

        $encryptedVote = Crypt::encryptString($candidate->id);
        $voteHash = hash('sha256', $voterId . $election->id . $candidate->id . now());

        Vote::create([
            'election_id'    => $election->id,
            'encrypted_vote' => $encryptedVote,
            'vote_hash'      => $voteHash,
            'voted_at'       => now(),
        ]);

        VoterElection::updateOrCreate(
            ['voter_id' => $voterId, 'election_id' => $election->id],
            ['has_voted' => true, 'voted_at' => now()]
        );

        AuditLog::record('Vote cast', $voterId, 'voter', 'success', 'Election #' . $election->id);

        return redirect()->route('voter.voting.confirmation', $election)
                         ->with('success', 'Your vote has been cast successfully!');
    }

    public function confirmation(Election $election) {
        if (!session('voter_id')) {
            return redirect()->route('voter.login');
        }
        return view('voting.confirmation', compact('election'));
    }
}