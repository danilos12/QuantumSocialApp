<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwitterApiCredentials extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'settings_twitter_twapi';
    protected $fillable = [
        'user_id',
        'twitter_id',
        'api_key',
        'api_secret',
        'bearer_token', 
        'access_token',
        'token_secret',
    ];
    public $timestamps = true;
}
    