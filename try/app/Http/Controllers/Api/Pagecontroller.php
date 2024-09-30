<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Work;
use App\Models\Technology;
use App\Models\Type;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class PageController extends Controller
{
    public function AllWorks()
    {
        $works = Work::all();
        if ($works) {
            $success = true;
            foreach ($works as $work) {
                if ($work->path_img) {
                    $work->path_img = asset('storage/' . $work->path_img);
                } else {
                    $work->path_img = '/img/default-image.jpg';
                    $work->original_name_img = 'No img';
                }
            }
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'work'));
    }


    public function AllTypes()
    {
        $types = Type::all();
        if ($types) {
            $success = true;
        } else {
            $success = false;
        }
        $data = [
            'success' => $success,
            'result' => $types
        ];
        return response()->json($data);
    }


    public function AllTechnologies()
    {
        $technologies = Technology::all();
        if ($technologies) {
            $success = true;
        } else {
            $success = false;
        }
        return response()->json(compact('technologies', 'success'));
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
        $TypeWorks = Type::where('slug', $slug)->with('works.technologies')->get();
        if ($TypeWorks) {
            $success = true;
        } else {
            $success = false;
        }
        $data = [
            'success' => $success,
            'result' => $TypeWorks
        ];
        return response()->json($data);
    }

    public function TechnologyWorks($slug)
    {

        $TechnologyWorks = Technology::where('slug', $slug)->with('works.type')->get();
        if ($TechnologyWorks) {
            $success = true;
        } else {
            $success = false;
        }


        $data = [
            'success' => $success,
            'result' => $TechnologyWorks
        ];
        return response()->json($data);
    }
}
