<?php
namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class TopSellingProductsChart extends ChartWidget
{
    protected static ?string $heading = 'Top 5 sản phẩm bán chạy';

    protected function getData(): array
    {
        $topProducts = DB::table('order_details')
            ->select('sku_id', DB::raw('SUM(quantity) as total'))
            ->groupBy('sku_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $labels = [];
        $data = [];

        foreach ($topProducts as $item) {
            $product = Product::find($item->sku_id);
            $labels[] = $product?->name ?? 'Không rõ';
            $data[] = $item->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Số lượng bán',
                    'data' => $data,
                    'backgroundColor' => '#f97316',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar'; 
    }
}
