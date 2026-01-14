<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\BrandService;

class BrandPortfolio extends Model
{
    use HasFactory;

    protected $table = "brand_portfolios";
    protected $fillable = [
        'icon','title','status','position','banner_image','description',
    ];

    const ID = "id";

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($portfolio) {
            $portfolio->slug = self::generateUniqueSlug($portfolio->title);
        });

        static::updating(function ($portfolio) {
            if ($portfolio->isDirty('title')) {
                $portfolio->slug = self::generateUniqueSlug($portfolio->title, $portfolio->id);
            }
        });
    }

    protected static function generateUniqueSlug($title)
    {
        return Str::slug($title); 
    }

    public function services()
    {
        return $this->hasMany(BrandService::class, 'brand_id');
    }
}
