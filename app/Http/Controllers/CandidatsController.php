<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Candidat;
use App\Http\Requests\CandidatRequest;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CandidatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidats= Candidat::all();
        return view('candidats.index', ['candidats'=>$candidats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genre = ['Masculin', 'Feminin'];
        $niveau = ['Bac', 'Licence', 'Master'];
        return view('candidats.create', ['genre'=>$genre], ['niveau'=>$niveau]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CandidatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CandidatRequest $request)
    {
        $rules = [    'age' => [ 'integer', 'min:16', 'max:35'],
                    'email' => [ 'required','email']
                ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

        $genre = ['Masculin', 'Feminin'];
        $sexe = $genre[$request->sexe];

        $niveau = ['Bac', 'Licence', 'Master'];
        $niv = $niveau[$request->sexe];

        $candidat = new Candidat;
		$candidat->nom = $request->input('nom');
		$candidat->prenom = $request->input('prenom');
		$candidat->age = $request->input('age');
		$candidat->email = $request->input('email');
		$candidat->niveauEtude = $niv;
		$candidat->sexe = $sexe;
        //dd($candidat);
        $candidat->save();

        return redirect()->route('candidats.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $candidat = Candidat::findOrFail($id);

        $formations = $candidat->formations;

        $formatione = Formation::all();

        return view('candidats.show', compact('candidat', 'formations','formatione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $candidat = Candidat::findOrFail($id);
        $genre = ['Masculin','Feminin'];
        $niveau = ['Bac', 'Licence', 'Master'];
        return view('candidats.edit',['candidat'=>$candidat], ['genre'=>$genre], ['niveau'=>$niveau]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CandidatRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CandidatRequest $request, $id)
    {
        $rules = [    'age' => [ 'integer', 'min:16', 'max:35'],];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

        $genre = ['Masculin', 'Feminin'];
        $sexe = $genre[$request->sexe];

        $niveau = ['Bac', 'Licence', 'Master'];
        $niv = $niveau[$request->sexe];


        $candidat = Candidat::findOrFail($id);
		$candidat->nom = $request->input('nom');
		$candidat->prenom = $request->input('prenom');
		$candidat->age = $request->input('age');
		$candidat->email = $request->input('email');
		$candidat->niveauEtude = $niv;
		$candidat->sexe = $sexe;
        $candidat->save();

        return redirect()->route('candidats.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $candidat = Candidat::findOrFail($id);
        $candidat->delete();

        return redirect()->route('candidats.index');
    }


    public function storeFormation(Request $request, $id)
    {
        $candidat = Candidat::findOrFail($id);
        $formation = Formation::findOrFail($request->formation_id);
        $candidat->formations()->syncWithoutDetaching($formation);
        //dd($formation);
        //dd($referentiel);
        return redirect()->route('candidats.show', $id);
    }
}
