<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwitterSettings extends Model
{
    use HasFactory;

    protected $table = 'settings_twitter';
    protected $fillable = [
        'twitter_id',
        'toggle_1', 
        'toggle_2', 
        'toggle_3', 
        'toggle_4', 
        'toggle_5', 
        'toggle_6', 
        'toggle_7', 
        'toggle_8', 
        'toggle_9',
        'toggle_10'
    ];
    public $timestamps = true;

}
