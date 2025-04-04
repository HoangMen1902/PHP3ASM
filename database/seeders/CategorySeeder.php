<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $categories = [
            'Sáp vuốt tóc',
            'Pomade',
            'Gôm xịt tóc',
            'Dầu gội đầu',
            'Dầu xả tóc',
            'Dầu gội khô',
            'Dầu dưỡng râu',
            'Tinh dầu dưỡng tóc',
            'Máy sấy tóc',
            'Tông đơ cắt tóc',
            'Lược tạo kiểu',
            'Kéo cắt tóc chuyên dụng',
            'Khăn phủ barber',
            'Áo choàng cắt tóc',
            'Ghế cắt tóc barber',
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'status' => 1,
            ]);
        }
    }
}
