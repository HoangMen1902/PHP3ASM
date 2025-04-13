<?php


namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class OverviewStatsWidget extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Users', User::count())
                ->description('All registered users')
                ->color('primary'),
        
            Card::make('Products', Product::count())
                ->description('Total available products')
                ->color('success'),
        
            Card::make('Categories', Category::count())
                ->description('Product categories')
                ->color('info'),
        ];
        
    }
}


