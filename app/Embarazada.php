<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Embarazada extends Model
{
    //

protected $table="tembarazadas";
	protected $fillable=['expediente','clues','aparteno','amaterno','nombres','domicilio','fnacimiento','talla','peso','tsangre','lengua','ecivil','escolaridad','ocupacion','derechohabiencia','edadpareja','antpat','fum','fpp','ngestas','partnaturales','partcesareas','abortos','fue','tue','controlpre','quienup','riesgo','facriesgo','fplan','totcons','diaguc','semgestuc','triuc','vacunas','facidof','fpf','controlp','signosa','sintomasa','incompatibilidadrh','tira','ego','proteinuria','urocultivo','vdrl','vih','usg','fotronivel','refalarma','fparto','quienatendio','dondeparto'];


public function scopeAgedBetween($query, $start, $end = null)
{
    if (is_null($end)) {
        $end = $start;
    }

    $now = $this->freshTimestamp();
    $start = $now->subYears($start);
    $end = $now->subYears($end)->addYear()->subDay(); // plus 1 year minus a day

    return $query->whereBetween('fnacimiento', [$start, $end]);
}

}
