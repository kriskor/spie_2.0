<?php

namespace App\Http\Controllers\ModuloAdmindatabase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ModuloAdmindatabase\Region;
use App\ModuloAdmindatabase\RegionSinonimo;

class RegionesController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $regiones = \DB::connection('dbestadistica')
    ->select("select *
              from be_vista_regiones_dpm
              order by departamento,provincia,municipio ASC");


    return view('ModuloAdmindatabase.regiones',['regiones' => $regiones]);
  }



  public function store(Request $request)
  {
    try{
      $region = new Region();
      $region->nombre_comun = $request->nombre_comun;
      $region->categoria = $request->categoria;
      $region->codigo_alfa_2 = $request->codigo_alfa_2;
      $region->codigo_alfa_3 = $request->codigo_alfa_3;
      $region->codigo_numerico = $request->codigo_numerico;
      $region->orden = 0;
      $region->latitud = (!empty($request->latitud))?$request->latitud:null;
      $region->longitud = (!empty($request->longitud))?$request->longitud:null;
      $region->id_padre = $request->id_padre;
      $region->activo = true;
      $region->save();
      return \Response::json(1);
    }catch(Exception $e){
        dd( $e->getMessage() ) ; // insert query
    }

}
    public function modificarRegion(Request $request)
    {
      try{
        $region = Region::find($request->mod_id_region);
        $region->nombre_comun = $request->mod_nombre_comun;
        $region->categoria = $request->mod_categoria;
        $region->codigo_alfa_2 = $request->mod_codigo_alfa_2;
        $region->codigo_alfa_3 = $request->mod_codigo_alfa_3;
        $region->codigo_numerico = $request->mod_codigo_numerico;
        $region->orden = 0;
        $region->latitud = (!empty($request->mod_latitud))?$request->mod_latitud:null;
        $region->longitud = (!empty($request->mod_longitud))?$request->mod_longitud:null;
        $region->id_padre = $request->mod_id_padre;
        $region->activo = true;
        $region->save();
        return \Response::json(1);
      }catch(Exception $e){
          dd( $e->getMessage() ) ; // insert query
      }

    }

    public function eliminarRegion(Request $request)
    {
      try{
        $region = Region::find($request->region);
        $region->activo = false;
        $region->save();
        return \Response::json(1);
      }catch(Exception $e){
          dd( $e->getMessage() ) ; // insert query
      }

    }













  public function detalleRegion(Request $request)
  {

   if($request->ajax()) {
       $dRegion = Region::find($request->region);
       return \Response::json($dRegion);

    }
  }



  public function listaClasificadorRegiones()
  {
    $regiones = Region::where('activo', true)
              ->join('be_vista_lista_padre_dpm', 'regiones.id_padre', '=', 'be_vista_lista_padre_dpm.value')
              ->whereIn('categoria',array("NIVEL_0","NIVEL_1"))
              ->select('regiones.*', 'be_vista_lista_padre_dpm.label')
              ->orderBy('id','DESC')
              ->get();
    return json_encode($regiones);
  }




  ////sinonimos REGIONES
  public function listaSinonimosRegion(Request $request)
  {

    if($request->ajax()) {
        $sinonimosRegion = RegionSinonimo::where('id_region','=' ,$request->get('id'))->orderBy('id','DESC')->get();
        return \Response::json($sinonimosRegion);
    }


  }



  public function addSinonimoRegion(Request $request)
  {

     if($request->ajax()) {
          $sinonimo = new RegionSinonimo;
          $sinonimo->sinonimo ="Registrar sinonimo";
          $sinonimo->id_region = $request->id_region;
          $sinonimo->save();
          return \Response::json($sinonimo->id);
      }
  }

  public function updateSinonimoRegion(Request $request)
  {

   if($request->ajax()) {
        $sinonimo = RegionSinonimo::find($request->id);
        $sinonimo->sinonimo = strtoupper($request->sinonimo);
        $sinonimo->id_region = $request->id_region;
        $sinonimo->save();
        return \Response::json(1);

    }
  }

  public function deleteSinonimoRegion(Request $request)
  {
   if($request->ajax()) {
        $sinonimo = RegionSinonimo::find($request->id);
        $sinonimo->delete();
        return \Response::json(1);

    }
  }

  public function regionesSeleccionadas(Request $request)
  {
    if($request->ajax()) {
      $regiones = Region::where('activo', true)
                ->join('be_vista_lista_padre_dpm', 'regiones.id_padre', '=', 'be_vista_lista_padre_dpm.value')
                ->whereIn('categoria',$request->nivel_sel)
                ->select('regiones.*', 'be_vista_lista_padre_dpm.label')
                ->orderBy('id','DESC')
                ->get();

        return \Response::json($regiones);
    }
  }
}
