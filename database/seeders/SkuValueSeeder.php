<?php

namespace Database\Seeders;

use App\Models\SkuValue;
use Illuminate\Database\Seeder;

class SkuValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dữ liệu mẫu cho sku_values
        $sku_values = [
            [
                'sku_id' => 1, // Liên kết với SKU có ID = 1
                'option_id' => 1, // Ví dụ: màu sắc (option_id)
                'value_id' => 1, // Ví dụ: màu đen (value_id)
            ],
            [
                'sku_id' => 1, // Liên kết với SKU có ID = 1
                'option_id' => 2, // Ví dụ: kích thước (option_id)
                'value_id' => 2, // Ví dụ: kích thước M (value_id)
            ],
            [
                'sku_id' => 2, // Liên kết với SKU có ID = 2
                'option_id' => 1, // Ví dụ: màu sắc (option_id)
                'value_id' => 2, // Ví dụ: màu xanh (value_id)
            ],
            [
                'sku_id' => 2, // Liên kết với SKU có ID = 2
                'option_id' => 2, // Ví dụ: kích thước (option_id)
                'value_id' => 1, // Ví dụ: kích thước L (value_id)
            ],
            [
                'sku_id' => 3, // Liên kết với SKU có ID = 3
                'option_id' => 1, // Ví dụ: màu sắc (option_id)
                'value_id' => 1, // Ví dụ: màu đen (value_id)
            ],
            // Thêm các SKU khác nếu cần
        ];

        // Chèn dữ liệu vào bảng 'sku_values'
        foreach ($sku_values as $sku_value) {
            SkuValue::create([
                'sku_id' => $sku_value['sku_id'],
                'option_id' => $sku_value['option_id'],
                'value_id' => $sku_value['value_id'],
            ]);
        }
    }
}
