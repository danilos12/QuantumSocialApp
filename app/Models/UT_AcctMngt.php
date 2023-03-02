<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UT_AcctMngt extends Model
{
    use HasFactory;

    protected $table = 'ut_acct_mngt';
    protected $fillable = ['user_id', 'twitter_id', 'selected'];
}
