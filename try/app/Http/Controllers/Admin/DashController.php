<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashController extends Controller
{
    public function index(){
        dump('Ben trovato sulla home della Dashboard');
        return view('Admin.index');
    }
}