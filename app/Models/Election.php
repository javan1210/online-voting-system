<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Election extends Model {
    protected $fillable = ['title', 'description', 'start_date', 'end_date', 'status'];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
    public function candidates() {
        return $this->hasMany(Candidate::class);
    }
    public function votes() {
        return $this->hasMany(Vote::class);
    }
    public function voters() {
        return $this->belongsToMany(Voter::class, 'voter_elections')
                    ->withPivot('has_voted', 'voted_at');
    }
    public function isActive() {
        return $this->status === 'active';
    }
}