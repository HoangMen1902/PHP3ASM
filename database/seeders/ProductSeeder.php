<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Sáp vuốt tóc Gatsby Moving Rubber',
                'category_id' => 1,
                'short_description' => 'Sáp vuốt tóc giữ nếp lâu, dễ gội rửa',
                'description' => 'Gatsby Moving Rubber là dòng sáp vuốt tóc nổi tiếng của Nhật Bản...',
                'thumbnail' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
            ],
            [
                'name' => 'Pomade Reuzel Blue Strong Hold',
                'category_id' => 2,
                'short_description' => 'Pomade gốc nước, độ bóng trung bình',
                'description' => 'Pomade Reuzel Blue cho độ giữ nếp mạnh mẽ...',
                'thumbnail' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
            ],
            [
                'name' => 'Gôm xịt tóc Osis+ Freeze',
                'category_id' => 3,
                'short_description' => 'Gôm xịt giữ nếp siêu mạnh',
                'description' => 'Gôm Osis+ Freeze là sản phẩm chuyên nghiệp...',
                'thumbnail' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
            ],
            [
                'name' => 'Dầu gội X-Men For Boss',
                'category_id' => 4,
                'short_description' => 'Dầu gội sạch gàu, thơm lâu',
                'description' => 'X-Men for Boss là dòng dầu gội cho nam giới...',
                'thumbnail' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
            ],
            [
                'name' => 'Dầu xả TRESemmé Keratin Smooth',
                'category_id' => 5,
                'short_description' => 'Mượt tóc, chống rối hiệu quả',
                'description' => 'Giúp phục hồi tóc hư tổn nhờ công nghệ Keratin...',
                'thumbnail' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
            ],
            [
                'name' => 'Máy sấy tóc Dyson Supersonic',
                'category_id' => 6,
                'short_description' => 'Công nghệ sấy nhanh, bảo vệ tóc',
                'description' => 'Máy sấy cao cấp, không gây tổn hại tóc do nhiệt độ cao...',
                'thumbnail' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
            ],
            [
                'name' => 'Tông đơ Wahl Magic Clip',
                'category_id' => 7,
                'short_description' => 'Tông đơ chuyên nghiệp cho barber',
                'description' => 'Được tin dùng tại các salon lớn trên thế giới...',
                'thumbnail' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
            ],
            [
                'name' => 'Lược tạo kiểu Toni&Guy',
                'category_id' => 8,
                'short_description' => 'Lược chuyên dụng tạo kiểu tóc',
                'description' => 'Dễ dàng chia tóc và vuốt tạo kiểu cùng wax hoặc pomade...',
                'thumbnail' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
            ],
            [
                'name' => 'Dầu dưỡng râu Beard Oil Viking',
                'category_id' => 9,
                'short_description' => 'Giữ cho râu mềm và sạch',
                'description' => 'Dầu dưỡng giúp ngăn râu bị khô và gãy rụng...',
                'thumbnail' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
            ],
            [
                'name' => 'Tinh dầu dưỡng tóc Moroccanoil',
                'category_id' => 10,
                'short_description' => 'Tăng cường độ mềm và bóng tóc',
                'description' => 'Phục hồi tóc yếu và khô, tăng độ ẩm hiệu quả...',
                'thumbnail' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
            ],
            [
                'name' => 'Khăn phủ barber chuyên dụng',
                'category_id' => 11,
                'short_description' => 'Khăn phủ khi cắt tóc',
                'description' => 'Chống thấm nước, dễ vệ sinh, dùng trong tiệm barber...',
                'thumbnail' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
            ],
            [
                'name' => 'Áo choàng barber đen bóng',
                'category_id' => 12,
                'short_description' => 'Thiết kế cao cấp cho barber',
                'description' => 'Tạo phong cách chuyên nghiệp khi phục vụ khách...',
                'thumbnail' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
            ],
            [
                'name' => 'Ghế cắt tóc barber cổ điển',
                'category_id' => 13,
                'short_description' => 'Ghế cổ điển phong cách vintage',
                'description' => 'Chất lượng cao, xoay 360 độ, dễ điều chỉnh độ cao...',
                'thumbnail' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
            ],
            [
                'name' => 'Sáp vuốt tóc Volcanic Clay',
                'category_id' => 1,
                'short_description' => 'Chất sáp mềm, độ giữ nếp cao',
                'description' => 'Sáp dạng clay, không bóng, dễ restyle cả ngày...',
                'thumbnail' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
            ],
            [
                'name' => 'Pomade Suavecito Firme Hold',
                'category_id' => 2,
                'short_description' => 'Pomade gốc nước giữ nếp mạnh',
                'description' => 'Mùi hương dễ chịu, dễ rửa trôi, không bết tóc...',
                'thumbnail' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
            ],
            [
                'name' => 'Gôm xịt giữ nếp Tigi Bed Head',
                'category_id' => 3,
                'short_description' => 'Giữ nếp khô thoáng suốt ngày',
                'description' => 'Gôm xịt cao cấp dùng cho kiểu tóc hiện đại...',
                'thumbnail' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
            ],
            [
                'name' => 'Dầu gội khô Batiste Original',
                'category_id' => 4,
                'short_description' => 'Dành cho những ngày bận rộn',
                'description' => 'Hấp thụ dầu thừa trên tóc, làm sạch nhanh chóng...',
                'thumbnail' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
            ],
            [
                'name' => 'Kéo cắt tóc JAGUAR Germany',
                'category_id' => 5,
                'short_description' => 'Kéo sắc bén, chuyên dùng cắt tạo kiểu',
                'description' => 'Kéo cao cấp cho barber chính hiệu đến từ Đức...',
                'thumbnail' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
            ],
            [
                'name' => 'Bình xịt nước barber cao cấp',
                'category_id' => 11,
                'short_description' => 'Bình phun sương đều và mịn',
                'description' => 'Giúp làm ẩm tóc trước khi cắt hoặc tạo kiểu...',
                'thumbnail' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
            ],
            [
                'name' => 'Lược chải râu Beard Comb',
                'category_id' => 8,
                'short_description' => 'Lược nhỏ gọn, dễ mang theo',
                'description' => 'Giúp râu vào nếp và trông gọn gàng hơn...',
                'thumbnail' => '01JRZSJ8GYY1M1F80F1ER87NKZ.png',
            ],
        ];

        foreach ($products as $item) {
            Product::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'short_description' => $item['short_description'],
                'thumbnail' => $item['thumbnail'],
                'status' => 1,
                'category_id' => $item['category_id'],
            ]);
        }
    }
}
