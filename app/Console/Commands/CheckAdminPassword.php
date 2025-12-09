<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CheckAdminPassword extends Command
{
    protected $signature = 'check:admin-password {code?}';
    protected $description = 'Check admin password';

    public function handle()
    {
        $code = $this->argument('code');
        
        if ($code) {
            // 특정 code로 검색
            $admin = DB::table('admins')->where('code', $code)->first();
            
            if (!$admin) {
                $this->error("Code '{$code}'를 가진 관리자를 찾을 수 없습니다.");
                return 1;
            }
            
            $this->info("🔍 Admin 정보:");
            $this->table(
                ['Field', 'Value'],
                [
                    ['ID', $admin->id ?? 'N/A'],
                    ['Code', $admin->code],
                    ['Password Hash', $admin->password ?? 'N/A'],
                    ['Created At', $admin->created_at ?? 'N/A'],
                ]
            );
            
            // 비밀번호 테스트
            if (isset($admin->password)) {
                $testPassword = $this->ask('테스트할 비밀번호를 입력하세요 (선택사항)', '');
                
                if ($testPassword) {
                    if (Hash::check($testPassword, $admin->password)) {
                        $this->info('✓ 비밀번호가 일치합니다!');
                    } else {
                        $this->error('✗ 비밀번호가 일치하지 않습니다.');
                    }
                }
            }
            
        } else {
            // 전체 admins 조회
            $admins = DB::table('admins')->get();
            
            if ($admins->isEmpty()) {
                $this->warn('Admins 테이블에 데이터가 없습니다.');
                return 1;
            }
            
            $this->info("📊 전체 Admins ({$admins->count()}명):");
            $this->newLine();
            
            $this->table(
                ['ID', 'Code', 'Has Password', 'Created At'],
                $admins->map(fn($a) => [
                    $a->id ?? 'N/A',
                    $a->code,
                    isset($a->password) && $a->password ? '✓' : '✗',
                    $a->created_at ?? 'N/A',
                ])
            );
        }
        
        return 0;
    }
}