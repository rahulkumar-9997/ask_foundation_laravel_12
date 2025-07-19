<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageComponents extends Model
{
    protected $table = 'page_components';
    protected $fillable = [
        'page_id', 'component_type', 'component_data', 'order', 'section', 'is_active'
    ];

    protected $casts = [
        'component_data' => 'array',
        'is_active' => 'boolean'
    ];
    
}
