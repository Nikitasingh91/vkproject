<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverView extends Model
{
    use HasFactory;

    protected $table = "over_views";
    protected $fillable = [
        'image','status','title','video_link'
    ];

    const ID = "id";
}
