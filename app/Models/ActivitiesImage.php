<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitiesImage extends Model
{
    use HasFactory;
    protected $table = 'activities_images';
    protected $fillable = [
        'activities_id',
        'title',
        'image',
        'short_order',
    ];

    /**
     * Each image belongs to one activity
     */
    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activities_id');
    }
}
