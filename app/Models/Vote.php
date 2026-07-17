<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model {
    public $timestamps = false;
    protected $fillable = ['election_id', 'encrypted_vote', 'vote_hash', 'voted_at'];
    protected $casts = ['voted_at' => 'datetime'];
    public function election() {
        return $this->belongsTo(Election::class);
    }
}