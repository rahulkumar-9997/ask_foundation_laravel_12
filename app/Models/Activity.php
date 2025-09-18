<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Activity extends Model
{
    use HasFactory;
    protected $table = 'activities';
    protected $fillable = [
        'title',
        'slug',
        'short_content',
        'long_content',
        'main_image',
        'page_image',
        'meta_title',
        'meta_description',
        'status',
        'post_date',
    ];

    /**
     * One Activity has many images
     */
    public function images()
    {
        return $this->hasMany(ActivitiesImage::class, 'activities_id');
    }

    /**
     * One Activity has many videos
     */
    public function videos()
    {
        return $this->hasMany(ActivitiesVideo::class, 'activities_id');
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($page) {
            $page->slug = $page->createSlug($page->title);
        });
    }

    private function createSlug($title)
    {
        $slug = Str::slug($title);
        $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }
}
