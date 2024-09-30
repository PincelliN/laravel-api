<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use App\Functions\Helper;
use Spatie\LaravelIgnition\Http\Controllers\HealthCheckController;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tecs=['Bootstrap','Vue','Sass','Vite','Laravel'];
        foreach($tecs as $tec){
            $new_tec=new Technology();
            $new_tec->name= $tec;
            $new_tec->slug=Helper::generateSlug($new_tec->name,Technology::class);
            $new_tec->save();
        }
    }
}