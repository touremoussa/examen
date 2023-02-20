<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Referentiel;
use App\Http\Requests\ReferentielRequest;
use App\Models\Type;
use Illuminate\Auth\Events\Validated;

class ReferentielsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        $referentiels= Referentiel::all();
        return view('referentiels.index',
            ['referentiels'=>$referentiels,
             'types'=>$types
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
    
        $types = Type::all()->pluck('libelle', 'id');
        return view('referentiels.create')->with('types',$types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ReferentielRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReferentielRequest $request)
    {
        $referentiel = new Referentiel;
		$referentiel->libelle = $request->input('libelle');
		$referentiel->validated = $request->input('validated');
		$referentiel->horaire = $request->input('horaire');
        $referentiel->type_id = $request->input('type_id');
        $referentiel->save();

        

        return redirect()->route('referentiels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $referentiel = Referentiel::findOrFail($id);
        return view('referentiels.show',['referentiel'=>$referentiel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $types = Type::all()->pluck('libelle', 'id');
        $referentiel = Referentiel::findOrFail($id);
        return view('referentiels.edit',[
            'referentiel'=>$referentiel,
            'types'=>$types
    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ReferentielRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReferentielRequest $request, $id)
    {
        $referentiel = Referentiel::findOrFail($id);
		$referentiel->libelle = $request->input('libelle');
		$referentiel->validated = $request->input('validated');
		$referentiel->horaire = $request->input('horaire');
        $referentiel->save();

        return redirect()->route('referentiels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $referentiel = Referentiel::findOrFail($id);
        $referentiel->delete();

        return redirect()->route('referentiels.index');
    }
}
