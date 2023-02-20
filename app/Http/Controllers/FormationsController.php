<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Formation;
use App\Models\Referentiel;
use App\Http\Requests\FormationRequest;
use Illuminate\Http\Request;

class FormationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formations= Formation::all();
        return view('formations.index', ['formations'=>$formations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('formations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FormationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormationRequest $request)
    {
        $formation = new Formation;
		$formation->nom = $request->input('nom');
		$formation->duree = $request->input('duree');
		$formation->description = $request->input('description');
		$formation->isStarted = $request->input('isStarted');
		$formation->dateDebut = $request->input('dateDebut');
        $formation->save();

        return redirect()->route('formations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $formation = Formation::findOrFail($id);

        $referentiels = $formation->referentiels;

        $referentiele = Referentiel::all();
        
        return view('formations.show', compact('formation', 'referentiels','referentiele'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $formation = Formation::findOrFail($id);
        return view('formations.edit',['formation'=>$formation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FormationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormationRequest $request, $id)
    {
        $formation = Formation::findOrFail($id);
		$formation->nom = $request->input('nom');
		$formation->duree = $request->input('duree');
		$formation->description = $request->input('description');
		$formation->isStarted = $request->input('isStarted');
		$formation->dateDebut = $request->input('dateDebut');
        $formation->save();

        return redirect()->route('formations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $formation = Formation::findOrFail($id);
        $formation->delete();

        return redirect()->route('formations.index');
    }

    public function addReferentiel($id)
    {
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  FormationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeReferentiel(Request $request, $id)
    {
        $formation = Formation::findOrFail($id);
        $referentiel = Referentiel::findOrFail($request->referentiel_id);
        $formation->referentiels()->syncWithoutDetaching($referentiel);
        //dd($formation);
        //dd($referentiel);
        return redirect()->route('formations.show', $id);
    }
}
