<?php

namespace App\Http\Controllers\ModuloAdmindatabase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModuloAdmindatabase\VariableEstadistica;
use App\ModuloAdmindatabase\VariableEstadisticaDimension;
use App\ModuloAdmindatabase\Valor;
use App\ModuloAdmindatabase\Validador;

class VariablesController extends Controller
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
    $validadores = Validador::get();
    $variables = VariableEstadistica::where('activo', true)->get();
    return view('ModuloAdmindatabase.validarvariables',['variables'=>$variables,'validadores'=>$validadores]);
  }
  public function listaDimensionesVarEstadistica(Request $request)
  {
    if($request->ajax()) {
      $dimension = VariableEstadisticaDimension::where('id_variable_estadistica',$request->id)->orderBy('id_dimension','DESC')->get();
        return \Response::json($dimension);
    }
  }


  public function validarCampoVarEstadistica(Request $request)
  {
    //ini_set('max_execution_time', 300);
    ini_set('max_execution_time', '-1');
    ini_set('memory_limit', '-1');



    if($request->ajax()) {
      $groupRef = "";
      $datoRef = "";
      $sw=0;
      if($request->campo_referencial_1 !=""){
        $groupRef .= $request->campo_referencial_1.", ";
        $datoRef = "v.".$request->campo_referencial_1." as origen_referencia,";
        $sw=1;
      }
      if($request->campo_referencial_2 !=""){
        $groupRef .= $request->campo_referencial_1.", ".$request->campo_referencial_2.", ";
        //$datoRef = "(v.".$request->campo_referencial_1."||'/'||v.".$request->campo_referencial_2.") as origen_referencia,";
        $datoRef = "v.".$request->campo_referencial_1.", v.".$request->campo_referencial_2.",";
        $sw=2;
      }


      $dimension = $request->dimension_campo_sel;
      $clasificadorSel = $request->clasificador;
      $sql = "SELECT ".$datoRef." v.".$dimension." as campo_original, 1 as suma,
      substr(v.".$dimension.",1,1) as letra
      FROM valores v
      WHERE v.id_variable = ?
      GROUP BY ".$groupRef." campo_original
      ORDER BY campo_original ASC";

      //$sql ="SELECT * FROM valores WHERE v.id_variable <> ?";
        $result = \DB::connection('dbestadistica')->select($sql, [$request->var_estadisica_sel]);
        $datosV = array();
        $i = 1;

        $campo_validado= "";
        $observaciones= "";
        $id_resultado= "";
        $nom_resultado= "";
        $origen_referencia ="";
        $i=1;
       foreach ($result as $r) {

           if($sw==1){

             $origen_referencia = $r->origen_referencia;
             $sql ="SELECT *
             FROM be_vista_".$clasificadorSel."
             WHERE substr(nombre_sinonimo,1,1) = ?
             AND nombre_sinonimo = ?
             AND padre = ?";
             $resultC = \DB::connection('dbestadistica')->select($sql, [$r->letra,trim(mb_strtoupper($r->campo_original,'utf-8')),trim(mb_strtoupper($r->origen_referencia,'utf-8'))]);

           }elseif($sw==2){

             $origen_referencia = $r->r_departamento."/".$r->r_provincia;

             $sql ="SELECT *
             FROM be_vista_".$clasificadorSel."
             WHERE substr(nombre_sinonimo,1,1) = ?
             AND nombre_sinonimo = ?
             AND padre = ?";
             $resultC = \DB::connection('dbestadistica')->select($sql, [$r->letra,trim(mb_strtoupper($r->campo_original,'utf-8')),trim(mb_strtoupper(($r->r_departamento."-".$r->r_provincia),'utf-8'))]);

           }elseif ($sw==0) {

             $sql ="SELECT *
             FROM be_vista_".$clasificadorSel."
             WHERE substr(nombre_sinonimo,1,1) = ?
             AND nombre_sinonimo = ?";
             $resultC = \DB::connection('dbestadistica')->select($sql, [$r->letra,trim(mb_strtoupper($r->campo_original,'utf-8'))]);

           }



                        $id_resultado="";
                        $nom_resultado ="";
                       if(count($resultC) == 1){
                          $campo_validado = "SI";
                          $observaciones = "Se encotro una coincidencia";
                                          // $conin = array();
                          foreach ($resultC as $res) {
                             $id_resultado = $res->id_oficial;
                             $nom_resultado = $res->nombre_oficial;
                          }
                       }elseif(count($resultC) == 0){
                          $campo_validado = "NO";
                          $observaciones = "No se encotraro coincidencia";

                       }elseif(count($resultC) > 1){
                         $campo_validado = "NO";
                         $observaciones = "Existe mas de una coincidencia";

                       }




                $datosV[$i] = array(
                          'id_valor' => $i,
                          'origen_referencia' => $origen_referencia,
                          'campo_original' => $r->campo_original,
                          'campo_validado' => $campo_validado,
                          'observaciones' => $observaciones,


                          'id_resultado' =>$id_resultado,
                          'nom_resultado' =>$nom_resultado,
                               //'suma' => $r->suma,
                          'clasificador' => $clasificadorSel,
                          'seleccion' => 0,
                          'dimension' => $dimension,
                          'variable' => $request->var_estadisica_sel
                );

                $i++;
          }
       //return array_values($datosV);
      return \Response::json(array_values($datosV));
    }
  }


  public function correctorCampoVarEstadistica(Request $request)
  {
    //ini_set('max_execution_time', 300);

    if($request->ajax()) {

       $sql ="SELECT *, nombre_completo as referencia
              FROM be_vista_".$request->clasificador."
              WHERE nombre_sinonimo = ?";
       $result= \DB::connection('dbestadistica')->select($sql, [trim(mb_strtoupper($request->campo,'utf-8'))]);


       //return array_values($datosV);
      return \Response::json(array_values($result));
    }
  }

  public function guardarValidacion(Request $request)
  {
    //ini_set('max_execution_time', 300);

    if($request->ajax()) {
      $oData = $request->data;

      $dimension = $request->dimension;
      $variable = $request->variable;

      foreach ($oData as $key => $value) {
        //dd($variable);
        $affectedRows = Valor::where($dimension, '=', $key)
                      ->where('id_variable', '=', $variable)
                      ->update([$dimension => $value]);
      }
      return \Response::json(1);
    }
  }





}
