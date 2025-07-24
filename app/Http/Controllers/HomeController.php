<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Banner;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Partner;
use App\Models\Process;
use App\Models\Contact;
use App\Models\SeoSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $features = Feature::all();
        $banner = Banner::where('is_active', true)->with('media')->first();
        $services = Service::active()->ordered()->with('media')->get();
        $portfolioCategories = PortfolioCategory::active()->ordered()->get();
        $portfolios = Portfolio::active()->ordered()->with(['media', 'portfolioCategory'])->get();
        $partners = Partner::active()->ordered()->with('media')->get();
        $processes = Process::active()->ordered()->get();
        $contacts = Contact::active()->ordered()->get();
        $seoSetting = SeoSetting::active()->byPage('home')->first();
        return view('index', compact('features', 'banner', 'services', 'portfolioCategories', 'portfolios', 'partners', 'processes', 'contacts', 'seoSetting'));
    }
}
