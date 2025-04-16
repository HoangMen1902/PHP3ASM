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
            Card::make('Khách hàng', User::count())
                ->description('Số lượng khách hàng')
                ->color('primary'),
        
            Card::make('Sản phẩm', Product::count())
                ->description('Số lượng sản phẩm')
                ->color('success'),
        
            Card::make('Danh mục sản phẩm', Category::count())
                ->description('Số lượng danh mục sản phẩm')
                ->color('info'),
        ];
        
    }
}


