<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Text;

class TextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Text::create([
            'text1' => "We make visuals for your brand.\n----- fr(seoul) (london) (paris) (tokyo) -----",
            'text2' => "is a global creative production based in Seoul\nand Europe, providing integrated visual solutions for brands.",
        ]);
    }
}