<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientTestimonial extends Model
{
    use HasFactory;

    protected $table = "client_testimonials";

    protected $fillable = [
        'video_link','client_name','status','position'
    ];

    const ID = "id";
}
