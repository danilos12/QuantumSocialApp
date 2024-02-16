<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulk_post extends Model
{
    use HasFactory;

    protected $table = 'bulk_post';
    protected $fillable = [
        'user_id',
        'twitter_id',
        'post_type',
        'post_description',
        'sched_method',
        'sched_time',
        'link_url',
        'image_url',
        'meta_title',
        'meta_description',
        'meta_image',
    ];
    public $timestamps = true;
}
