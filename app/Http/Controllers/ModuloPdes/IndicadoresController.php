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
}
