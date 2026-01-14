<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BrandPortfolio;

class BrandService extends Model
{
    use HasFactory;

    protected $table ="brand_services";

    protected $fillable = [
        'brand_id','image','video_link','title','description','status','position','files'
    ];

    const ID = "id";

    public function brand()
    {
        return $this->belongsTo(BrandPortfolio::class, 'brand_id');
    }
}
