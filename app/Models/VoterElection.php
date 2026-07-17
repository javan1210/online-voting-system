<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class VoterElection extends Model {
    protected $table = 'voter_elections';
    public $timestamps = false;
    protected $fillable = ['voter_id', 'election_id', 'has_voted', 'voted_at'];
    protected $casts = [
        'has_voted' => 'boolean',
        'voted_at'  => 'datetime',
    ];
    public function voter() {
        return $this->belongsTo(Voter::class);
    }
    public function election() {
        return $this->belongsTo(Election::class);
    }
}