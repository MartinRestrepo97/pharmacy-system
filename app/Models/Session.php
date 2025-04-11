<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'ip_address_varchar_45',
        'user_agent_text',
        'payload_longtext',
        'last_activity_int',
    ];

    protected $casts = [
        'last_activity_int' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}