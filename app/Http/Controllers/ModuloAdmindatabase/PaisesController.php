<?php

namespace App\Http\Controllers\ModuloAdmindatabase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ModuloAdmindatabase\Pais;
use App\ModuloAdmindatabase\PaisSinonimo;

class PaisesController extends Controller
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

    //$entidades = Entidad::get();
    return view('ModuloAdmindatabase.paises');
  }

  public function listaPaises()
  {

    $paises = \DB::connection('dbestadistica')
                ->select('SELECT *
                          FROM paises
                          WHERE activo = true
                          ORDER BY id DESC');
    return json_encode($paises);
  }
  public function listaSinonimosPais(Request $request)
  {

    if($request->ajax()) {
        $sinonimoPais = \DB::connection('dbestadistica')
                           ->select('select *
                                     from paises_sinonimos
                                     where id_pais = ?
                                     order by id desc', [$request->get('id')]);
        return \Response::json($sinonimoPais);
    }


  }

  public function addSinonimoPais(Request $request)
  {

   if($request->ajax()) {
        $sinonimo = new PaisSinonimo;
        $sinonimo->sinonimo ="Registrar sinonimo";
        $sinonimo->id_pais = $request->id_pais;
        $sinonimo->save();
        return \Response::json($sinonimo->id);
    }
  }
  public function updateSinonimoPais(Request $request)
  {

   if($request->ajax()) {
        $sinonimo = PaisSinonimo::find($request->id);
        $sinonimo->sinonimo = strtoupper($request->sinonimo);
        $sinonimo->id_pais = $request->id_pais;
        $sinonimo->save();
        return \Response::json(1);

    }
  }
  public function deleteSinonimoPais(Request $request)
  {

   if($request->ajax()) {
        $sinonimo = PaisSinonimo::find($request->id);
        $sinonimo->delete();
        return \Response::json(1);

    }
  }

  public function store(Request $request)
  {
    try{
      $pais = new Pais();
      $pais->nombre_comun = $request->nombre_comun;
      $pais->nombre_iso_oficial = $request->nombre_iso_oficial;
      $pais->nombre_ingles = $request->nombre_ingles;
      $pais->nombre_bd = $request->nombre_bd;
      $pais->capital = $request->capital;
      $pais->continente = $request->continente;
      $pais->sub_clasificacion = $request->sub_clasificacion;
      $pais->latitud = (!empty($request->latitud))?$request->latitud:null;
      $pais->longitud = (!empty($request->latitud))?$request->latitud:null;
      $pais->codigo_alfa_2 = $request->codigo_alfa_2;
      $pais->codigo_alfa_3 = $request->codigo_alfa_3;
      $pais->codigo_numerico = (!empty($request->codigo_numerico))?$request->codigo_numerico:null;
      $pais->observaciones = $request->observaciones;
      $pais->activo = true;
      $pais->save();
      return \Response::json(1);
    }catch(Exception $e){
        dd( $e->getMessage() ) ; // insert query
    }

  }

  public function detallePais(Request $request)
  {

   if($request->ajax()) {
       $dPais = Pais::find($request->pais);
       return \Response::json($dPais);

    }
  }

  public function modificarPais(Request $request)
  {
    try{
      $pais = Pais::find($request->id_pais);
      $pais->nombre_comun = $request->mod_nombre_comun;
      $pais->nombre_iso_oficial = $request->mod_nombre_iso_oficial;
      $pais->nombre_ingles = $request->mod_nombre_ingles;
      $pais->nombre_bd = $request->mod_nombre_bd;
      $pais->capital = $request->mod_capital;
      $pais->continente = $request->mod_continente;
      $pais->sub_clasificacion = $request->mod_sub_clasificacion;
      $pais->latitud = (!empty($request->mod_latitud))?$request->mod_latitud:null;
      $pais->longitud = (!empty($request->mod_latitud))?$request->mod_latitud:null;
      $pais->codigo_alfa_2 = $request->mod_codigo_alfa_2;
      $pais->codigo_alfa_3 = $request->mod_codigo_alfa_3;
      $pais->codigo_numerico = (!empty($request->mod_codigo_numerico))?$request->mod_codigo_numerico:null;
      $pais->observaciones = $request->mod_observaciones;
      $pais->save();
      return \Response::json(1);
    }catch(Exception $e){
        dd( $e->getMessage() ) ; // update query
    }

  }

  public function eliminarPais(Request $request)
  {
    try{
      $pais = Pais::find($request->pais);
      $pais->activo = false;
      $pais->save();
      return \Response::json(1);
    }catch(Exception $e){
        dd( $e->getMessage() ) ; // update query
    }

  }





}
