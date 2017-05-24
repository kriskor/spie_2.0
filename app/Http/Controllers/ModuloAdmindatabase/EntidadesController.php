<?php

namespace App\Http\Controllers\ModuloAdmindatabase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ModuloAdmindatabase\EntidadSinonimo;
use App\ModuloAdmindatabase\Entidad;


class EntidadesController extends Controller
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

    $entidades = Entidad::get();
    return view('ModuloAdmindatabase.entidades',['regiones' => $regiones,'entidades' => $entidades]);
  }



  public function listaClasificadorEntidades()
  {

    $entidades = \DB::connection('dbestadistica')
                ->select('select e.*, vr.nombre_completo as region
                          FROM entidades e
                          left join vista_regiones vr ON e.id_region = vr.id
                          WHERE activo is true
                          ORDER BY id DESC');
    return json_encode($entidades);
  }
  public function listaSinonimosEntidad(Request $request)
  {

    if($request->ajax()) {
        $sinonimoEntidad = \DB::connection('dbestadistica')
                           ->select('select *
                                     from entidades_sinonimos
                                     where id_entidad = ?
                                     order by id desc', [$request->get('id')]);
        return \Response::json($sinonimoEntidad);
    }


  }


  public function store(Request $request)
  {
    try{
      $entidad = new Entidad();
      $entidad->nombre = $request->nombre;
      $entidad->sigla = $request->sigla;
      $entidad->codigo_mef = $request->codigo_mef;
      $entidad->fecha_creacion =  (!empty($request->fecha_creacion))?date("Y-m-d", strtotime($request->fecha_creacion)):null;
      $entidad->normativa_creacion = $request->normativa_creacion;
      $entidad->url_web = $request->url_web;
      $entidad->id_region = (!empty($request->id_region))?$request->id_region:null;
      $entidad->tipo_relacion = $request->tipo_relacion;
      $entidad->id_relacion = (!empty($request->id_relacion))?$request->id_relacion:null;
      $entidad->activo = true;
      $entidad->save();
      return \Response::json(1);
    }catch(Exception $e){
        dd( $e->getMessage() ) ; // insert query
    }

  }
  public function modificarEntidad(Request $request)
  {
    try{
      $entidad = Entidad::find($request->mod_id_entidad);
      $entidad->nombre = $request->mod_nombre;
      $entidad->sigla = $request->mod_sigla;
      $entidad->codigo_mef = $request->mod_codigo_mef;
      $entidad->fecha_creacion =  (!empty($request->mod_fecha_creacion))? $request->mod_fecha_creacion : null;

      $entidad->normativa_creacion = $request->mod_normativa_creacion;
      $entidad->url_web = $request->mod_url_web;
      $entidad->id_region = (!empty($request->mod_id_region))?$request->mod_id_region:null;
      $entidad->tipo_relacion = $request->mod_tipo_relacion;
      $entidad->id_relacion = (!empty($request->mod_id_relacion))?$request->mod_id_relacion:null;
      $entidad->activo = true;
      $entidad->save();
      return \Response::json(1);
    }catch(Exception $e){
        dd( $e->getMessage() ) ; // update query
    }

  }

  public function eliminarEntidad(Request $request)
  {
    try{
      $entidad = Entidad::find($request->entidad);
      $entidad->activo = false;
      $entidad->save();
      return \Response::json(1);
    }catch(Exception $e){
        dd( $e->getMessage() ) ; // update query
    }

  }

  public function addSinonimoEntidad(Request $request)
  {

   if($request->ajax()) {
        $sinonimo = new EntidadSinonimo;
        $sinonimo->sinonimo ="Registrar sinonimo";
        $sinonimo->id_entidad = $request->id_entidad;
        $sinonimo->save();
        return \Response::json($sinonimo->id);
    }
  }

  public function updateSinonimoEntidad(Request $request)
  {

   if($request->ajax()) {
        $sinonimo = EntidadSinonimo::find($request->id);
        $sinonimo->sinonimo = strtoupper($request->sinonimo);
        $sinonimo->id_entidad = $request->id_entidad;
        $sinonimo->save();
        return \Response::json(1);

    }
  }

  public function deleteSinonimoEntidad(Request $request)
  {

   if($request->ajax()) {
        $sinonimo = EntidadSinonimo::find($request->id);
        $sinonimo->delete();
        return \Response::json(1);

    }
  }

  public function detalleEntidad(Request $request)
  {

   if($request->ajax()) {
       $dEntidad = Entidad::find($request->entidad);
       return \Response::json($dEntidad);

    }
  }


}
