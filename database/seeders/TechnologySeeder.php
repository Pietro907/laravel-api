<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = ['Vue', 'Laravel', 'php', 'javascript', 'html', 'css', 'bootstrap', 'mysql', 'sass'];
        foreach ($technologies as $technology) {
            $new_tech = new Technology(); 
            $new_tech->name = $technology;
            $new_tech->save();
        }
    }
}
