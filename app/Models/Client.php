<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'image',
        'status',
        'sorting',
    ];

    // Scope to get only active clients ordered by sorting
    public function scopeActive($query)
    {
        return $query->where('status', 1)->orderBy('sorting', 'asc');
    }
}
