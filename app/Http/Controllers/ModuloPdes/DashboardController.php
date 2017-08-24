<?php

namespace App\Http\Controllers\ModuloPdes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModuloIndicadores\Resultado;

class DashboardController extends Controller
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
  public function tableroPdes()
  {
    $resultados = Resultado::orderBy('cod_r','asc')->get();
    return view('ModuloPdes.tablero_pdes',['resultados' => $resultados]);
  }
}
