<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['category_id', 'title', 'description', 'link'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'project_tag');
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public static function getByCategory($categoryId)
    {
        return self::where('category_id', $categoryId)->active()->get();
    }

    protected static function booted()
    {
        static::created(function ($project) {
            // Logic after a project is created, like clearing cache, logging, etc.
        });
    }
}
