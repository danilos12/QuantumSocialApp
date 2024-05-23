<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwitterSettingsMeta extends Model
{
    use HasFactory;

    protected $table = 'settings_twitter_meta';
    protected $fillable = [
        'twitter_id', 
        'auto_reply_text', 
        'text_draft_ender', 
        'eg_rt_retweets', 
        'eg_rt_likes', 
        'he_rt_likes', 
        'he_rt_retweets',
        'rt_auto_time', 
        'rt_auto_frame', 
        'rt_auto_ite', 
        'rt_auto_rm_time', 
        'rt_auto_rm_frame', 
        'text_comment_offer', 
        'text_ender_dm', 
    ];
    public $timestamps = true;
}
