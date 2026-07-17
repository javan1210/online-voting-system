<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model {
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'user_type', 'action', 'ip_address', 'user_agent', 'outcome', 'notes'
    ];
    protected $casts = ['created_at' => 'datetime'];

    public static function record($action, $userId = null, $userType = null, $outcome = 'success', $notes = null) {
        return self::create([
            'user_id'    => $userId,
            'user_type'  => $userType,
            'action'     => $action,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'outcome'    => $outcome,
            'notes'      => $notes,
        ]);
    }
}