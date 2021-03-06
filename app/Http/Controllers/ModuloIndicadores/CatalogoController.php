<?php

namespace App\Http\Controllers\ModuloIndicadores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ModuloIndicadores\Pilar;
use App\ModuloIndicadores\Meta;
use App\ModuloIndicadores\Resultado;
use App\ModuloIndicadores\Indicador;
use App\ModuloIndicadores\ResultadoIndicador;

class CatalogoController extends Controller
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
    $resultados = Resultado::orderBy('cod_r','asc')->get();
    return view('ModuloIndicadores.catalogo',['resultados' => $resultados]);
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
        $resultados = Resultado::orderBy('cod_r','asc')->get();
        return \Response::json($resultados);
    }
  }
  public function listarResultadosAll(Request $request)
  {

   if($request->ajax()) {
        $resultados = Resultado::orderBy('cod_r','asc')->get();
        return \Response::json($resultados);
    }
  }
  public function listarResultadosPriorizados(Request $request)
  {

   if($request->ajax()) {
        $resultados = Resultado::where('priorizado','=',1)->orderBy('cod_r','asc')->get();
        return \Response::json($resultados);
    }
  }

  public function listaClasificacionResultado(Request $request)
  {

    if($request->ajax()) {
          $clasificacion = \DB::connection('dbestadistica')
                          ->select("SELECT 'Todos' as clasificacion
                                        UNION ALL
                                        select clasificacion
                                        FROM resultados
                                        GROUP BY clasificacion");
        return \Response::json($clasificacion);
     }

  }


  public function listarResultadosAllClasificados(Request $request)
  {
   if($request->ajax()) {

         if($request->clasificacion =='Todos'){
           $resultados = Resultado::orderBy('cod_r','asc')->get();
           return \Response::json($resultados);
         }else{
           $resultados = Resultado::where('clasificacion', '=', $request->clasificacion)->orderBy('cod_r','asc')->get();
           return \Response::json($resultados);
         }

    }
  }


  public function datosPilar(Request $request)
  {
   if($request->ajax()) {
        $dPilar = Pilar::find($request->pilar);
        return \Response::json($dPilar);
    }
  }

  public function datosMeta(Request $request)
  {

   if($request->ajax()) {
        $dMeta = Meta::find($request->meta);
        return \Response::json($dMeta);
    }
  }

  public function datosResultado(Request $request)
  {

   if($request->ajax()) {

        $dResultado = \DB::connection('dbestadistica')
                    ->select("select p.nombre as pilar_nombre,p.descripcion as pilar_desc,m.nombre as meta_nombre,m.descripcion as meta_desc,r.*
                              from resultados r
                              inner join metas m ON r.meta = m.id
                              inner join  pilares p ON m.pilar = p.id
                              where r.id = ?", [$request->get('resultado')]);



        //$dResultado = Resultado::find($request->resultado);


        return \Response::json($dResultado);
    }
  }

  public function listaIndIcadores(Request $request)
  {

   if($request->ajax()) {

     $dIndicadores = \DB::connection('dbestadistica')
                     ->select('SELECT *
                                  FROM indicadores i
                                  INNER JOIN resultado_indicadores ri ON i.id_indicador = ri.id_indicador
                                  WHERE id_resultado = ?
                                  AND i.estado = true
                                  ORDER BY i.id_indicador DESC', [$request->get('resultado')]);
     return \Response::json($dIndicadores);

    }
  }


  public function guardarIndicador(Request $request)
  {

   if($request->ajax()) {
        try{
          if($request->sel_indicador == false){
           $indicador = new Indicador;
           $indicador->nombre = $request->indicador_nombre;
           $indicador->fuente_informacion = $request->fuente_informacion;

           $indicador->linea_base_gestion = (int)$request->linea_base_gestion;
           $indicador->linea_base_valor = ($request->linea_base_valor!="")?$request->linea_base_valor:0;
           $indicador->linea_base_unidad = $request->linea_base_unidad;
           $indicador->linea_base_descripcion = $request->linea_base_descripcion;
           $indicador->linea_base_fuente_alternativa = $request->linea_base_fuente_alternativa;

           $indicador->estado_indicador = $request->estado_indicador;

           $indicador->estado = true;
           $indicador->save();
           $idIndicador =  $indicador->id_indicador;
         }else{
           $idIndicador =  $request->id_indicador_sel;
         }

           $ResIndicador = new ResultadoIndicador;
           $ResIndicador->id_resultado = $request->resultado_asignado;
           $ResIndicador->id_indicador = $idIndicador;
           $ResIndicador->punto_medicion = $request->etapa_indicador;
           $ResIndicador->save();
          return \Response::json(1);
       }catch(Exception $e){
        dd( $e->getMessage() ) ; // insert query
      }


    }
  }

  public function datosIndicador(Request $request)
  {

   if($request->ajax()) {

     //$dIndicadores = Indicador::find($request->indicador);
     $dIndicadores = \DB::connection('dbestadistica')
                   ->select('SELECT *
                                  FROM indicadores i
                                  INNER JOIN resultado_indicadores ri ON i.id_indicador = ri.id_indicador
                                  WHERE ri.id_resultado_indicador = ?', [$request->get('indicador_resultado')]);
     return \Response::json($dIndicadores);

    }
  }

  public function datosCatalogoIndicador(Request $request)
  {

   if($request->ajax()) {

     //$dIndicadores = Indicador::find($request->indicador);
     $dIndicadores = \DB::connection('dbestadistica')
                   ->select('SELECT *
                             FROM indicadores i
                             WHERE i.id_indicador = ?', [$request->get('indicador')]);
     return \Response::json($dIndicadores);

    }
  }

  public function modificarIndicador(Request $request)
  {

   if($request->ajax()) {
        try{
           $indicador = Indicador::find($request->mod_id_indicador);
           $indicador->nombre = $request->mod_indicador_nombre;
           $indicador->fuente_informacion = $request->mod_fuente_informacion;

           $indicador->linea_base_gestion = (int) $request->mod_linea_base_gestion;
           $indicador->linea_base_valor = ($request->mod_linea_base_valor!="")?$request->mod_linea_base_valor:0;
           $indicador->linea_base_unidad = $request->mod_linea_base_unidad;
           $indicador->linea_base_descripcion = $request->mod_linea_base_descripcion;
           $indicador->linea_base_fuente_alternativa = $request->mod_linea_base_fuente_alternativa;
           $indicador->estado_indicador = $request->mod_estado_indicador;

           $indicador->save();
           $ResIndicador = ResultadoIndicador::find($request->mod_id_resultado_indicador);;
           $ResIndicador->punto_medicion = $request->mod_etapa_indicador;
           $ResIndicador->save();
          return \Response::json(1);
       }catch(Exception $e){
        dd( $e->getMessage() ) ; // insert query
      }


    }
  }

  public function eliminarIndicador(Request $request)
  {

   if($request->ajax()) {
        try{
           $indicador = ResultadoIndicador::find($request->indicador_resultado);
           $indicador->delete();
          return \Response::json(1);
       }catch(Exception $e){
        dd( $e->getMessage() ) ; // insert query
      }


    }
  }

  public function listaResultadoMedidasIndicador(Request $request)
  {

    if($request->ajax()) {
          $datos = \DB::connection('dbestadistica')
                  ->select("SELECT ri.punto_medicion as name,count(*)::INT as y,
                                	CASE
                                  WHEN (ri.punto_medicion = 'Proceso') THEN '#4E79A7'
                                  WHEN (ri.punto_medicion = 'Producto') THEN '#F28F2D'
                                	WHEN (ri.punto_medicion = 'Resultado') THEN '#E1595B'
                                 END AS segmentColor
                                  FROM resultado_indicadores ri
                                  INNER JOIN indicadores i ON ri.id_indicador = i.id_indicador
                                  WHERE ri.id_resultado = ?
                                  AND i.estado = true
                                  GROUP BY ri.punto_medicion
                                  ORDER BY ri.punto_medicion ASC",[$request->get('resultado')]);
        //  echo json_encode($datos);
        return \Response::json($datos);
     }

  }

  public function autocompletarIndicadores(Request $request)
  {

   if($request->ajax()) {
        $Indicadores = Indicador::where('estado', true)->select('id_indicador', 'nombre')->get();
        return \Response::json($Indicadores);
    }
  }



}
