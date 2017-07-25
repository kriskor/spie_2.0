<?php

namespace App\Http\Controllers\ModuloAdmindatabase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ModuloAdmindatabase\Validador;
use App\ModuloAdmindatabase\Otro;

class ClasificadoresController extends Controller
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
  public function crearValidadores()
  {
    $clasificadores = Validador::get();
    $otros = Otro::where('activo', true)->groupBy('descripcion')->orderBy('descripcion','DESC')->select('descripcion')->get();
    return view('ModuloAdmindatabase.crear_clasificadores',['clasificadores' => $clasificadores,'otros' => $otros]);
  }
  public function guardarNuevoValidador(Request $request)
  {
    try{
      $validador = new Validador();
      $validador->nombre_clasificador = $request->nombre_clasificador;
      $validador->nombre_vista = "be_vista_".$request->nombre_clasificador;
      $validador->titulo = $request->titulo;
      $validador->save();


      $dataValidador = Validador::find($validador->id);

      //creamos la vista
      \DB::connection('dbestadistica')
      ->select(" CREATE VIEW ".$dataValidador->nombre_vista." AS(
                    SELECT
                  	o.id AS id_oficial,
                    o.nombre AS nombre_oficial,
                    os.id AS id_sinonimo,
                    os.sinonimo AS nombre_sinonimo,
                    (o.nombre || '=>' || os.sinonimo) AS original_sinonimo,
                  	'' as nombre_completo
                    FROM otros o
                    JOIN otros_sinonimos os ON o.id = os.id_otro
                    WHERE activo = true
                    AND descripcion = '".$dataValidador->nombre_clasificador."'
                  )");


      return redirect()->action('ModuloAdmindatabase\ClasificadoresController@crearValidadores');
    }catch(Exception $e){
        dd( $e->getMessage() ) ; // insert query
    }

  }

  public function eliminarValidador($id)
  {
    try{
      $validador = Validador::find($id);
      $validador->delete();
      return redirect()->action('ModuloAdmindatabase\ClasificadoresController@crearValidadores');
    }catch(Exception $e){
        dd( $e->getMessage() ) ; // insert query
    }

  }
}
