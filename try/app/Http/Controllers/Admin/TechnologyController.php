<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\TechnologyRequest;
use Illuminate\Http\Request;
use App\Models\Technology;
use Faker\Extension\Helper as ExtensionHelper;
use GuzzleHttp\Psr7\Header;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $techs = Technology::all();
        return view('admin.technology.index', compact('techs'));
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
    public function store(TechnologyRequest $request)
    {

        $data= $request->all();
        $new_technology= new Technology();
        $data['slug']= Helper::generateSlug($data['name'],Technology::class);
        $new_technology->fill($data);
        $new_technology->save();
        return redirect()->route('admin.technology.index')->with('create', 'Hai aggiunto una nuova tecnologia');
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
    public function update(TechnologyRequest $request, Technology $technology)
    {
        $data=$request->all();
        if($technology['name'] != $data['name']){
            $data['slug']=Helper::generateSlug($data['name'],Technology::class);
        }
        $technology->update($data);
        return redirect()->route('admin.technology.index')->with('update',"Hai modificato con successo {$technology['name']}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technology.index')->with('delete','Hai cancellato correttamente l\' elemento');
    }
}