<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalAuth extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'token',
        'provider',
        'provider_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
