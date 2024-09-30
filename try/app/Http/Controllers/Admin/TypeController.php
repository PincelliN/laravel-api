<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Functions\Helper;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types=Type::all();
        return view('admin.type.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $data['slug'] = Helper::generateSlug($data['name'],Type::class);
        $type=Type::create($data);
        return redirect()->route('admin.type.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
         $data=$request->all();
        $data['slug'] = Helper::generateSlug($data['name'],Type::class);
        $type->update($data);
        return redirect()->route('admin.type.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {

        $type->delete();

        return redirect()->route('admin.type.index')->with('delete','il linguaggio è stato cancellato');
    }
}