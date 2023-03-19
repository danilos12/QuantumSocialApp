<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSettingsMeta extends Model
{
    use HasFactory;

    protected $table = 'qgs_settingsmeta';
    protected $fillable = [
        'user_id',
        'meta_key', 
        'meta_value'
    ];
}
