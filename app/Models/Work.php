<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = [
        'thumbnail',
        'video',
        'title',
        'content',
    ];
}
