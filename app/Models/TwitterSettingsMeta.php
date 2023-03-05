<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwitterSettingsMeta extends Model
{
    use HasFactory;

    protected $table = 'qts_tweetmeta';
    protected $fillable = [
        'user_id',
        'twitter_id',
        'meta_key', 
        'meta_value'
    ];
}
