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
        'subscription_id',
        'timezone',
        'trial_counter',
        'status',
        'queue_switch',
        'promo_switch',
        'evergreen_switch',
    ];
}
