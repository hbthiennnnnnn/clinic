<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo các vai trò
        Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'admin']);
        Role::firstOrCreate(['name' => 'Bác sĩ', 'guard_name' => 'admin']);
        Role::firstOrCreate(['name' => 'Người dùng', 'guard_name' => 'web']);

        // Gọi Seeder dữ liệu giả
        $this->call(FakeDataSeeder::class);
    }
}
