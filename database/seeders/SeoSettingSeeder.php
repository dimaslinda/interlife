<?php

namespace Database\Seeders;

use App\Models\SeoSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeoSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SeoSetting::create([
            'page_name' => 'home',
            'title' => 'Interlife Furniture - Jasa Pembuatan Kitchen Set & Custom Furniture Berkualitas',
            'description' => 'Interlife Furniture menyediakan jasa pembuatan kitchen set, custom furniture, dan interior berkualitas tinggi dengan desain modern dan elegan. Wujudkan hunian impian Anda bersama kami.',
            'keywords' => 'kitchen set, custom furniture, interior design, furniture custom, jasa interior, kitchen set murah, furniture jepara, furniture minimalis, furniture custom jakarta, kitchen set jakarta, interior rumah, desain interior, furniture berkualitas, jasa desain interior',
            'author' => 'Interlife Furniture',
            'robots' => 'index, follow',
            'language' => 'Indonesia',
            'revisit_after' => '7 days',
            'geo_region' => 'ID-JK',
            'geo_placename' => 'Jakarta',
            'theme_color' => '#6d705d',
            'og_title' => 'Interlife Furniture - Jasa Pembuatan Kitchen Set & Custom Furniture',
            'og_description' => 'Wujudkan hunian impian Anda dengan kitchen set dan custom furniture berkualitas tinggi dari Interlife Furniture. Desain modern, elegan, dan terpercaya.',
            'og_image_width' => '1200',
            'og_image_height' => '630',
            'og_type' => 'website',
            'og_site_name' => 'Interlife Furniture',
            'twitter_card' => 'summary_large_image',
            'twitter_title' => 'Interlife Furniture - Kitchen Set & Custom Furniture',
            'twitter_description' => 'Jasa pembuatan kitchen set dan custom furniture berkualitas dengan desain modern dan elegan. Wujudkan hunian impian Anda bersama Interlife Furniture.',
            'pinterest_description' => 'Jasa pembuatan kitchen set dan custom furniture berkualitas dengan desain modern dan elegan. Wujudkan hunian impian Anda bersama Interlife Furniture.',
            'msapplication_tile_color' => '#6d705d',
            'canonical_url' => null, // akan diisi dinamis
            'is_active' => true,
        ]);
    }
}
