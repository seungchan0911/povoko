<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class CheckAdminPassword extends Command
{
    protected $signature = 'check:admin {--test-password=}';
    protected $description = 'Check admin password in povoko project';

    public function handle()
    {
        $this->info('🔍 Povoko Admins 테이블 확인 중...');
        $this->newLine();
        
        // Admin 모델 사용
        $admins = Admin::all();
        
        if ($admins->isEmpty()) {
            $this->warn('⚠️  Admins 테이블에 데이터가 없습니다.');
            $this->newLine();
            $this->info('Seeder를 실행하려면:');
            $this->line('php artisan db:seed --class=AdminSeeder');
            return 1;
        }
        
        $this->info("📊 전체 Admin 수: {$admins->count()}");
        $this->newLine();
        
        // 테이블 형식으로 출력
        $this->table(
            ['ID', 'Password Hash (처음 20자)', 'Created At', 'Updated At'],
            $admins->map(fn($admin) => [
                $admin->id,
                substr($admin->password, 0, 20) . '...',
                $admin->created_at?->format('Y-m-d H:i:s') ?? 'N/A',
                $admin->updated_at?->format('Y-m-d H:i:s') ?? 'N/A',
            ])
        );
        
        $this->newLine();
        
        // 비밀번호 테스트 옵션
        $testPassword = $this->option('test-password');
        
        if ($testPassword) {
            $admin = $admins->first();
            
            if (Hash::check($testPassword, $admin->password)) {
                $this->info('✅ 비밀번호가 일치합니다!');
            } else {
                $this->error('❌ 비밀번호가 일치하지 않습니다.');
            }
        } else {
            $this->comment('💡 비밀번호를 테스트하려면:');
            $this->line('php artisan check:admin --test-password="your-password"');
        }
        
        return 0;
    }
}
