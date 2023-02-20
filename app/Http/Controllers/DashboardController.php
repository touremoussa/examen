<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function candidaturesParFormation()
    {
        $candidatures = DB::table('candidat_formation')
                    ->join('candidats', 'candidat_formation.candidat_id', '=', 'candidats.id')
                    ->join('formations', 'candidat_formation.formation_id', '=', 'formations.id')
                    ->select('formations.nom', DB::raw('count(*) as total'))
                    ->groupBy('formations.nom')
                    ->get();

        return view('dashboard.candidatures-par-formation', compact('candidatures'));
    }


    public function formationsParReferentiel()
    {
        $formations = DB::table('formation_referentiel')
                        ->join('formations', 'formation_referentiel.formation_id', '=', 'formations.id')
                        ->join('referentiels', 'formation_referentiel.referentiel_id', '=', 'referentiels.id')
                        ->select('referentiels.libelle', DB::raw('count(*) as total'))
                        ->groupBy('referentiels.libelle')
                        ->get();
        return view('dashboard.formations-par-referentiel', compact('formations'));
    }

    public function candidaturesParSexe()
    {
        $candidatures = DB::table('candidats')
                        ->join('candidat_formation', 'candidats.id', '=', 'candidat_formation.candidat_id')
                        ->join('formations', 'candidat_formation.formation_id', '=', 'formations.id')
                        ->select('candidats.sexe', DB::raw('count(*) as total'))
                        ->groupBy('candidats.sexe')
                        ->get();
        return view('dashboard.candidatures-par-sexe', compact('candidatures'));
    }


    public function formationsParType()
    {
        $formations = DB::table('formations')
                    ->join('formation_referentiel', 'formations.id', '=', 'formation_referentiel.formation_id')
                    ->join('referentiels', 'formation_referentiel.referentiel_id', '=', 'referentiels.id')
                    ->join('types', 'referentiels.type_id', '=', 'types.id')
                    ->select('types.libelle', DB::raw('count(*) as total'))
                    ->groupBy('types.libelle')
                    ->get();
        return view('dashboard.formations-par-type', compact('formations'));
    }


    public function trancheAge() 
    {
        $tranchesAge = DB::table('candidats')
            ->select(DB::raw('CASE
                    WHEN age >= 16 AND age < 20 THEN "16-19"
                    WHEN age >= 20 AND age < 25 THEN "20-24"
                    WHEN age >= 25 AND age < 30 THEN "25-29"
                    WHEN age >= 30 AND age < 35 THEN "30-34"
                    ELSE "35+"
                END AS tranche_age'), 
                DB::raw('COUNT(*) as total'))
            ->groupBy('tranche_age')
            ->get();
    
        return view('dashboard.tranches-age',compact('tranchesAge'));
    }
    
    public function formationsParStatut()
    {
        $formations = DB::table('formations')
            ->select(DB::raw('isStarted, count(*) as total'))
            ->groupBy('isStarted')
            ->get();

            return view('dashboard.formations-par-statut', compact('formations'));
        }


}
