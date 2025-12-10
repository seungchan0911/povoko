<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CheckTableStructure extends Command
{
    protected $signature = 'check:table {table=admins}';
    protected $description = 'Check table structure';

    public function handle()
    {
        $table = $this->argument('table');
        
        $this->info("📋 {$table} 테이블 구조:");
        $this->newLine();
        
        $columns = Schema::getColumnListing($table);
        
        foreach ($columns as $column) {
            $this->line("  - {$column}");
        }
        
        $this->newLine();
        $this->info("총 {count($columns)}개 컬럼");
        
        return 0;
    }
}
