<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'company_name',
        'message',
        'status',
        'sorting',
    ];

    /**
     * Scope a query to only include active testimonials, ordered by sorting.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1)->orderBy('sorting', 'asc')->orderBy('id', 'desc');
    }
}
