<?php
namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Vertical extends Model
{
    protected $fillable = [
        "vertical_name",
        "vertical_image",
        "differentiators",
        "status",
        "created_by",
        "updated_by",
    ];
     protected static function boot()
    {
        parent::boot();

        // Auto Slug Create
        static::creating(function ($vertical) {
            $vertical->slug = Str::slug($vertical->vertical_name, '-');
        });

        // Auto Slug Update when Vertical Name is changed
        static::updating(function ($vertical) {
            if ($vertical->isDirty('vertical_name')) {
                $vertical->slug = Str::slug($vertical->vertical_name, '-');
            }
        });
    }
}