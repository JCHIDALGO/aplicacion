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

public function todos(){


    $municipios = Embarazada::select('locmun')->distinct()->get();
    return response()->json($municipios);
}

    public function municipio($municipio){


    $embarzadas_municipio = Embarazada::where('locmun',$municipio)->get();
    return response()->json($embarzadas_municipio);
    }

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
return response()->json(['rango_edades'=>$usuariosEntre20Y30]);

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
