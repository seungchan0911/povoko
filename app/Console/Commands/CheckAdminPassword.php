<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class CheckAdminPassword extends Command
{
    protected $signature = 'check:admin {--test-password=} {--raw}';
    protected $description = 'Check admin password in povoko project';

    public function handle()
    {
        $this->info('🔍 Povoko Admins 테이블 확인 중...');
        $this->newLine();
        
        // DB 직접 조회로 원본 데이터 확인
        $admins = DB::table('admins')->get();
        
        if ($admins->isEmpty()) {
            $this->warn('⚠️  Admins 테이블에 데이터가 없습니다.');
            $this->newLine();
            $this->info('Seeder를 실행하려면:');
            $this->line('php artisan db:seed --class=AdminSeeder');
            return 1;
        }
        
        $this->info("📊 전체 Admin 수: {$admins->count()}");
        $this->newLine();
        
        foreach ($admins as $admin) {
            $this->info("=== Admin ID: {$admin->id} ===");
            $this->line("Password 값: " . ($admin->password ?? 'NULL'));
            $this->line("Password 길이: " . (isset($admin->password) ? strlen($admin->password) : 0));
            $this->line("Password 타입: " . gettype($admin->password));
            
            if (isset($admin->password) && strlen($admin->password) > 0) {
                $this->line("Password 첫 20자: " . substr($admin->password, 0, 20));
                $this->line("bcrypt 형식인가? " . (str_starts_with($admin->password, '$2y$') ? 'YES' : 'NO'));
            }
            
            $this->line("Created At: " . ($admin->created_at ?? 'NULL'));
            $this->line("Updated At: " . ($admin->updated_at ?? 'NULL'));
            $this->newLine();
        }
        
        // 비밀번호 테스트
        $testPassword = $this->option('test-password');
        
        if ($testPassword) {
            $admin = $admins->first();
            
            if (!isset($admin->password) || empty($admin->password)) {
                $this->error('❌ 저장된 비밀번호가 없습니다!');
                return 1;
            }
            
            if (Hash::check($testPassword, $admin->password)) {
                $this->info('✅ 비밀번호가 일치합니다!');
            } else {
                $this->error('❌ 비밀번호가 일치하지 않습니다.');
                $this->comment("입력한 비밀번호: {$testPassword}");
            }
        } else {
            $this->comment('💡 비밀번호를 테스트하려면:');
            $this->line('php artisan check:admin --test-password="Alex0422!!"');
        }
        
        return 0;
    }
}
