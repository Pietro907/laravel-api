<?php

namespace Database\Seeders;

use App\Models\Tecnology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TecnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = ['Vue', 'Laravel', 'php', 'javascript', 'html', 'css', 'bootstrap', 'mysql', 'sass'];
        foreach ($technologies as $technology) {
            $new_tech = new Tecnology(); 
            $new_tech->technologies = $technology;
            $new_tech->save();
        }
    }
}
