<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('texts', function (Blueprint $table) {
            $table->string('background_video_1')->nullable()->after('text2');
            $table->string('background_video_2')->nullable()->after('background_video_1');
            $table->string('background_video_3')->nullable()->after('background_video_2');
            $table->string('background_video_4')->nullable()->after('background_video_3');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('texts', function (Blueprint $table) {
            $table->dropColumn(['background_video_1', 'background_video_2', 'background_video_3', 'background_video_4']);
        });
    }
};
