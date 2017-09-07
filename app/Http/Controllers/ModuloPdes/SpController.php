<?php

namespace App\Http\Controllers\ModuloPdes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpController extends Controller
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
  public function entidadesPorPilar()
  {
    return view('ModuloPdes.entidades_pilares');
  }

  public function totalPilaresEntidades(Request $request)
  {
   if($request->ajax()) {
        $datosP = \DB::connection('dbsp')
                  ->select("SELECT tabla.id_pilar,
                            tabla.pilar,
                            (
                            	SELECT COUNT(*) as total
                            	FROM vista_pilar_entidad vpe
                            	WHERE vpe.id_pilar = tabla.id_pilar
                            ) as valor
                            FROM(
                            	SELECT id_pilar, pilar
                            	FROM vista_pilar_meta_resultado_accion vpmra
                            	GROUP BY vpmra.id_pilar, vpmra.pilar
                            	ORDER BY vpmra.cod_p ASC
                            ) as tabla"

                          );

        // $datosP = \DB::connection('dbsp')
        //           ->select("");

       return \Response::json($datosP);
    }
  }

  public function listaPilaresEntidades(Request $request)
  {
   if($request->ajax()) {
        $datosP = \DB::connection('dbsp')
                  ->select("SELECT *
                            FROM vista_pilar_entidad");
       return \Response::json($datosP);
    }
  }


  public function entidadesPorMeta()
  {
    return view('ModuloPdes.entidades_metas');
  }

  public function listaMetasEntidades(Request $request)
  {
   if($request->ajax()) {
        $datosM = \DB::connection('dbsp')
                  ->select("SELECT *,CONCAT(sigla_p,'.',sigla_m) as codigo
                            FROM vista_meta_entidad");
       return \Response::json($datosM);
    }
  }

  public function totalMetasEntidades(Request $request)
  {
   if($request->ajax()) {
        $datosM = \DB::connection('dbsp')
                  ->select("SELECT tabla.id_pilar,
                            tabla.pilar,
                            tabla.id_meta,
                            tabla.meta,
                            CONCAT(tabla.sigla_p,'.',tabla.sigla_m) as codigo,
                            (
                            	SELECT COUNT(*) as total
                            	FROM vista_meta_entidad vpe
                            	WHERE vpe.id_meta = tabla.id_meta
                            ) as valor
                            FROM(
                            	SELECT id_pilar, pilar,sigla_p,id_meta,meta,sigla_m
                            	FROM vista_pilar_meta_resultado_accion vpmra
                            	GROUP BY vpmra.id_pilar, vpmra.pilar,vpmra.sigla_p,vpmra.id_meta,vpmra.meta,vpmra.sigla_m
                            	ORDER BY vpmra.cod_p,vpmra.cod_m ASC
                            ) as tabla"
                          );

        // $datosP = \DB::connection('dbsp')
        //           ->select("");

       return \Response::json($datosM);
    }
  }

  public function entidadesPorResultado()
  {
    return view('ModuloPdes.entidades_resultados');
  }


  public function listaResultadosEntidades(Request $request)
  {
   if($request->ajax()) {
        $datosR = \DB::connection('dbsp')
                  ->select("SELECT *,CONCAT(sigla_p,'.',sigla_m,'.',sigla_r) as codigo
                            FROM vista_resultado_entidad");
       return \Response::json($datosR);
    }
  }

  public function totalResultadosEntidades(Request $request)
  {
   if($request->ajax()) {
        // $datosR = \DB::connection('dbsp')
        //           ->select("SELECT tabla.id_pilar,
        //                     tabla.pilar,
        //                     tabla.id_meta,
        //                     tabla.meta,
        //                     tabla.id_resultado,
        //                     tabla.resultado,
        //                     CONCAT(tabla.sigla_p,'.',tabla.sigla_m,'.',tabla.sigla_r) as codigo,
        //                     (
        //                     	SELECT COUNT(*) as total
        //                     	FROM vista_resultado_entidad vpe
        //                     	WHERE vpe.id_resultado = tabla.id_resultado
        //                     ) as valor
        //                     FROM(
        //                     	SELECT id_pilar, pilar,sigla_p,id_meta,meta,sigla_m,id_resultado,resultado,sigla_r
        //                     	FROM vista_pilar_meta_resultado_accion vpmra
        //                     	GROUP BY vpmra.id_pilar, vpmra.pilar,vpmra.sigla_p,vpmra.id_meta,vpmra.meta,vpmra.sigla_m,vpmra.id_resultado,vpmra.resultado
        //                     	ORDER BY vpmra.cod_p,vpmra.cod_m,vpmra.cod_r ASC
        //                     ) as tabla"
        //                   );

        $datosR = \DB::connection('dbsp')
                  ->select("SELECT
                            CONCAT(tabla.sigla_p,'.',tabla.sigla_m,'.',tabla.sigla_r) as codigo,
                            (
                            	SELECT COUNT(*) as total
                            	FROM vista_resultado_entidad vpe
                            	WHERE vpe.id_resultado = tabla.id_resultado
                            ) as valor
                            FROM(
                            	SELECT sigla_p,sigla_m,sigla_r,id_resultado
                            	FROM vista_pilar_meta_resultado_accion vpmra
                            	GROUP BY vpmra.sigla_p,vpmra.sigla_m,vpmra.sigla_r,id_resultado
                            	ORDER BY vpmra.cod_p,vpmra.cod_m,vpmra.cod_r ASC
                            ) as tabla");
       return \Response::json($datosR);
    }
  }


  public function detalleEntidad()
  {
    $datosE = \DB::connection('dbsp')
            ->select("SELECT *
                      FROM entidad
                      WHERE tipo IN (1,2)
                      ORDER BY codigo ASC");
    return view('ModuloPdes.detalle_entidad',['entidades' => $datosE]);
  }


  public function graficaEntidadPilares(Request $request)
  {
   if($request->ajax()) {
        $detalleEP = \DB::connection('dbsp')
                  ->select("SELECT v.pilar,COUNT(a.id) as valor
                            FROM accion a
                            INNER JOIN vista_pilar_meta_resultado_accion v ON a.accion = v.id_accion
                            WHERE a.estado = 1
                            AND a.entidad = ?
                            AND a.tipo = 1
                            GROUP BY v.pilar
                            ORDER BY v.cod_p ASC",[$request->get('entidad')]);
       return \Response::json($detalleEP);
    }
  }


  public function graficaEntidadMetas(Request $request)
  {
   if($request->ajax()) {
        $detalleEP = \DB::connection('dbsp')
                  ->select("SELECT sigla_p,sigla_m, COUNT(a.id) as valor
                            FROM accion a
                            INNER JOIN vista_pilar_meta_resultado_accion v ON a.accion = v.id_accion
                            WHERE a.estado = 1
                            AND a.entidad = ?
                            AND a.tipo = 1
                            GROUP BY v.sigla_p, v.sigla_m
                            ORDER BY v.cod_p, v.cod_m ASC",[$request->get('entidad')]);
       return \Response::json($detalleEP);
    }
  }

  public function graficaEntidadResultados(Request $request)
  {
   if($request->ajax()) {
        $detalleEP = \DB::connection('dbsp')
                  ->select("SELECT sigla_p,sigla_m,sigla_r, COUNT(a.id) as valor
                            FROM accion a
                            INNER JOIN vista_pilar_meta_resultado_accion v ON a.accion = v.id_accion
                            WHERE a.estado = 1
                            AND a.entidad = ?
                            AND a.tipo = 1
                            GROUP BY v.sigla_p, v.sigla_m, v.sigla_r
                            ORDER BY v.cod_p, v.cod_m, v.cod_r ASC",[$request->get('entidad')]);
       return \Response::json($detalleEP);
    }
  }


  public function detalleSubentidad(Request $request)
  {
   if($request->ajax()) {

        switch ($request->get('opcion')) {
          case 2:
            # code...
            break;
          case 3:
            # code...
            break;
          default:
          $detalleEP = \DB::connection('dbsp')
                        ->select("SELECT vg.sigla_p as codigo, e.nombre as entidad, se.nombre as subentidad
                                  FROM accion a
                                  INNER JOIN vista_pilar_meta_resultado_accion vg ON a.accion = vg.id_accion
                                  INNER JOIN entidad_responsable er ON a.id = er.accion
                                  INNER JOIN sub_entidad se ON er.entidad_responsable = se.id
                                  INNER JOIN entidad e ON se.entidad = e.id
                                  WHERE a.estado = 1
                                  AND e.id = ?
                                  AND a.tipo <> 1
                                  GROUP BY codigo, e.nombre, se.nombre
                                  ORDER BY codigo, e.nombre,se.nombre ASC",[$request->get('entidad')]);
            break;
        }

       return \Response::json($detalleEP);
    }
  }



}
