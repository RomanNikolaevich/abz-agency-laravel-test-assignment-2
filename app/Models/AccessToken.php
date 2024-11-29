<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    protected $fillable = ['token', 'expires_at', 'is_used'];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

}
