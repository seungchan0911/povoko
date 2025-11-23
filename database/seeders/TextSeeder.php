<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Text;

class TextSeeder extends Seeder
{
    public function run(): void
    {
        Text::create([
            'text1' => 'Welcome to Povoko Studio',
            'text2' => 'We create amazing content',
            'background_video_1' => null,
            'background_video_2' => null,
            'background_video_3' => null,
            'background_video_4' => null,
        ]);
    }
}
