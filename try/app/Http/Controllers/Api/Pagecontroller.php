<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Work;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class PageController extends Controller
{
    public function AllWorks()
    {
        $works = Work::all();
        foreach ($works as $work) {
            if ($work->path_img) {
                $work->path_img = asset('storage/' . $work->path_img);
            } else {
                $work->path_img = '/img/default-image.jpg';
                $work->original_name_img = 'No img';
            }
        }
        return response()->json($works);
    }


    public function AllTypes()
    {
        $types = Type::all();
        return response()->json($types);
    }


    public function AllTechnologies()
    {
        $technologies = Technology::all();
        return response()->json($technologies);
    }


    public function DetailWork($slug)
    {
        $work = Work::where('slug', $slug)->with('type', 'technologies')->first();

        if ($work) {
            $success = true;
            if ($work->path_img) {
                $work->path_img = asset('storage/' . $work->path_img);
            } else {
                $work->path_img = '/img/default-image.jpg';
                $work->original_name_img = 'No img';
            }
        } else {
            $success = false;
        }

        return response()->json(compact('work', 'success'));
    }
    public function TypeAllWorks($slug)
    {
        $TypeWorks = Type::where('slug', $slug)->with('works')->get();
        return response()->json($TypeWorks);
    }

    public function TechnologyWorks($slug)
    {
        $TechnologyWorks = Technology::where('slug', $slug)->with('works')->get();
        return response()->json($TechnologyWorks);
    }
}
