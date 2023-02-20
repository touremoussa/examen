<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateCandidatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidats', function (Blueprint $table) {
            $table->id();
			$table->string('nom');
			$table->string('prenom');
			$table->integer('age');
			$table->string('email');
			$table->enum('niveauEtude',['Bac','Licence','Master']);
			$table->enum('sexe',array('Feminin','Masculin'));
            //$table->foreignId('formation_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidats');
    }
}
