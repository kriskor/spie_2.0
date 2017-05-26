<?php

namespace App\Http\Controllers\ModuloIndicadores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    return view('ModuloIndicadores.dashboard');
  }

  public function listaIndicadoresPilares(Request $request)
  {


    if($request->ajax()) {
          $listaIP = \DB::connection('dbestadistica')
                    ->select("SELECT p.cod_p,(p.nombre||': '||p.descripcion) as nombre,count(i.id_indicador) as total
                                  FROM pilares p
                                  LEFT JOIN metas m ON p.id = m.pilar
                                  LEFT JOIN resultados r ON m.id = r.meta
                                  LEFT JOIN resultado_indicadores ri ON r.id = ri.id_resultado
                                  LEFT JOIN indicadores i ON (ri.id_indicador = i.id_indicador AND i.estado = true)

                                  GROUP BY p.cod_p,p.nombre,p.descripcion
                                  ORDER BY p.cod_p ASC");
        return \Response::json($listaIP);
     }

  }

  public function listaPuntoMedicion(Request $request)
  {

    if($request->ajax()) {
          $listaPM = \DB::connection('dbestadistica')
                    ->select("SELECT ri.punto_medicion as nombre,count(i.id_indicador) as total
                                  FROM pilares p
                                  LEFT JOIN metas m ON p.id = m.pilar
                                  LEFT JOIN resultados r ON m.id = r.meta
                                  LEFT JOIN resultado_indicadores ri ON r.id = ri.id_resultado
                                  LEFT JOIN indicadores i ON ri.id_indicador = i.id_indicador
                                  WHERE ri.punto_medicion is not null
                                  AND i.estado = true
                                  GROUP BY ri.punto_medicion
                                  ORDER BY ri.punto_medicion ASC");
          $data = array();
          foreach ($listaPM as $t) {
              $data['total'][$t->nombre] = (int) $t->total;
              $data['pilar'][$t->nombre] = $t->nombre;
          }
          $datos = array(
              'total' => array_values($data['total']),
              'pilar' => array_values($data['pilar'])
          );
        //  echo json_encode($datos);
        return \Response::json($datos);
     }

  }

  public function listaPilarPuntoMedicion(Request $request)
  {

    if($request->ajax()) {
          $listaPPM = \DB::connection('dbestadistica')
                      ->select("SELECT tab.cod_p,
                                  tab.nombre,
                                  (
                                  	SELECT count(*) as total
                                  	FROM resultado_indicadores cri
                                    INNER JOIN indicadores i ON cri.id_indicador = i.id_indicador
                                  	INNER JOIN resultados cr ON cri.id_resultado = cr.id
                                  	INNER JOIN metas cm ON cr.meta = cm.id
                                  	INNER JOIN pilares cp ON cm.pilar = cp.id
                                  	WHERE cp.cod_p = tab.cod_p
                                    AND i.estado = true
                                  	AND cri.punto_medicion = 'Proceso'
                                  ) as proceso,
                                  (
                                  	SELECT count(*) as total
                                  	FROM resultado_indicadores cri
                                    INNER JOIN indicadores i ON cri.id_indicador = i.id_indicador
                                  	INNER JOIN resultados cr ON cri.id_resultado = cr.id
                                  	INNER JOIN metas cm ON cr.meta = cm.id
                                  	INNER JOIN pilares cp ON cm.pilar = cp.id
                                  	WHERE cp.cod_p = tab.cod_p
                                  	AND i.estado = true
                                    AND cri.punto_medicion = 'Producto'
                                  ) as producto,
                                  (
                                  	SELECT count(*) as total
                                  	FROM resultado_indicadores cri
                                    INNER JOIN indicadores i ON cri.id_indicador = i.id_indicador
                                  	INNER JOIN resultados cr ON cri.id_resultado = cr.id
                                  	INNER JOIN metas cm ON cr.meta = cm.id
                                  	INNER JOIN pilares cp ON cm.pilar = cp.id
                                  	WHERE cp.cod_p = tab.cod_p
                                    AND i.estado = true
                                  	AND cri.punto_medicion = 'Resultado'
                                  ) as resultado
                                  FROM(

                                  SELECT p.cod_p,p.nombre
                                  FROM pilares p
                                  GROUP BY p.cod_p,p.nombre
                                  ORDER BY p.cod_p ASC
                                  ) as tab");
        return \Response::json($listaPPM);
     }

  }


}
