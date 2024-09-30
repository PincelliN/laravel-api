<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Functions\Helper;
use App\Http\Requests\WorkRequest;
use App\Models\Work;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        /*
         dump($request->get('ordinatore'), $request->get('verso'));
          */

        /* Recupera i parametri con valori di default*/
        $ordinatore = $request->get('ordinatore', 'id');

        $verso = $request->get('verso');


        if ($ordinatore == session('OldOrdinatore')) {
            $verso = $verso == 'asc' ? 'desc' : 'asc';
        } else {
            $verso = 'asc';
        }

        $works = Work::orderBy($ordinatore, $verso)->get();

        session(['OldOrdinatore' => $ordinatore]);


        // Passa i dati alla vista
        return view('admin.work.index', compact('works', 'ordinatore', 'verso'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tecs = Technology::all();
        $types = Type::all();
        return view('admin.work.create', compact('types', 'tecs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkRequest $request)
    {
        $data = $request->all();
        /*   dd($data); */
        $data['slug'] = Helper::generateSlug($data['title'], Work::class);
        $new_work = new Work();
        if (array_key_exists('path_img', $data)) {
            //salvo l'immagine nello storege nella cartella uploads se la cartella non esiste la crea
            $path_img = Storage::put('uplods', $data['path_img']);
            /*
            Ottieni il nome originale del file caricato dall'input 'path_img'
            getClientOriginalName() recupera il nome del file così come era sul computer dell'utente prima del caricamento
             */
            $original_name = $request->file('path_img')->getClientOriginalName();

            $data['path_img'] = $path_img;
            $data['original_name_img'] = $original_name;
        }

        $new_work->fill($data);
        $new_work->save();
        // Se esistono tecnologie associate al progetto, collegale al nuovo progetto
        if (array_key_exists('technologies', $data)) {
            // Aggiunge le tecnologie selezionate tramite la relazione many-to-many
            $new_work->technologies()->attach($data['technologies']);
        }
        return redirect()->route('admin.work.show', $new_work->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Work $work)
    {
        $work = Work::find($work->id);

        return view('admin.work.show', compact('work'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Work $work)
    {
        /*   $work=Work::find($work); */
        $tecs = Technology::all();
        $types = Type::all();
        return view('admin.work.edit', compact('work', 'types', 'tecs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WorkRequest $request, Work $work)
    {
        $data = $request->all();

        if ($data['title'] != $work['title']) {
            $data['slug'] = Helper::generateSlug($data['title'], Work::class);
        }
        if (array_key_exists('path_img', $data)) {
            /* se carico un altra immagine al posto di quella vecchia devo cancellare la vecchia dallo storage */
            if ($work->path_img) {
                Storage::delete($work->path_img);
            }
            //salvo l'immagine nello storege nella cartella uploads se la cartella non esiste la crea
            $path_img = Storage::put('uplods', $data['path_img']);
            /*
            Ottieni il nome originale del file caricato dall'input 'path_img'
            getClientOriginalName() recupera il nome del file così come era sul computer dell'utente prima del caricamento
             */
            $original_name = $request->file('path_img')->getClientOriginalName();

            $data['path_img'] = $path_img;
            $data['original_name_img'] = $original_name;
        }
        $work->update($data);
        // Se ci sono tecnologie selezionate, aggiorna i collegamenti tra il progetto e le tecnologie
        if (array_key_exists('technologies', $data)) {
            // Sincronizza le tecnologie selezionate con il progetto (aggiunge o rimuove collegamenti)
            $work->technologies()->sync($data['technologies']);
        } else {
            // Se nessuna tecnologia è stata selezionata, rimuove tutte le tecnologie associate
            $work->technologies()->detach();
        }
        return redirect()->route('admin.work.show', $work)->with('update', 'Il Progetto è stato aggiornato');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $work)
    {
        if ($work->path_img) {
            Storage::delete($work->path_img);
        }
        $work->delete();
        return redirect()->route('admin.work.index')->with('delete', 'il Progetto' . $work['title'] . ' è stato cancellato');
    }
}
