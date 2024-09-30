<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Work;

class Pagecontroller extends Controller
{
    public function index()
    {
        $data = Work::all();
        return response()->json($data);
    }
}
