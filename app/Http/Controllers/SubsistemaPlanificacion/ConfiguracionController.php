<?php

namespace App\Http\Controllers\SubsistemaPlanificacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\SubsistemaPlanificacion\Programasmef;
use App\SubsistemaPlanificacion\Accionprogramasmef;

class ConfiguracionController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware(function ($request, $next) {
    $this->user= \Auth::user();
    $rol = (int) $this->user->id_rol;
    $sql = \DB::select("SELECT m.* FROM menus m INNER JOIN roles_menu rm ON m.id = rm.id_menu WHERE rm.id_rol = ".$rol." AND id_modulo = 1 ORDER BY m.orden ASC");
    $this->menus = array();
    foreach ($sql as $mn) {

        $submenu = \DB::select("SELECT * FROM sub_menus WHERE id_menu = ".$mn->id." ORDER BY orden ASC");
        array_push($this->menus, array('id' => $mn->id,
                                'titulo' => $mn->titulo,
                                'descripcion' => $mn->descripcion,
                                'url' => $mn->url,
                                'icono' => $mn->icono,
                                'id_html' => $mn->id_html,
                                'submenus' => $submenu));
    }
    //dd($this->menus);
    \View::share([ 'menu'=> $this->menus ]);

    return $next($request);

    });
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //return view('SubsistemaPlanificacion.dashboard');
  }

  public function programaMefPdes()
  {
    return view('SubsistemaPlanificacion.configuracion');
  }

  public function listaProgramasMef(Request $request)
  {

    if($request->ajax()) {
        $listaprogramas = Programasmef::where('activo', true)->orderBy('id','DESC')->get();
        return \Response::json($listaprogramas);
    }


  }


  public function guardarArticulacionPrograma(Request $request)
  {
    try{
      $articulacion = new Accionprogramasmef();
      $articulacion->id_programa_mef = $request->programa;
      $articulacion->id_accion = $request->accion;
      $articulacion->activo = true;
      $articulacion->save();
      return \Response::json($articulacion->id);
    }catch(Exception $e){

        return \Response::json([
                   'success' => 'false',
                   'errors'  => "nosoe",
               ], 500);
        }

  }

  public function listaAlineacionProgramas(Request $request)
  {

    if($request->ajax()) {
      $articulacion = \DB::select("SELECT apm.id,vc.codigo, vc.desc_a
                                  FROM sp_accion_programas_mef apm
                                  INNER JOIN sp_vista_catalogo_pdes vc ON apm.id_accion = vc.id_accion
                                  WHERE apm.id_programa_mef = ?
                                  AND apm.activo=true",[$request->get('programa')]);
        return \Response::json($articulacion);
    }


  }

  public function guardararNuevoPrograma(Request $request)
  {
    try{
      $programaMef = new Programasmef();
      $programaMef->descripcion = $request->nombre_programa;
      $programaMef->codigo_mef = trim($request->codigo_mef);
      $programaMef->activo = true;
      $programaMef->save();
      return \Response::json($programaMef->id);
    }catch(Exception $e){

        return \Response::json([
                   'success' => 'false',
                   'errors'  => "nosoe",
               ], 500);
    }

  }

  public function datosProgramaMef(Request $request)
  {

    if($request->ajax()) {
        $datosPrograma = Programasmef::find($request->programa);
        return \Response::json($datosPrograma);
    }


  }

  public function modificarPrograma(Request $request)
  {
    try{
      $programaMef = Programasmef::find($request->id_programa);
      $programaMef->descripcion = trim($request->nombre_programa_mod);
      $programaMef->codigo_mef = $request->codigo_mef_mod;
      $programaMef->save();
      return \Response::json($programaMef->id);
    }catch(Exception $e){

        return \Response::json([
                   'success' => 'false',
                   'errors'  => "nosoe",
               ], 500);
    }

  }
  public function eliminarProgramaMef(Request $request)
  {
    try{
      $programaMef = Programasmef::find($request->programa);
      $programaMef->activo = false;
      $programaMef->save();
      return \Response::json($programaMef->id);
    }catch(Exception $e){

        return \Response::json([
                   'success' => 'false',
                   'errors'  => "nosoe",
               ], 500);
    }

  }

  public function eliminarArticulacionProgramaPDES(Request $request)
  {
    try{
      $articulacionProgPDES = Accionprogramasmef::find($request->alineacion);
      $articulacionProgPDES->activo = false;
      $articulacionProgPDES->save();
      return \Response::json($articulacionProgPDES->id);
    }catch(Exception $e){

        return \Response::json([
                   'success' => 'false',
                   'errors'  => "nosoe",
               ], 500);
    }

  }


}
