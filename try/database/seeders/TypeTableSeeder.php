<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use App\Functions\Helper;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {  $types = ['HTML','CSS','Javascript','Bootstrap','Vue','Sass','Vite','Php','Laravel'];
        foreach($types as $tipe){
            $new_type=new Type();
            $new_type->name= $tipe;
            $new_type->slug=Helper::generateSlug($new_type->name,Type::class);
            $new_type->save();
        }


    }
}
