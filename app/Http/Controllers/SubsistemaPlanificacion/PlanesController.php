<?php

namespace App\Http\Controllers\SubsistemaPlanificacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\SubsistemaPlanificacion\Entidades;
use App\SubsistemaPlanificacion\Articulacion;
use App\SubsistemaPlanificacion\Pilar;
use App\SubsistemaPlanificacion\Meta;
use App\SubsistemaPlanificacion\Resultado;
use App\SubsistemaPlanificacion\Accion;
use App\SubsistemaPlanificacion\Plan;
use App\SubsistemaPlanificacion\Tipoplan;
use App\SubsistemaPlanificacion\Presupuesto;
use App\SubsistemaPlanificacion\Accionprogramasmef;
use App\SubsistemaPlanificacion\Programasmef;
use App\SubsistemaPlanificacion\Unidad;
use App\SubsistemaPlanificacion\Indicador;
use App\SubsistemaPlanificacion\Planindicador;


class PlanesController extends Controller
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
  public function index(){
    //$entidades = Entidad::get();
    //return view('ModuloAdmindatabase.entidades',['regiones' => $regiones,'entidades' => $entidades]);
  }

  public function entidadesTerritoriales(){
    //$entidades = Entidad::get();
    return view('SubsistemaPlanificacion.entidades_territoriales');
  }
  public function entidadesSectoriales(){
    //$entidades = Entidad::get();
    return view('SubsistemaPlanificacion.entidades_sectoriales');
  }

  public function listaEntidadesTerritoriales(Request $request)
  {

    if($request->ajax()) {
        $listaEntidades = Entidades::where('clasificador_sp', 'TERRITORIAL')->get();
        return \Response::json($listaEntidades);
    }


  }
  public function listaEntidadesSectoriales(Request $request)
  {

    if($request->ajax()) {
        $listaEntidades = Entidades::where('clasificador_sp', 'SECTORIAL')->get();
        return \Response::json($listaEntidades);
    }


  }

  public function articulacionEntidad(Request $request)
  {

    if($request->ajax()) {
      $articulacion = \DB::select("SELECT ar.id,
                                vcp.cod_p,vcp.pilar,vcp.desc_p,
                                vcp.cod_m,vcp.meta,vcp.desc_m,
                                vcp.cod_r,vcp.resultado,vcp.desc_r,
                                vcp.cod_a,vcp.accion,vcp.desc_a,
                                vcp.codigo,vcp.id_accion
                                FROM sp_articulacion ar
                                INNER JOIN sp_entidades e ON ar.id_entidad = e.id
                                INNER JOIN sp_vista_catalogo_pdes vcp ON ar.id_accion = vcp.id_accion
                                WHERE ar.id_entidad = ?",[$request->get('entidad')]);
        return \Response::json($articulacion);
    }


  }

  public function articulacionPlanTerritorial($id){
    //$entidades = Entidad::get();

    return view('SubsistemaPlanificacion.articulacion_territorial',['entidad' => $id]);
  }

  public function listarPilares(Request $request)
  {

   if($request->ajax()) {
        $pilares = Pilar::orderBy('cod_p','asc')->get();
        return \Response::json($pilares);
    }
  }
  public function listarMetas(Request $request)
  {
   if($request->ajax()) {
        $metas = Meta::orderBy('cod_m','asc')->get();
        return \Response::json($metas);
    }
  }
  public function listarResultados(Request $request)
  {

   if($request->ajax()) {
        $resultados = Resultado::select('id', 'meta', \DB::raw("(nombre||': '||descripcion) AS nombre"))->orderBy('cod_r','asc')->get();
        return \Response::json($resultados);
    }
  }
  public function listarAcciones(Request $request)
  {
   if($request->ajax()) {
        $acciones = Accion::select('id', 'resultado', \DB::raw("(nombre||': '||descripcion) AS nombre"))->orderBy('cod_a','asc')->get();
        return \Response::json($acciones);
    }
  }
  public function guardarArticulacion(Request $request)
  {
    try{
      $articulacion = new Articulacion();
      $articulacion->id_entidad = $request->entidad;
      $articulacion->id_accion = $request->accion;
      $articulacion->save();

      $programasMEF = \DB::select("SELECT pr.id,pr.descripcion
                                    FROM sp_programas_mef pr
                                    INNER JOIN sp_accion_programas_mef apm ON pr.id = apm.id_programa_mef
                                    WHERE apm.id_accion = ?
                                    AND pr.activo = true
                                    AND apm.activo = true ", [$request->accion]);

      foreach ($programasMEF as $pr) {
        $planAutomatico = new Plan();
        $planAutomatico->id_articulacion = $articulacion->id;
        $planAutomatico->nombre_plan = trim($pr->descripcion);
        $planAutomatico->id_tipo_plan = 5;

        $planAutomatico->nivel ='n1';
        $planAutomatico->id_padre = null;
        $planAutomatico->activo = true;
        $planAutomatico->id_programa_mef = $pr->id;
        $planAutomatico->save();
      }

      return \Response::json(1);
    }catch(Exception $e){

        return \Response::json([
                   'success' => 'false',
                   'errors'  => "nosoe",
               ], 500);
        }

  }


  public function eliminarArticulacion(Request $request)
  {
      try{
        $articulacion =Articulacion::find($request->articulacion);
        $articulacion->delete();
        return \Response::json(1);
      }catch(Exception $e){
          return \Response::json([
                     'success' => 'false',
                     'errors'  => "nosoe",
                 ], 500);
      }
  }

  public function guardarPlan(Request $request)
  {
    try{
      $plan = new Plan();
      $plan->id_articulacion = $request->id_articulacion;
      $plan->nombre_plan = trim($request->nombre_plan);
      $plan->id_tipo_plan = $request->tipo_plan;

      $plan->nivel = ( $request->id_padre == '')? 'n1':'n2' ;
      $plan->id_padre = ( $request->id_padre != '')? $request->id_padre: null;
      $plan->activo = true;
      $plan->save();

      $añoI = 2016;
      $añoF = 2020;
      if($request->tipo_plan != 5){
        for ($i=$añoI;$i<=$añoF;$i++) {
          $presupuesto = new Presupuesto();
          $presupuesto->id_plan = $plan->id;
          $presupuesto->gestion = $i;
          $presupuesto->monto = 0.00;
          $presupuesto->save();
        }
      }


      return \Response::json($request->id_articulacion);
    }catch(Exception $e){

        return \Response::json([
                   'success' => 'false',
                   'errors'  => "nosoe",
               ], 500);
        }

  }

  public function listaPlanesArticulacion(Request $request)
  {
   if($request->ajax()) {
       $sql = \DB::select("SELECT pl.*
                         FROM sp_articulacion ar
                         INNER JOIN sp_planes pl ON ar.id = pl.id_articulacion
                         WHERE ar.id_entidad = ?
                         AND ar.id = ?
                         AND pl.nivel = 'n1'
                         AND pl.activo = true", [$request->id_entidad,$request->id_articulacion]);
      $html = '';
      $src = "";

       foreach ($sql as $l) {
            if($l->id_tipo_plan == 5){
              $html .="<div class='col-lg-1 col-md-1 col-sm-6 col-xs-12 text-left'>
                          <a class='thumbnail context-menu-dos' ondblclick='explorar($l->id);' name='$l->id' onmousedown='detectarBoton(event,this);' onblur='detectarBoton(event,this);'>
                            <img class='img-responsive' src='/assets_admin_one/img/img$l->id_tipo_plan.png' alt='LOG'>
                          </a>
                          <span class='thumb-name'><strong id='name_$l->id'>$l->nombre_plan</strong></span>
                      </div>";
            }else{
              $html .="<div class='col-lg-1 col-md-1 col-sm-6 col-xs-12 text-left'>
                          <a class='thumbnail context-menu-one' ondblclick='detallar_plan($l->id);' name='$l->id' onmousedown='detectarBoton(event,this);'>
                            <img class='img-responsive' src='/assets_admin_one/img/img".$l->id_tipo_plan.".png' alt='LOG'>
                          </a>
                          <span class='thumb-name'><strong id='name_$l->id'>".$l->nombre_plan."</strong></span>
                      </div>";

            }
       }

        return \Response::json($html);
    }

  }


  public function listaPlanesArticulacionHijos(Request $request)
  {
   if($request->ajax()) {
       $sql = \DB::select("SELECT pl.*
                         FROM sp_articulacion ar
                         INNER JOIN sp_planes pl ON ar.id = pl.id_articulacion
                         WHERE ar.id_entidad = ?
                         AND ar.id = ?
                         AND pl.nivel = 'n2'
                         AND id_padre = ?
                         AND pl.activo=true", [$request->id_entidad,$request->id_articulacion,$request->id_padre]);

      $datosPadre = Plan::find($request->id_padre);
      $html = "";
       foreach ($sql as $l) {
          $html .="<div class='col-lg-1 col-md-1 col-sm-6 col-xs-12 text-center'>
                      <a class='thumbnail context-menu-one' ondblclick='detallar_plan($l->id);' name='$l->id' onmousedown='detectarBoton(event,this);'>
                        <img class='img-responsive' src='/assets_admin_one/img/img".$l->id_tipo_plan.".png' alt='LOG'>
                      </a>
                      <span class='thumb-name'><strong id='name_$l->id'>".$l->nombre_plan."</strong></span>
                  </div>";
       }

       $dato['titulo']=$datosPadre->nombre_plan;
       $dato['html']=$html;

        return \Response::json($dato);
    }

  }

  public function eliminarPlan(Request $request)
  {
      try{
        $plan = Plan::find($request->id);
        $plan->activo = false;
        $plan->save();
        return \Response::json($plan->id_articulacion);
      }catch(Exception $e){
          return \Response::json([
                     'success' => 'false',
                     'errors'  => "nosoe",
                 ], 500);
      }
  }
  protected function parse_number($number, $dec_point = null) {
          if (empty($dec_point)) {
              $locale = localeconv();
              $dec_point = $locale['decimal_point'];
          }
          return floatval(str_replace($dec_point, '.', preg_replace('/[^\d' . preg_quote($dec_point) . ']/', '', $number)));
  }

  public function modificaPlanGeneral(Request $request)
  {
      try{
        $plan = Plan::find($request->id_plan);
        $plan->nombre_plan = $request->nombre_plan;
        $plan->monto_total_plan = $this->parse_number($request->monto_total_plan, ',') ;
        $plan->save();

        if(isset($request->descripcion)){
          foreach ($request->descripcion as $k => $v) {
            if($request->id_indicador[$k] < 0){
                $indicadorProceso = new Indicador();
                $indicadorProceso->nombre_indicador = $request->descripcion[$k];
                $indicadorProceso->tipo = 2;
                $indicadorProceso->activo = true;
                $indicadorProceso->save();

                $planIndicadores = new Planindicador();
                $planIndicadores->id_plan = $request->id_plan;
                $planIndicadores->id_indicador = $indicadorProceso->id;
                $planIndicadores->unidad_numerica = ($request->meta[$k] !="")?$request->meta[$k]:0;
                $planIndicadores->unidad_medida = $request->unidad[$k];;
                $planIndicadores->activo = true;
                $planIndicadores->save();
            }else{
              if($request->estado[$k] == 0){
                  /*$indicadorProceso = Indicador::find( $request->id_indicador[$k]);
                  $indicadorProceso->activo = false;
                  $indicadorProceso->save();*/

                  $planindicador = Planindicador::where('id_plan',$request->id_plan )
                                  ->where('id_indicador',$request->id_indicador[$k] )->first();
                  $planindicador->activo = false;
                  $planindicador->save();

                  // \DB::table('sp_plan_indicadores')
                  // ->where('id_plan',$request->id_plan )
                  // ->where('id_indicador',$request->id_indicador[$k] )
                  // ->update(array( 'activo' => false ));

              }else{
                $indicadorProceso = Indicador::find( $request->id_indicador[$k]);
                $indicadorProceso->nombre_indicador = $request->descripcion[$k];
                $indicadorProceso->activo = true;
                $indicadorProceso->save();

                $planindicador = Planindicador::where('id_plan',$request->id_plan )->where('id_indicador',$request->id_indicador[$k] )->first();
                $planindicador->unidad_numerica = ($request->meta[$k] !="")?$request->meta[$k]:0;
                $planindicador->unidad_medida = $request->unidad[$k];
                $planindicador->save();


              }
            }



          }
        }
        $indicadorProceso =


        $data['id'] = $plan->id;
        $data['nombre_plan'] = $plan->nombre_plan;
        return \Response::json($data);
      }catch(Exception $e){
          return \Response::json([
                     'success' => 'false',
                     'errors'  => "nose guardo nada",
                 ], 500);
      }
  }

  public function mostrarPlanGeneral(Request $request)
  {
   if($request->ajax()) {
        $datosPlan = Plan::select('id','id_tipo_plan','nombre_plan',\DB::raw("to_char(monto_total_plan,'999G999G999G999G999G999G999D99') as monto_total_plan"))->find($request->id);
        $tipoPlan = Tipoplan::find($datosPlan->id_tipo_plan);

        $listaIndicadoresProceso = \DB::select('SELECT i.id,i.nombre_indicador,pi.unidad_numerica,pi.unidad_medida
                                                FROM sp_plan_indicadores pi
                                                INNER JOIN sp_indicadores i ON pi.id_indicador = i.id
                                                WHERE pi.id_plan = ?
                                                AND i.tipo = 2
                                                AND pi.activo = true', [$datosPlan->id]);


        $unidades = Unidad::where('activo', true)->orderBy('orden', 'asc')->get();
        $htmlIP="";
        foreach ($listaIndicadoresProceso as $ip) {


            $option = "";
            foreach ($unidades as $u) {
                if($u->id == $ip->unidad_medida)
                    $option.="<option value='$u->id' selected>$u->unidad</option>";
                else
                    $option.="<option value='$u->id'>$u->unidad</option>";
            }

            $htmlIP .= '<div id="IP'.$ip->id.'" class="form-group row  ribbon-wrapper-reverse " style="background:#F7FAFC none repeat scroll 0 0;">
                          <div class="ribbon ribbon-right ribbon-danger"><a class="btn btn-block btn-danger btn-sm" onclick="quitarIP('.$ip->id.');">Eliminar</a></div>
                          <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                              <label class="control-label">Nombre del indicador</label>
                              <textarea name="descripcion[]" class="form-control" rows="1" placeholder="Descripcion">'.$ip->nombre_indicador.'</textarea>
                              <input type="hidden" name="id_indicador[]"  class="form-control" value="'.$ip->id .'">
                          </div>
                          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                              <label class="control-label">Meta</label>
                              <input type="text" name="meta[]"  class="form-control" value="'.$ip->unidad_numerica.'">
                          </div>
                          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                              <label class="control-label">Unidad de medida</label>
                              <select name="unidad[]" class="form-control">
                                  '.$option.'
                              </select>
                              <input type="hidden" id="EST'.$ip->id.'" name="estado[]"  class="form-control" value="1">
                          </div>
                      </div>';
        }




        $data['id']=$datosPlan->id;
        $data['nombre_plan']=$datosPlan->nombre_plan;
        $data['monto_total_plan']=trim($datosPlan->monto_total_plan);
        $data['tipo_plan'] = $tipoPlan->tipo;
        $data['indicadores_proces'] = $htmlIP;
        return \Response::json($data);
    }
  }
  // public function mostrarPlanPresupuesto(Request $request)
  // {
  //  if($request->ajax()) {
  //
  //       $html="";
  //       $añoI = 2016;
  //       $añoF = 2020;
  //       for ($i=$añoI;$i<=$añoF;$i++) {
  //         $presupuesto = Presupuesto::where('gestion', $i)
  //                      ->where('id_plan', $request->id)
  //                      ->select('id','gestion','id_plan',\DB::raw("to_char(monto,'999G999G999G999G999G999G999D99') as monto"))
  //                      ->get();
  //         if($presupuesto->count() > 0){
  //           foreach ($presupuesto as $p) {
  //             $html .="<tr>
  //                         <td>$p->gestion<input type='text'name='id_presupuesto[]' value='$p->id'></td>
  //                         <td><input type='text' placeholder='Monto' class='form-control money text-right' name='monto[]' value='".trim($p->monto)."'></td>
  //                     </tr>";
  //           }
  //         }else{
  //           $html .="<tr>
  //                       <td>$i<input type='text'name='id_presupuesto[]' value='-1'></td>
  //                       <td><input type='text' placeholder='Monto' class='form-control money text-right' name='monto[]' value='0,00'></td>
  //                   </tr>";
  //
  //         }
  //
  //
  //       }
  //       return \Response::json($html);
  //   }
  // }
  public function mostrarPlanPresupuesto(Request $request)
  {
   if($request->ajax()) {

        $html="";

          $presupuesto = Presupuesto::where('id_plan', $request->id)
                       ->select('id','gestion','id_plan',\DB::raw("to_char(monto,'999G999G999G999G999G999G999D99') as monto"))
                       ->get();

          foreach ($presupuesto as $p) {
              $html .="<tr>
                          <td>$p->gestion<input type='hidden' name='id_presupuesto[]' value='$p->id'><input type='hidden' name='gestion[]' value='$p->gestion'></td>
                          <td><input type='text' placeholder='Monto' class='form-control money text-right' name='monto[]' value='".trim($p->monto)."'></td>
                      </tr>";
          }




        return \Response::json($html);
    }
  }
  public function modificarPlanPresupuesto(Request $request)
  {
      try{

        $monto = $request->monto;

        foreach ( $monto as $k => $v) {
          $presupuesto = Presupuesto::find($request->id_presupuesto[$k]);
          $presupuesto->id_plan = $request->id_plan;
          $presupuesto->gestion = $request->gestion[$k];
          $presupuesto->monto = $this->parse_number($request->monto[$k], ',') ;
          $presupuesto->save();

        }


        return \Response::json(1);

      }catch(Exception $e){
          return \Response::json([
                     'success' => 'false',
                     'errors'  => "nose guardo nada",
                 ], 500);
      }
  }


  public function actualizarProgramasSugeridos(Request $request)
  {
    try{


      $programasMEF = \DB::select("SELECT pr.id,pr.descripcion
                                    FROM sp_programas_mef pr
                                    INNER JOIN sp_accion_programas_mef apm ON pr.id = apm.id_programa_mef
                                    WHERE apm.id_accion = ?
                                    AND pr.activo = true
                                    AND apm.activo = true ", [$request->id_accion]);

      foreach ($programasMEF as $pr) {
        $veriPrograma = Plan::where('id_articulacion', $request->id_articulacion)->where('id_programa_mef', $pr->id)->get();


        if($veriPrograma->count() == 0){

          $planAutomatico = new Plan();
          $planAutomatico->id_articulacion = $request->id_articulacion;
          $planAutomatico->nombre_plan = trim($pr->descripcion);
          $planAutomatico->id_tipo_plan = 5;

          $planAutomatico->nivel ='n1';
          $planAutomatico->id_padre = null;
          $planAutomatico->activo = true;
          $planAutomatico->id_programa_mef = $pr->id;
          $planAutomatico->save();
        }

      }

      return \Response::json($request->id_articulacion);
    }catch(Exception $e){

        return \Response::json([
                   'success' => 'false',
                   'errors'  => "nosoe",
               ], 500);
        }

  }

  public function cargarindIcadorProcesoPlantilla(Request $request)
  {

  $unidades = Unidad::where('activo', true)->orderBy('orden', 'asc')->get();
  $option = "";
  foreach ($unidades as $u) {
      $option.="<option value='$u->id'>$u->unidad</option>";
  }

   if($request->ajax()) {
        $html = '<div id="IP'.$request->id.'" class="form-group row  ribbon-wrapper-reverse " style="background:#F7FAFC none repeat scroll 0 0;">
                    <div class="ribbon ribbon-right ribbon-danger"><a class="btn btn-block btn-danger btn-sm" onclick="quitarIP('.$request->id.');">Eliminar</a></div>
                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                        <label class="control-label">Nombre del indicador</label>
                        <textarea name="descripcion[]" class="form-control" rows="1" placeholder="Descripcion"></textarea>
                        <input type="hidden" name="id_indicador[]"  class="form-control" value="-1">
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <label class="control-label">Meta</label>
                        <input type="text" name="meta[]"  class="form-control" value="">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <label class="control-label">Unidad de medida</label>
                        <select name="unidad[]" class="form-control">
                            '.$option.'
                        </select>
                        <input type="hidden" id="EST'.$request->id.'" name="estado[]"  class="form-control" value="1">
                    </div>
                </div>';
        return \Response::json($html);
    }
  }


}
