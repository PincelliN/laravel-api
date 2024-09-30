<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Work;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;


class PageController extends Controller
{
    public function AllWorks()
    {
        $data = Work::all();
        return response()->json($data);
    }
    public function AllTypes()
    {
        $data = Type::all();
        return response()->json($data);
    }
    public function AllTechnologies()
    {
        $data = Technology::all();
        return response()->json($data);
    }
}
