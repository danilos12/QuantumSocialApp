<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulk_meta extends Model
{
    use HasFactory;

    protected $table = 'bulk_meta';
    protected $fillable = [
        'link_url',
        'meta_title',
        'meta_description',
        'meta_image',
    ];
    public $timestamps = true;
}
