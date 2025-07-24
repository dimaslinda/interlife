<?php

namespace App\Filament\Widgets;

use App\Models\Portfolio;
use App\Models\Partner;
use App\Models\Service;
use App\Models\PortfolioCategory;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Portfolio', Portfolio::count())
                ->description('Portfolio yang telah dibuat')
                ->descriptionIcon('heroicon-m-photo')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            
            Stat::make('Partner Aktif', Partner::where('is_active', true)->count())
                ->description('Partner yang sedang aktif')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('info')
                ->chart([3, 5, 2, 8, 6, 4, 9]),
            
            Stat::make('Layanan Aktif', Service::where('is_active', true)->count())
                ->description('Layanan yang tersedia')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('warning')
                ->chart([2, 4, 6, 3, 8, 5, 7]),
            
            Stat::make('Kategori Portfolio', PortfolioCategory::where('is_active', true)->count())
                ->description('Kategori portfolio aktif')
                ->descriptionIcon('heroicon-m-tag')
                ->color('primary')
                ->chart([1, 3, 2, 5, 4, 6, 8]),
        ];
    }
}