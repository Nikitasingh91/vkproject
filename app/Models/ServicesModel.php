<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicesModel extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'banner_image',
        'gallery_images',
        'heading_top',
        'slug',
        'heading_middle',
        'long_description',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'slide_status',
        'slide_sorting',
    ];

    protected $casts = [
        'gallery_images' => 'array',  // automatically cast JSON to array
    ];

    // Define constants for the field names (optional, as seen in your DataTable)
    const ID = 'id';
    const BANNER_IMAGE = 'banner_image';
    const GALLERY_IMAGES = 'gallery_images';
    const HEADING_TOP = 'heading_top';
    const SLUG = 'slug';
    const HEADING_MIDDLE = 'heading_middle';
    const LONG_DESCRIPTION = 'long_description';
    const SEO_TITLE = 'seo_title';
    const SEO_DESCRIPTION = 'seo_description';
    const SEO_KEYWORDS = 'seo_keywords';
    const SLIDE_STATUS = 'slide_status';
    const SLIDE_SORTING = 'slide_sorting';
}
