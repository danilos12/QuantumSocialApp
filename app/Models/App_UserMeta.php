<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App_UserMeta extends Model
{
    use HasFactory;
    protected $table = 'app_usermeta';
    protected $fillable = [
        'user_id',
        'meta_key',
        'meta_value	'
    ];
}
