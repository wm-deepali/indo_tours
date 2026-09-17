<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'subtitle',
        'image',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function ($category) {
            if (empty($category->slug)) {
                $category->slug = static::uniqueSlug($category->name, $category->id);
            }
        });
    }

    public static function uniqueSlug($name, $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i    = 1;

        while (static::where('slug', $slug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'blog_category_id');
    }

    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }

    public function scopeOrdered($q)
    {
        return $q->orderBy('sort_order')->orderBy('name');
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image && file_exists(public_path($this->image))
            ? asset($this->image)
            : asset('assets/images/blog/banner.avif');
    }
}