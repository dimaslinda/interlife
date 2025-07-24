<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SeoSetting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'page_name',
        'title',
        'description',
        'keywords',
        'author',
        'robots',
        'language',
        'revisit_after',
        'geo_region',
        'geo_placename',
        'theme_color',
        'og_title',
        'og_description',
        'og_image_width',
        'og_image_height',
        'og_type',
        'og_site_name',
        'twitter_card',
        'twitter_title',
        'twitter_description',
        'pinterest_description',
        'msapplication_tile_color',
        'canonical_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByPage($query, $pageName)
    {
        return $query->where('page_name', $pageName);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(200)
            ->sharpen(10);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('twitter_images')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('pinterest_images')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('og_images')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('favicons')
            ->singleFile()
            ->acceptsMimeTypes(['image/x-icon', 'image/png']);

        $this->addMediaCollection('apple_touch_icons')
            ->singleFile()
            ->acceptsMimeTypes(['image/png']);

        $this->addMediaCollection('ms_tile_images')
            ->singleFile()
            ->acceptsMimeTypes(['image/png']);
    }
}
