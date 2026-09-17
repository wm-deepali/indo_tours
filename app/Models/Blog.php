<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_category_id',
        'author_id',
        'title',
        'slug',
        'tag',
        'featured_image',
        'short_description',
        'content',
        'views',
        'published_at',
        'status',

        'destination_heading',
        'destination_description',

        'attraction_heading',
        'attraction_description',

        'activity_heading',
        'activity_description',

        'tour_package_heading',
        'tour_package_description',

        'h1',
        'meta_title',
        'meta_description',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'twitter_card_image',
        'robots',
    ];

    protected $casts = [
        'published_at' => 'date',
        'views' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saving(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = static::uniqueSlug($blog->title, $blog->id);
            }
        });
    }

    public static function uniqueSlug($title, $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 1;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    /* ---------------- Relations ---------------- */

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'blog_destination')
            ->withPivot('sort_order')
            ->orderBy('blog_destination.sort_order');
    }

    public function attractions()
    {
        return $this->belongsToMany(Attraction::class, 'blog_attraction')
            ->withPivot('sort_order')
            ->orderBy('blog_attraction.sort_order');
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'blog_activity')
            ->withPivot('sort_order')
            ->orderBy('blog_activity.sort_order');
    }

    public function tourPackages()
    {
        return $this->belongsToMany(TourPackage::class, 'blog_tour_package')
            ->withPivot('sort_order')
            ->orderBy('blog_tour_package.sort_order');
    }

    /* ---------------- Scopes ---------------- */

    public function scopePublished($q)
    {
        return $q->where('status', 'published');
    }

    public function scopeOrdered($q)
    {
        return $q->orderByDesc('published_at')->orderByDesc('id');
    }

    /* ---------------- Accessors ---------------- */

    public function getFeaturedImageUrlAttribute(): string
    {
        return $this->featured_image && file_exists(public_path($this->featured_image))
            ? asset($this->featured_image)
            : asset('assets/images/blog/banner.avif');
    }

    public function getCanonicalUrlDefaultAttribute(): string
    {
        return $this->canonical_url ?: url('/blog/' . $this->slug . '/');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(BlogComment::class)->approved()->latest();
    }

}