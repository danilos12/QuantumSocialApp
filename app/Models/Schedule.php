<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedule';
    protected $fillable = [
        'user_id',
        'slot_day',
        'hour',
        'minute_at',
        'ampm',
        'post_type'
    ];
    public $timestamps = true;
}
