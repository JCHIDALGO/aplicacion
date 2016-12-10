<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Embarazada;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\tussModel;
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

    public function censadas_unidad(){

    $distintas_clues=Embarazada::select('clues')->distinct()->get();

    foreach ($distintas_clues as $buscar) {
     //$collection = collect(["", 2, 3]);

     $nombre_clues = tussModel::select('nombreu')->where('clues',$buscar->clues)->first();
     //$nombre_clues1=$nombre_clues->nombreu;
     $contadores = Embarazada::where('clues',$buscar->clues)->count();

     $activas = Embarazada::where('clues',$buscar->clues)->where('estatus','Activa')->count();
     $bajas = Embarazada::where('clues',$buscar->clues)->where('estatus','Baja')->count();
     $Renuentes = Embarazada::where('clues',$buscar->clues)->where('estatus','Renuente')->count();
     $Foranea= Embarazada::where('clues',$buscar->clues)->where('estatus','Foranea')->count();

     $bajoRiesgo=Embarazada::where('clues',$buscar->clues)->whereBetween('riesgo',[1,4])->count();
     $medioRiesgo=Embarazada::where('clues',$buscar->clues)->whereBetween('riesgo',[5,8])->count();
     $altoRiesgo=Embarazada::where('clues',$buscar->clues)->where('riesgo','>',8)->count();
    

     $menores15 = Embarazada::where('clues',$buscar->clues)->where(DB::raw('TIMESTAMPDIFF(YEAR,tembarazadas.fnacimiento,CURDATE())'),'<',15)->count();  

     $mayores35 = Embarazada::where('clues',$buscar->clues)->where(DB::raw('TIMESTAMPDIFF(YEAR,tembarazadas.fnacimiento,CURDATE())'),'>',35)->count();
 

     $datos[] = collect(['nombre'=>$buscar->clues,'total'=>$contadores,'NombreClues'=>$nombre_clues,'Activas'=>$activas,'Baja'=>$bajas,'Renuentes'=>$Renuentes,'Foranea'=>$Foranea,'bajoRiesgo'=>$bajoRiesgo,'medioRiesgo'=>$medioRiesgo,'altoRiesgo'=>$altoRiesgo,'menores15'=>$menores15,'mayores35'=>$mayores35]);

   
    }

    
   return response()->json($datos);

    }



public function concentradosGenerales(){


    $censadas = Embarazada::all()->count();
    $activas = Embarazada::where('estatus','Activa')->count();
    $bajas = Embarazada::where('estatus','Baja')->count();
    $Renuentes = Embarazada::where('estatus','Renuente')->count();
    $Foranea= Embarazada::where('estatus','Foranea')->count();
    $sinRiesgo=Embarazada::where('riesgo','=',0)->count();
    $bajoRiesgo=Embarazada::whereBetween('riesgo',[1,4])->count();
    $medioRiesgo=Embarazada::whereBetween('riesgo',[5,8])->count();
    $altoRiesgo=Embarazada::where('riesgo','>',8)->count();

    $menores15 = Embarazada::where(DB::raw('TIMESTAMPDIFF(YEAR,tembarazadas.fnacimiento,CURDATE())'),'<',15)->count();  

     $mayores35 = Embarazada::where(DB::raw('TIMESTAMPDIFF(YEAR,tembarazadas.fnacimiento,CURDATE())'),'>',35)->count();


     $daticos[] = collect(['censadas'=>$censadas,'Activas'=>$activas,'Baja'=>$bajas,'Renuentes'=>$Renuentes,'Foranea'=>$Foranea,'bajoRiesgo'=>$bajoRiesgo,'medioRiesgo'=>$medioRiesgo,'altoRiesgo'=>$altoRiesgo,'menores15'=>$menores15,'mayores35'=>$mayores35]);


    return response()->json($daticos);


    }
}
