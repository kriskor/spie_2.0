<?php

namespace App\Http\Controllers\SubsistemaPlanificacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
