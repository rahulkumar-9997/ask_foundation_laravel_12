<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{
    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'slug', 
        'short_desc',
        'content', 
        'meta_title',
        'meta_description',
        'featured_image',
        'status',
        'user_id'
    ];

    public function images(): HasMany
    {
        return $this->hasMany(BlogImages::class, 'blog_id');
    }
    public function paragraphs(): HasMany
    {
        return $this->hasMany(BlogParagraphs::class, 'blog_id')->orderBy('sort_order');
    }
}
