<?php

namespace App\Http\Controllers\ModuloPdes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ModuloPdes\Pilar;
use App\ModuloPdes\Meta;
use App\ModuloPdes\Resultado;

use App\ModuloPdes\Proyecto;
class IndicadoresController extends Controller
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
    return view('ModuloPdes.dashboard');
  }
  public function tableroIndicadores()
  {
    //$resultados = Resultado::orderBy('cod_r','asc')->get();
    return view('ModuloPdes.tablero_indicadores');
  }

  public function listarPilares(Request $request)
  {

   if($request->ajax()) {
        $pilares = Pilar::select("id", \DB::raw("'P'||cod_p as nombre"))->orderBy('cod_p','asc')->get();
        return \Response::json($pilares);
    }
  }
  public function listarMetas(Request $request)
  {
   if($request->ajax()) {
        $metas = Meta::select("id", \DB::raw("'M'||cod_m as nombre"),"pilar")->orderBy('cod_m','asc')->get();
        return \Response::json($metas);
    }
  }
  public function listarResultados(Request $request)
  {

   if($request->ajax()) {
        $resultados = Resultado::select("id", \DB::raw("'R'||cod_r as nombre"),"meta")->orderBy('cod_r','asc')->get();
        return \Response::json($resultados);
    }
  }

  public function datosGraficaIndicador(Request $request)
  {
    if($request->ajax()) {
        $datos = \DB::connection('dbestadistica')
                  ->select("SELECT t_ano as gestion, SUM(valor_cargado) as valor
                            FROM ".$request->vista."
                            GROUP BY gestion
                            ORDER BY gestion ASC");
        return \Response::json($datos);
    }
  }


  public function datosGraficaPilares(Request $request)
  {
        $datos = \DB::select("SELECT
                            tabla.nombre as pilar,
                            (
                            SELECT round((tabla.total_quinquenio*100)/SUM(total_quinquenio),2)
                            FROM mp_proyectos
                            ) as total
                            FROM (
                            SELECT p.cod_p, p.nombre, SUM(total_quinquenio) as total_quinquenio
                            FROM mp_pilares p
                            LEFT JOIN mp_proyectos pr ON p.cod_p = pr.cod_p
                            GROUP BY p.cod_p,p.nombre
                            ORDER BY p.cod_p ASC
                            ) as tabla");
        return \Response::json($datos);
  }

  public function datosGraficaPilaresPres(Request $request)
  {
        $datos = \DB::select("SELECT
                            	tabla.nombre as pilar,
                            	tabla.total_gestion as programado,
                              '0' as ejecutado
                              FROM (
                              	SELECT p.cod_p, p.nombre, SUM(gestion_2017) as total_gestion
                              	FROM mp_pilares p
                              	LEFT JOIN mp_proyectos pr ON p.cod_p = pr.cod_p
                              	GROUP BY p.cod_p,p.nombre
                              	ORDER BY p.cod_p ASC
                              ) as tabla");
        return \Response::json($datos);
  }

  public function datosGraficaAno(Request $request)
  {
    if($request->ajax()) {
        $datos = \DB::select("SELECT sum(gestion_2017) as programado,
                              10000000 as ejecutado,
                              round((10000000/sum(gestion_2017)) *100, 2) as procentaje
                              FROM mp_proyectos p
                              ");
        return \Response::json($datos);
    }
  }

  public function datosGraficaQuin(Request $request)
  {
    if($request->ajax()) {
        $datos = \DB::select("SELECT sum(total_quinquenio) as programado,
                              10000000 as ejecutado,
                              round((10000000/sum(total_quinquenio)) *100, 2) as procentaje
                              FROM mp_proyectos p
                              ");
        return \Response::json($datos);
    }
  }
}
