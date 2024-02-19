<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag_items extends Model
{
    use HasFactory;

    protected $table = 'tag_items_meta';
    protected $fillable = [
        'user_id',
        'twitter_id',
        'tag_meta_key',
        'tag_meta_value'
    ];
    public $timestamps = true;
}
