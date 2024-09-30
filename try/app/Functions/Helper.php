<?php

namespace App\Functions;
use Illuminate\Support\Str;

class Helper{


    public static function generateSlug($string,$model){

        $slug=Str::slug($string,'-');
        $original=$slug;

        $exists=$model::where ('slug',$slug)->first();

        $end=1;

        while($exists){
             $slug = $original . '-' . $end;
             $exists = $model::where ('slug',$slug)->first();
             $end++;
        }
        return $slug;
    }
}