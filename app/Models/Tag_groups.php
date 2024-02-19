<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag_groups extends Model
{
    use HasFactory;

    protected $table = 'tag_groups_meta';
    protected $fillable = [
        'user_id',
        'twitter_id',
        'tag_group_mkey',
        'tag_group_mvalue'
    ];
    public $timestamps = true;
}
