<?php
namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Order;

class RevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Doanh thu theo tháng';

    protected function getData(): array
    {
        $revenues = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('total', 'month');

        $labels = [];
        $data = [];

        foreach (range(1, 12) as $month) {
            $labels[] = 'Tháng ' . $month;
            $data[] = $revenues[$month] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Doanh thu',
                    'data' => $data,
                    'backgroundColor' => '#10b981',
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

