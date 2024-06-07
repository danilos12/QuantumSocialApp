<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSettings extends Model
{
    use HasFactory;

    protected $table = 'settings_toggler_general';
    protected $fillable = [
        'user_id',
        'toggle_1', 
        'toggle_2', 
        'toggle_3', 
        'toggle_4', 
        'toggle_5', 
        'toggle_6', 
        'toggle_7', 
    ];
    public $timestamps = true;
}
