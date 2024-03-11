<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Members extends Authenticatable

{
    use HasApiTokens,HasFactory,Notifiable;


    protected $table = 'members';

    protected $fillable = [
        'fullname',
        'email',
        'password',
        'role',
    ];


    protected $hidden = [
        'password','remember_token'
    ];


}
