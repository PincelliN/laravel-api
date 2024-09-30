<?php

namespace Database\Seeders;

use App\Models\Work;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Functions\Helper;
use App\Models\Type;

class worktableseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for($i=0;$i<100;$i++){
            $new_progetto = new Work();
            $new_progetto->type_id = Type::inRandomOrder()->first()->id;
            $new_progetto->title = $faker->unique()->word(1,true);
            $new_progetto->slug = Helper::generateSlug($new_progetto->title,Work::class);
            $new_progetto->subject = $faker->word(1,true);
            $new_progetto->start_date = $faker->dateTimeBetween('-3 week', '+1 day');
            if($i % 5 != 0 ){
                                $new_progetto->end_date = $faker->dateTimeBetween('+1 day', '+3 week');
                            }
            $new_progetto->post = $faker->randomDigit();
            if($i % 10 != 0 ){
                                $new_progetto->collaborators = $faker->randomDigitNot(0);
                                 $new_progetto->description = $faker->text(100);
                            }
            $new_progetto->save();

    }
}
}