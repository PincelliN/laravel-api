<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Work;
use App\Models\Technology;

class technology_workTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 100; $i++) {
            $work= Work::inRandomOrder()->first();
            $tech_id=Technology::inRandomOrder()->first()->id;
            $work->technologies()->attach($tech_id);
        }
    }
}