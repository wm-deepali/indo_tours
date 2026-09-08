<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    protected $table = 'seo_settings';

    protected $fillable = [
        'page_key',
        'page_label',
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
        'og_image',
        'twitter_card_type',
        'twitter_title',
        'twitter_description',
        'twitter_image',
    ];

    public static function forPage(string $pageKey): ?self
    {
        return static::where('page_key', $pageKey)->first();
    }
}