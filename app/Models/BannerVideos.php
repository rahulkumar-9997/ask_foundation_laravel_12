<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerVideos extends Model
{
    protected $table = 'banner_videos';
    protected $fillable = [
        'title',
        'subtitle', 
        'description',
        'button_link',
        'video_popup_url',
        'desktop_video_url',
        'mobile_video_url',
        'features',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean'
    ];
}
