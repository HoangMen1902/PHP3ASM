<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Nguyễn Văn A', 'email' => 'nguyenvana@example.com', 'phone' => '0917000001', 'role' => 1],
            ['name' => 'Trần Thị B', 'email' => 'tranthib@example.com', 'phone' => '0917000002', 'role' => 1],
            ['name' => 'Lê Minh C', 'email' => 'leminhc@example.com', 'phone' => '0917000003', 'role' => 1],
            ['name' => 'Phạm Quang D', 'email' => 'phamquangd@example.com', 'phone' => '0917000004', 'role' => 1],
            ['name' => 'Hoàng Thị E', 'email' => 'hoangthie@example.com', 'phone' => '0917000005', 'role' => 1],
            ['name' => 'Vũ Đình F', 'email' => 'vudinhf@example.com', 'phone' => '0917000006', 'role' => 1],
            ['name' => 'Đặng Thị G', 'email' => 'dangthig@example.com', 'phone' => '0917000007', 'role' => 1],
            ['name' => 'Ngô Thanh H', 'email' => 'ngothanhh@example.com', 'phone' => '0917000008', 'role' => 1],
            ['name' => 'Bùi Mai I', 'email' => 'buimaii@example.com', 'phone' => '0917000009', 'role' => 1],
            ['name' => 'Lý Quốc K', 'email' => 'lyquock@example.com', 'phone' => '0917000010', 'role' => 1],
            ['name' => 'Tạ Hoàng L', 'email' => 'tahoangl@example.com', 'phone' => '0917000011', 'role' => 1],
            ['name' => 'Cao Kim M', 'email' => 'caokimm@example.com', 'phone' => '0917000012', 'role' => 1],
            ['name' => 'Dương Minh N', 'email' => 'duongminhn@example.com', 'phone' => '0917000013', 'role' => 1],
            ['name' => 'Trương Quốc O', 'email' => 'truongquoco@example.com', 'phone' => '0917000014', 'role' => 1],
            ['name' => 'Lâm Bảo P', 'email' => 'lambaop@example.com', 'phone' => '0917000015', 'role' => 1],
            ['name' => 'Nguyễn Thị Q', 'email' => 'nguyenq@example.com', 'phone' => '0917000016', 'role' => 1],
            ['name' => 'Lê Quang R', 'email' => 'lequangr@example.com', 'phone' => '0917000017', 'role' => 1],
            ['name' => 'Vũ Quốc S', 'email' => 'vuquocs@example.com', 'phone' => '0917000018', 'role' => 1],
            ['name' => 'Trần Mai T', 'email' => 'tranmait@example.com', 'phone' => '0917000019', 'role' => 1],
            ['name' => 'Hoàng Thanh U', 'email' => 'hoangthanu@example.com', 'phone' => '0917000020', 'role' => 1]
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('123456'), // mặc định đại đại đi
                'phone' => $user['phone'],
                'status' => 1,
                'role' => $user['role'], 
                'remember_token' => null, 
            ]);
        }
    }
}
