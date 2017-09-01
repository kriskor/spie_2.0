<?php

namespace App\Http\Controllers\ModuloPdes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ModuloPdes\Pilar;
use App\ModuloPdes\Meta;
use App\ModuloPdes\Resultado;
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
}
