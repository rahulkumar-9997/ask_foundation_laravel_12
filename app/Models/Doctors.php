<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Doctors extends Model
{
    protected $table = 'doctors';
    protected $fillable = [
        'doctor_name', 'slug', 'department', 'experience', 'work_location', 'short_content', 'image', 'content', 'role_in_ask_foundation', 'status'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($doctor) {
            $doctor->slug = $doctor->generateUniqueSlug($doctor->doctor_name);
        });
    }
    /**
     * Generate unique slug from doctor name
     */
    private function generateUniqueSlug($doctorName)
    {
        $slug = Str::slug($doctorName);
        $count = static::where('slug', 'LIKE', "{$slug}%")->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }

}
