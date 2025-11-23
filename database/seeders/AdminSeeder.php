<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // 기존 admin이 없을 때만 생성
        if (Admin::count() === 0) {
            Admin::create([
                'password' => 'Alex0422!!', // casts에서 자동 해시됨
            ]);
        }
    }
}
