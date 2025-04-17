<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            'Màu' => ['Đỏ', 'Xanh', 'Vàng', 'Đen'],
            'Phiên bản' => ['Gốc', 'Thường', 'Xịn', 'Qúy tộc'],
            'Loại' => ['Gốc', 'Cải tiến', 'Tùy chỉnh'],
            'Trọng lượng' => ['500g', '200g', '100g'],
        ];
        foreach ($options as $optionName => $values) {
            $option = Option::create([
                'name' => $optionName,
                'status' => 1,
            ]);
    
            foreach ($values as $value) {
                \App\Models\OptionValue::create([
                    'option_id' => $option->id,
                    'value_name' => $value,
                    'status' => 1,
                ]);
            }
        }
    }
}
