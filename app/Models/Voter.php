<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Voter extends Authenticatable {
    protected $fillable = [
        'national_id', 'full_name', 'date_of_birth', 'email',
        'phone', 'password', 'is_verified', 'otp_code',
        'otp_expires_at', 'login_attempts', 'locked_until'
    ];
    protected $hidden = ['password', 'otp_code'];
    protected $casts = [
        'is_verified' => 'boolean',
        'otp_expires_at' => 'datetime',
        'locked_until' => 'datetime',
    ];
    public function elections() {
        return $this->belongsToMany(Election::class, 'voter_elections')
                    ->withPivot('has_voted', 'voted_at');
    }
    public function auditLogs() {
        return $this->hasMany(AuditLog::class, 'user_id');
    }
}