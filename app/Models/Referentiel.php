<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referentiel extends Model
{
    use HasFactory;

	public function type()
	{
		return $this->hasOne('App\Models\Type');
	}

	public function formations()
	{
        return $this->belongsToMany(Formation::class, 'formation_referentiel');
	}
}
