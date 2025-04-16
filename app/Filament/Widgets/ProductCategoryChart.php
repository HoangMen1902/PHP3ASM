<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Product;
use App\Models\Category;

class ProductCategoryChart extends ChartWidget
{
    protected static ?string $heading = 'Tỷ lệ sản phẩm theo danh mục';

    protected function getData(): array
    {
        $categories = Category::all();
        $labels = [];
        $data = [];
        
        $totalProducts = Product::count();

        foreach ($categories as $category) {
            $labels[] = $category->name;
            $data[] = $category->products()->count(); 
        }

        $colors = array_map(function ($index) {
            return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        }, range(1, count($categories)));

        return [
            'datasets' => [
                [
                    'label' => 'Sản phẩm',
                    'data' => $data,
                    'backgroundColor' => $colors,
                ],
            ],
            'labels' => $labels,
            'options' => [
                'responsive' => true,
                'plugins' => [
                    'tooltip' => [
                        'enabled' => false,
                    ],
                    'legend' => [
                        'display' => true,
                        'position' => 'bottom',
                        'labels' => [
                            'boxWidth' => 8,
                            'padding' => 10,
                            'font' => [
                                'size' => 10,
                            ],
                        ],
                    ],
                    'datalabels' => [
                        'anchor' => 'center',
                        'align' => 'center',
                        'color' => '#fff',
                        'font' => [
                            'weight' => 'bold',
                            'size' => 10,
                        ],
                        'formatter' => function ($value, $context) use ($totalProducts) {
                            $percentage = ($value / $totalProducts) * 100;
                            return round($percentage, 2) . '%';
                        },
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
