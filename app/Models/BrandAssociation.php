<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandAssociation extends Model
{
    use HasFactory;

    protected $table = "brand_associations";

    protected $fillable = [
        'image','status' ,'position' ,'id'
    ];

    const ID = "id";
}
