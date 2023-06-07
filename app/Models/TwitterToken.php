<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwitterToken extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'twitter_meta';
    protected $fillable = [
        'user_id', 
        'twitter_id', 
        'access_token', 
        'refresh_token',
        'expires_in',
        'active',
        'queue_switch'
    ];
}
