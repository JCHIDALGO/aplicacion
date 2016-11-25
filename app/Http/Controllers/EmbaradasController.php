<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Embarazada;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class EmbaradasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        $embarazadas = Embarazada::all();
//dd($embarazadas);
        return response()->json($embarazadas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
public function edad($from, $to){
    $usuariosEntre20Y30 = Embarazada::whereBetween(DB::raw('TIMESTAMPDIFF(YEAR,tembarazadas.fnacimiento,CURDATE())'), [$from, $to])->get();

    /*$users = DB::table('users')
                     ->select(DB::raw('count(*) as user_count, status'))
                     ->where('status', '<>', 1)
                     ->groupBy('status')
                     ->get(); */

//$hoy= new Carbon;

//$fechas_embarazadas = Embarazada::select('');

/*foreach ($fechas_embarazadas as $fecha) {
    
$date = Carbon::createFromFormat('Y-m-d',$fecha->fnacimiento)->age;

$edades[]=['expediente'=>$fecha->expediente,'edad'=>$date];
} 
*/

return response()->json(['ranog_edades'=>$usuariosEntre20Y30]);

}

public function riesgo(){
$bajoRiesgo= Embarazada::where('riesgo','>=',0)->where('riesgo','<',5)->get();
$medianoRiesgo= Embarazada::where('riesgo','>=',5)->where('riesgo','<',8)->get();
$altoRiesgo= Embarazada::where('riesgo','>=',8)->get();
$totalBajoRiesgo = $bajoRiesgo->count();
$totalMedianoRiesgo = $medianoRiesgo->count();
$totalAltoRiesgo = $altoRiesgo->count();
return response()->json(['Bajo Riesgo'=>$totalBajoRiesgo,'Mediano Riesgo'=>$totalMedianoRiesgo,'Alto Riesgo'=>$totalAltoRiesgo ]);

}
    public function detalle($id){



      $detalle_embarazada  = Embarazada::where('expediente',$id)->get();
      return response()->json($detalle_embarazada);

    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
          $clues = Embarazada::where('clues',$id)->get();
          return response()->json($clues);
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
