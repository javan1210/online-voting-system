<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model {
    protected $fillable = [
        'election_id', 'full_name', 'party', 'position', 'bio', 'photo_url'
    ];
    public function election() {
        return $this->belongsTo(Election::class);
    }
}