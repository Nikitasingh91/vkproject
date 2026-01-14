<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoEnquiry extends Model
{
    use HasFactory;

    protected $table = "seo_enquiries";
    protected $fillable = [
        'phone_number','name' ,'message' ,'ip_address'
    ];
     const ID = "id";
    const NAME = "name";
    const PHONE_NUMBER = "phone_number";
    const MESSAGE = "message";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    const IP_ADDRESS = "ip_address";
}
