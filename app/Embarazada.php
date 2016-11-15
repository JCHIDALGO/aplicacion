<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Embarazada extends Model
{
    //

protected $table="tembarazadas";
	protected $fillable=['expediente','clues','aparteno','amaterno','nombres','domicilio','fnacimiento','talla','peso','tsangre','lengua','ecivil','escolaridad','ocupacion','derechohabiencia','edadpareja','antpat','fum','fpp','ngestas','partnaturales','partcesareas','abortos','fue','tue','controlpre','quienup','riesgo'];


}
