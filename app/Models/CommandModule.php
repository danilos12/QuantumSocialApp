<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandModule extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = [
        'user_id',
        'twitter_id',
        'post_type',
        'post_description',
        'tweetlink',
        'rt_time',
        'rt_frame',
        'rt_ite',
        'promo_id',
        'sched_method',
        'sched_time',
        'crosstweet_accts',
        'post_type_code',
        'active'
    ];
    public $timestamps = true;
}
