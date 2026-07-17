<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable {
    protected $fillable = ['username', 'email', 'password', 'role', 'last_login'];
    protected $hidden = ['password'];
    protected $casts = ['last_login' => 'datetime'];

    public function isSuperAdmin() {
        return $this->role === 'superadmin';
    }
}