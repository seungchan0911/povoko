<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixAdminData extends Command
{
    protected $signature = 'fix:admin';
    protected $description = 'Fix povoko admin data';

    public function handle()
    {
        $this->info('🔧 잘못된 admin 데이터 삭제 중...');
        DB::table('admins')->truncate();
        
        $this->info('✅ 올바른 admin 데이터 입력 중...');
        DB::table('admins')->insert([
            'password' => bcrypt('Alex0422!!'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        $this->info('✓ 완료!');
        
        $admin = DB::table('admins')->first();
        $this->line("ID: {$admin->id}");
        $this->line("Password: " . substr($admin->password, 0, 20) . "...");
        
        return 0;
    }
}
