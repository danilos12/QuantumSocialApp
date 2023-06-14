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
    protected $table = 'settings_general_twapi';
    protected $fillable = [
        'twitter_id',
        'api_key',
        'api_secret',
        'bearer_token', 
        'oauth_id',
        'oauth_secret',
    ];
    public $timestamps = true;
}
    