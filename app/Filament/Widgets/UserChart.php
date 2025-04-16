<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;

class UserChart extends ChartWidget
{
    protected static ?string $heading = 'Người dùng theo tháng';

    protected function getData(): array
    {
        $users = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('count', 'month'); 
        $labels = [];
        $data = [];

        foreach (range(1, 12) as $month) {
            $labels[] = 'Tháng ' . $month;
            $data[] = $users[$month] ?? 0; 
        }
        return [
            'datasets' => [
                [
                    'label' => 'Người dùng mới',
                    'data' => $data,
                    'backgroundColor' => 'rgba(59, 130, 246, 0.6)',
                    'borderColor' => 'rgba(59, 130, 246, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
