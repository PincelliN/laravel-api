<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Work;
use App\Models\Technology;
use App\Models\Type;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPSTORM_META\type;

class PageController extends Controller
{
    public function allWorks()
    {
        $works = Work::orderBy('id')->with('type', 'technologies')->paginate(10);
        if ($works) {
            $success = true;
            foreach ($works as $work) {
                if ($work->path_img) {
                    $work->path_img = Storage::url($work->path_img);
                } else {
                    $work->path_img = Storage::url('default-image.jpg');
                    $work->original_name_img = 'No img';
                }
            }
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'works'));
    }


    public function allTypes()
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


    public function allTechnologies()
    {
        $technologies = Technology::all();
        if ($technologies) {
            $success = true;
        } else {
            $success = false;
        }
        $data = [
            'success' => $success,
            'result' => $technologies
        ];
        return response()->json($data);
    }


    public function detailWork($slug)
    {
        $work = Work::where('slug', $slug)->with('type', 'technologies')->first();

        if ($work) {
            $success = true;
            if ($work->path_img) {
                $work->path_img = Storage::url($work->path_img);
            } else {
                $work->path_img = Storage::url('default-image.jpg');
                $work->original_name_img = 'No img';
            }
        } else {
            $success = false;
        }

        return response()->json(compact('work', 'success'));
    }
    public function typeAllWorks($slug)
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

    public function technologyWorks($slug)
    {

        $TechnologyWorks = Technology::where('slug', $slug)->with('works')->get();
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
