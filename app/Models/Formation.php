<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

	public function referentiels()
	{
        return $this->belongsToMany(Referentiel::class, 'formation_referentiel');
	}

	public function candidats()
	{
		return $this->belongsToMany(Candidat::class,'candidat_referentiel');
	}
}
