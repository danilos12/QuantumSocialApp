<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuantumAcctMeta extends Model
{
    use HasFactory;

    protected $table = 'users_meta';
    protected $fillable = [
        'user_id',
        'subscription', 
        'subscription_free_counter',
        'member_count',
        'status',
        'timezone'
    ];
}
