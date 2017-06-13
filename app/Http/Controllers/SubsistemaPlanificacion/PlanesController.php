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
                                vcp.codigo
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
      $html = "";
      $src = "";

       foreach ($sql as $l) {
            if($l->id_tipo_plan == 5){
              $html .="<div class='col-lg-2 col-md-2 col-sm-6 col-xs-12 text-left'>
                          <a class='thumbnail context-menu-dos' ondblclick='explorar($l->id);' name='$l->id' onmousedown='detectarBoton(event,this);' onblur='detectarBoton(event,this);'>
                            <img class='img-responsive' src='/assets_admin_one/img/img$l->id_tipo_plan.png' alt='LOG'>
                          </a>
                          <span class='thumb-name'><strong id='name_$l->id'>$l->nombre_plan</strong></span>
                      </div>";
            }else{
              $html .="<div class='col-lg-2 col-md-2 col-sm-6 col-xs-12 text-left'>
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
          $html .="<div class='col-lg-2 col-md-2 col-sm-6 col-xs-12 text-center'>
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
        $data['id']=$datosPlan->id;
        $data['nombre_plan']=$datosPlan->nombre_plan;
        $data['monto_total_plan']=trim($datosPlan->monto_total_plan);
        $data['tipo_plan'] = $tipoPlan->tipo;
        return \Response::json($data);
    }
  }
  public function mostrarPlanPresupuesto(Request $request)
  {
   if($request->ajax()) {

        $html="";
        $añoI = 2016;
        $añoF = 2020;
        for ($i=$añoI;$i<=$añoF;$i++) {
          $presupuesto = Presupuesto::where('gestion', $i)
                       ->where('id_plan', $request->id)
                       ->select('id','gestion','id_plan',\DB::raw("to_char(monto,'999G999G999G999G999G999G999D99') as monto"))
                       ->get();
          if($presupuesto->count() > 0){
            foreach ($presupuesto as $p) {
              $html .="<tr>
                          <td>$p->gestion</td>
                          <td><input type='text' placeholder='Monto' class='form-control money text-right' name='monto[]' value='".trim($p->monto)."'></td>
                      </tr>";
            }
          }else{
            $html .="<tr>
                        <td>$i</td>
                        <td><input type='text' placeholder='Monto' class='form-control money text-right' name='monto[]' value='0,00'></td>
                    </tr>";

          }


        }
        return \Response::json($html);
    }
  }

  public function modificarPlanPresupuesto(Request $request)
  {
      try{
        $presupuestoD = Presupuesto::where('id_plan', $request->id_plan);
        $presupuestoD->delete();
        $monto = $request->monto;
        $gestion = 2016;
        foreach ( $monto as $k => $v) {
          $presupuesto = new Presupuesto();
          $presupuesto->id_plan = $request->id_plan;
          $presupuesto->gestion = $gestion;
          $presupuesto->monto = $this->parse_number($request->monto[$k], ',') ;
          $presupuesto->save();
          $gestion ++;
        }


        return \Response::json(1);

      }catch(Exception $e){
          return \Response::json([
                     'success' => 'false',
                     'errors'  => "nose guardo nada",
                 ], 500);
      }
  }


}
