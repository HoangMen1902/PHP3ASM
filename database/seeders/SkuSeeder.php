<?php

namespace Database\Seeders;

use App\Models\ProductSku;
use Illuminate\Database\Seeder;

class SkuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dữ liệu mẫu cho các sản phẩm và SKU
        $skus = [
            [
                'sku' => 'SKU12345',
                'images' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
                'price' => 15,
                'quantity' => 50,
                'product_id' => 1,  
            ],
            [
                'sku' => 'SKU12346',
                'images' => '01JSBRR03EPSP5J4CCQAXXF58Y.png',
                'price' => 16,
                'quantity' => 30,
                'product_id' => 1,  
            ],
            [
                'sku' => 'SKU22345',
                'images' => '01JSBRR03EPSP5J4CCQAXXF58Y.png',
                'price' => 20,
                'quantity' => 40,
                'product_id' => 2,  
            ],
            [
                'sku' => 'SKU22346',
                'images' => '01JSBRR03EPSP5J4CCQAXXF58Y.png',
                'price' => 21,
                'quantity' => 25,
                'product_id' => 2,  
            ],
            [
                'sku' => 'SKU32345',
                'images' => '01JSBRR03EPSP5J4CCQAXXF58Y.png',
                'price' => 25,
                'quantity' => 10,
                'product_id' => 3,  
            ],
            [
                'sku' => 'SKU32346',
                'images' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
                'price' => 26,
                'quantity' => 20,
                'product_id' => 3,  
            ],
            [
                'sku' => 'SKU42345',
                'images' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
                'price' => 30,
                'quantity' => 15,
                'product_id' => 4,  
            ],
            [
                'sku' => 'SKU32345',
                'images' => '01JSBRR03EPSP5J4CCQAXXF58Y.png',
                'price' => 25,
                'quantity' => 10,
                'product_id' => 5,  
            ],
            [
                'sku' => 'SKU32346',
                'images' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
                'price' => 26,
                'quantity' => 20,
                'product_id' => 5,  
            ],  [
                'sku' => 'SKU32345',
                'images' => '01JSBRR03EPSP5J4CCQAXXF58Y.png',
                'price' => 25,
                'quantity' => 10,
                'product_id' => 6,  
            ],
            [
                'sku' => 'SKU32346',
                'images' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
                'price' => 26,
                'quantity' => 20,
                'product_id' => 6,  
            ],  [
                'sku' => 'SKU32345',
                'images' => '01JSBRR03EPSP5J4CCQAXXF58Y.png',
                'price' => 25,
                'quantity' => 10,
                'product_id' => 7,  
            ],
            [
                'sku' => 'SKU32346',
                'images' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
                'price' => 26,
                'quantity' => 20,
                'product_id' => 7,  
            ],  [
                'sku' => 'SKU32345',
                'images' => '01JSBRR03EPSP5J4CCQAXXF58Y.png',
                'price' => 25,
                'quantity' => 10,
                'product_id' => 8,  
            ],
            [
                'sku' => 'SKU32346',
                'images' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
                'price' => 26,
                'quantity' => 20,
                'product_id' => 8,  
            ],  [
                'sku' => 'SKU32345',
                'images' => '01JSBRR03EPSP5J4CCQAXXF58Y.png',
                'price' => 25,
                'quantity' => 10,
                'product_id' => 9,  
            ],
            [
                'sku' => 'SKU32346',
                'images' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
                'price' => 26,
                'quantity' => 20,
                'product_id' => 9,  
            ],
        ];

        // Chèn dữ liệu vào bảng 'product_skus'
        foreach ($skus as $sku) {
            ProductSku::create([
                'sku' => $sku['sku'],
                'images' => $sku['images'],
                'price' => $sku['price'],
                'quantity' => $sku['quantity'],
                'product_id' => $sku['product_id'],
            ]);
        }
    }
}
