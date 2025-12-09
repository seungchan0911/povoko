<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;

class FixAdminsTableStructure extends Command
{
    protected $signature = 'fix:admins-table';
    protected $description = 'Fix povoko admins table - remove code column, add password column';

    public function handle()
    {
        $this->info('🔧 povoko admins 테이블 구조 수정 중...');
        $this->newLine();
        
        // 현재 컬럼 확인
        $columns = Schema::getColumnListing('admins');
        $this->line('현재 컬럼: ' . implode(', ', $columns));
        $this->newLine();
        
        // code 컬럼이 있으면 삭제하고 password 추가
        Schema::table('admins', function (Blueprint $table) use ($columns) {
            if (in_array('code', $columns)) {
                $table->dropColumn('code');
                $this->info('✓ code 컬럼 삭제');
            }
            
            if (!in_array('password', $columns)) {
                $table->string('password')->after('id');
                $this->info('✓ password 컬럼 추가');
            }
        });
        
        $this->newLine();
        $this->info('✅ 테이블 구조 수정 완료!');
        
        // 최종 확인
        $finalColumns = Schema::getColumnListing('admins');
        $this->line('최종 컬럼: ' . implode(', ', $finalColumns));
        
        return 0;
    }
}
