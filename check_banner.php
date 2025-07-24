<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Banner;

echo "Checking banner data:\n";

$banners = Banner::all();
echo "Total banners: " . $banners->count() . "\n";

foreach($banners as $banner) {
    echo "Banner ID: {$banner->id}, Title: {$banner->title}, Active: " . ($banner->is_active ? 'Yes' : 'No') . "\n";
    echo "Media count: " . $banner->media->count() . "\n";
    if($banner->media->count() > 0) {
        echo "Media URL: " . $banner->getFirstMediaUrl('banners') . "\n";
    }
    echo "---\n";
}

$activeBanner = Banner::where('is_active', true)->first();
if($activeBanner) {
    echo "Active banner found: {$activeBanner->title}\n";
    echo "Media URL: " . $activeBanner->getFirstMediaUrl('banners') . "\n";
} else {
    echo "No active banner found\n";
}