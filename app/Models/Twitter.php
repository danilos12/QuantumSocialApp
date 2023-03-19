<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Twitter extends Model
{
    use HasFactory;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'twitter_accts';
    protected $fillable = [
        'twitter_id',
        'twitter_name',
        'twitter_username',
        'twitter_photo',
        'twitter_description',
        'twitter_followingCount',
        'twitter_followersCount',
        'twitter_tweetCount',
        'user_id',
        'deleted'
    ];
}
