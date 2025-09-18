<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitiesVideo extends Model
{
    use HasFactory;
    protected $table = 'activities_videos';
    protected $fillable = [
        'activities_id',
        'title',
        'video_path',
        'video_link',
        'short_order',
    ];

    /**
     * Each video belongs to one activity
     */
    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activities_id');
    }
}
