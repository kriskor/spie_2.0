<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/modulos', 'HomeController@modulos');

Route::get('/indicadores/dashboard', 'ModuloIndicadores\DashboardController@index');
Route::get('/indicadores/catalogo', 'ModuloIndicadores\CatalogoController@index');







//dashboard

Route::post('/moduloindicadores/ajax/listaindicadorespilares', 'ModuloIndicadores\DashboardController@listaIndicadoresPilares');
Route::post('/moduloindicadores/ajax/listapuntomedicion', 'ModuloIndicadores\DashboardController@listaPuntoMedicion');
Route::get('/moduloindicadores/ajax/listapilarpuntomedicion', 'ModuloIndicadores\DashboardController@listaPilarPuntoMedicion');




Route::get('/moduloindicadores/ajax/listarpilares', 'ModuloIndicadores\CatalogoController@listarPilares');
Route::get('/moduloindicadores/ajax/listarmetas', 'ModuloIndicadores\CatalogoController@listarMetas');
Route::get('/moduloindicadores/ajax/listarresultados', 'ModuloIndicadores\CatalogoController@listarResultados');

Route::get('/moduloindicadores/ajax/listarresultadosall', 'ModuloIndicadores\CatalogoController@listarResultadosAll');
Route::get('/moduloindicadores/ajax/listarresultadospriorizados', 'ModuloIndicadores\CatalogoController@listarResultadosPriorizados');

Route::post('/moduloindicadores/ajax/listaresultadomedidasindicador', 'ModuloIndicadores\CatalogoController@listaResultadoMedidasIndicador');


Route::get('/moduloindicadores/ajax/listaclasificacionresultado', 'ModuloIndicadores\CatalogoController@listaClasificacionResultado');
Route::get('/moduloindicadores/ajax/listarresultadosallclasificados', 'ModuloIndicadores\CatalogoController@listarResultadosAllClasificados');

Route::get('/moduloindicadores/ajax/datospilar', 'ModuloIndicadores\CatalogoController@datosPilar');
Route::get('/moduloindicadores/ajax/datosmeta', 'ModuloIndicadores\CatalogoController@datosMeta');
Route::get('/moduloindicadores/ajax/datosresultado', 'ModuloIndicadores\CatalogoController@datosResultado');
Route::post('/moduloindicadores/ajax/datosindicador', 'ModuloIndicadores\CatalogoController@datosIndicador');
Route::post('/moduloindicadores/ajax/datoscatalogoindicador', 'ModuloIndicadores\CatalogoController@datosCatalogoIndicador');

//abm_indicadores
Route::post('/moduloindicadores/ajax/guardarindicador', 'ModuloIndicadores\CatalogoController@guardarIndicador');
Route::post('/moduloindicadores/ajax/modificarindicador', 'ModuloIndicadores\CatalogoController@modificarIndicador');
Route::delete('/moduloindicadores/ajax/eliminarindicador', 'ModuloIndicadores\CatalogoController@eliminarIndicador');




Route::get('/moduloindicadores/ajax/listaindicadores', 'ModuloIndicadores\CatalogoController@listaIndicadores');
Route::get('/moduloindicadores/ajax/autocompletarindicadores', 'ModuloIndicadores\CatalogoController@autocompletarIndicadores');






///CLASIFICADORES
//-------ENTIDADES
Route::get('/admindatabase/dashboard', 'ModuloAdmindatabase\DashboardController@index');
Route::get('/admindatabase/entidades', 'ModuloAdmindatabase\EntidadesController@index');
Route::get('/admindatabase/regiones', 'ModuloAdmindatabase\RegionesController@index');
Route::get('/admindatabase/otros', 'ModuloAdmindatabase\OtrosController@index');
Route::get('/admindatabase/crearvalidadores', 'ModuloAdmindatabase\ClasificadoresController@crearValidadores');
Route::get('/admindatabase/paises', 'ModuloAdmindatabase\PaisesController@index');




//ABM
Route::post('/admindatabase/ajax/guardarEntidad', 'ModuloAdmindatabase\EntidadesController@store');
Route::post('/admindatabase/ajax/modificarentidad', 'ModuloAdmindatabase\EntidadesController@modificarEntidad');
Route::delete('/admindatabase/ajax/eliminarentidad', 'ModuloAdmindatabase\EntidadesController@eliminarEntidad');

Route::post('/admindatabase/ajax/detalleentidad', 'ModuloAdmindatabase\EntidadesController@detalleEntidad');


Route::get('/admindatabase/ajax/listaentidades', 'ModuloAdmindatabase\EntidadesController@listaClasificadorEntidades');
Route::get('/admindatabase/ajax/listasinonimosentidad', 'ModuloAdmindatabase\EntidadesController@listasinonimosentidad');
Route::post('/admindatabase/ajax/addsinonimo', 'ModuloAdmindatabase\EntidadesController@addSinonimoEntidad');
Route::put('/admindatabase/ajax/updatesinonimo', 'ModuloAdmindatabase\EntidadesController@updateSinonimoEntidad');
Route::delete('/admindatabase/ajax/deletesinonimo', 'ModuloAdmindatabase\EntidadesController@deleteSinonimoEntidad');


Route::post('/admindatabase/guardarvalidador', 'ModuloAdmindatabase\ClasificadoresController@guardarNuevoValidador');
Route::get('/admindatabase/eliminarvalidador/{id}', 'ModuloAdmindatabase\ClasificadoresController@eliminarValidador');

//-------REGIONES

Route::get('/admindatabase/ajax/listaclasificadorregiones', 'ModuloAdmindatabase\RegionesController@listaClasificadorRegiones');

Route::post('/admindatabase/ajax/detalleregion', 'ModuloAdmindatabase\RegionesController@detalleRegion');

/////ABM
Route::post('/admindatabase/ajax/guardarRegion', 'ModuloAdmindatabase\RegionesController@store');
Route::put('/admindatabase/ajax/modificarregion', 'ModuloAdmindatabase\RegionesController@modificarRegion');

Route::delete('/admindatabase/ajax/eliminarregion', 'ModuloAdmindatabase\RegionesController@eliminarRegion');

Route::get('/admindatabase/ajax/listasinonimosregion', 'ModuloAdmindatabase\RegionesController@listaSinonimosRegion');
Route::post('/admindatabase/ajax/addsinonimoregion', 'ModuloAdmindatabase\RegionesController@addSinonimoRegion');
Route::put('/admindatabase/ajax/updatesinonimoregion', 'ModuloAdmindatabase\RegionesController@updateSinonimoRegion');
Route::delete('/admindatabase/ajax/deletesinonimoregion', 'ModuloAdmindatabase\RegionesController@deleteSinonimoRegion');

Route::get('/admindatabase/ajax/regionesseleccionadas', 'ModuloAdmindatabase\RegionesController@regionesSeleccionadas');


//////////////------otros

Route::get('/admindatabase/ajax/listaotros', 'ModuloAdmindatabase\OtrosController@listaClasificadorOtros');
Route::post('/admindatabase/ajax/addotro', 'ModuloAdmindatabase\OtrosController@store');
Route::put('/admindatabase/ajax/updateotro', 'ModuloAdmindatabase\OtrosController@update');
Route::delete('/admindatabase/ajax/deleteotro', 'ModuloAdmindatabase\OtrosController@destroy');

Route::get('/admindatabase/ajax/listasinonimosotro', 'ModuloAdmindatabase\OtrosController@listaSinonimosOtro');
Route::post('/admindatabase/ajax/addsinonimootro', 'ModuloAdmindatabase\OtrosController@addSinonimoOtro');
Route::put('/admindatabase/ajax/updatesinonimootro', 'ModuloAdmindatabase\OtrosController@updateSinonimoOtro');
Route::delete('/admindatabase/ajax/deletesinonimootro', 'ModuloAdmindatabase\OtrosController@deleteSinonimoOtro');


///---------------------Paises
Route::get('/admindatabase/ajax/listapaises', 'ModuloAdmindatabase\PaisesController@listaPaises');
Route::get('/admindatabase/ajax/listasinonimospais', 'ModuloAdmindatabase\PaisesController@listaSinonimosPais');
Route::post('/admindatabase/ajax/addsinonimo', 'ModuloAdmindatabase\PaisesController@addSinonimoPais');
Route::put('/admindatabase/ajax/updatesinonimo', 'ModuloAdmindatabase\PaisesController@updateSinonimoPais');
Route::delete('/admindatabase/ajax/deletesinonimo', 'ModuloAdmindatabase\PaisesController@deleteSinonimoPais');
Route::post('/admindatabase/ajax/detallepais', 'ModuloAdmindatabase\PaisesController@detallePais');


Route::post('/admindatabase/ajax/guardarpais', 'ModuloAdmindatabase\PaisesController@store');
Route::post('/admindatabase/ajax/modificarpais', 'ModuloAdmindatabase\PaisesController@modificarPais');
Route::delete('/admindatabase/ajax/eliminarpais', 'ModuloAdmindatabase\PaisesController@eliminarPais');


//////////-------------VARIABLES ESTADISTICAS

Route::get('/admindatabase/validarvariables', 'ModuloAdmindatabase\VariablesController@index');
Route::get('/admindatabase/ajax/listadimensionesvarestadisica', 'ModuloAdmindatabase\VariablesController@listaDimensionesVarEstadistica');
Route::get('/admindatabase/ajax/validando_campo_var_estadistica', 'ModuloAdmindatabase\VariablesController@validarCampoVarEstadistica');
Route::get('/admindatabase/ajax/corrector_campo_var_estadistica', 'ModuloAdmindatabase\VariablesController@correctorCampoVarEstadistica');
Route::post('/admindatabase/ajax/guardar_validacion', 'ModuloAdmindatabase\VariablesController@guardarValidacion');


Route::group(
    array('prefix' => 'subsistemaplanificacion'),
    function() {
            Route::get('dashboard', 'SubsistemaPlanificacion\DashboardController@index');
            Route::get('planesterritoriales', 'SubsistemaPlanificacion\PlanesController@entidadesTerritoriales');
            Route::get('planessectoriales', 'SubsistemaPlanificacion\PlanesController@entidadesSectoriales');
            Route::get('articulacion/{id}', 'SubsistemaPlanificacion\PlanesController@articulacionPlanTerritorial');
            Route::get('programamefpdes', 'SubsistemaPlanificacion\ConfiguracionController@programaMefPdes');



    }
);
Route::group(
    array('prefix' => 'subsistemaplanificacion/ajax'),
    function() {
            Route::get('listaentidadesterritoriales', 'SubsistemaPlanificacion\PlanesController@listaEntidadesTerritoriales');
            Route::get('listaentidadessectoriales', 'SubsistemaPlanificacion\PlanesController@listaEntidadesSectoriales');
            Route::get('listaarticulacion', 'SubsistemaPlanificacion\PlanesController@articulacionEntidad');
            Route::get('listarpilares', 'SubsistemaPlanificacion\PlanesController@listarPilares');
            Route::get('listarmetas', 'SubsistemaPlanificacion\PlanesController@listarMetas');
            Route::get('listarresultados', 'SubsistemaPlanificacion\PlanesController@listarResultados');
            Route::get('listaracciones', 'SubsistemaPlanificacion\PlanesController@listarAcciones');
            Route::post('guardararticulacion', 'SubsistemaPlanificacion\PlanesController@guardarArticulacion');
            Route::delete('eliminararticulacion', 'SubsistemaPlanificacion\PlanesController@eliminarArticulacion');
            Route::post('guardararplan', 'SubsistemaPlanificacion\PlanesController@guardarPlan');
            Route::post('listaplanesarticulacion', 'SubsistemaPlanificacion\PlanesController@listaPlanesArticulacion');
            Route::post('listaplanesarticulacionhijos', 'SubsistemaPlanificacion\PlanesController@listaPlanesArticulacionHijos');
            Route::post('eliminarplan', 'SubsistemaPlanificacion\PlanesController@eliminarPlan');
            Route::post('modificaplangeneral', 'SubsistemaPlanificacion\PlanesController@modificaPlanGeneral');
            Route::post('mostrarPlanGeneral', 'SubsistemaPlanificacion\PlanesController@mostrarPlanGeneral');
            Route::post('mostrarPlanPresupuesto', 'SubsistemaPlanificacion\PlanesController@mostrarPlanPresupuesto');
            Route::post('modificarPlanPresupuesto', 'SubsistemaPlanificacion\PlanesController@modificarPlanPresupuesto');
            Route::get('listaProgramasMef', 'SubsistemaPlanificacion\ConfiguracionController@listaProgramasMef');
            Route::post('guardararticulacionprograma', 'SubsistemaPlanificacion\ConfiguracionController@guardarArticulacionPrograma');
            Route::get('listaalineacionprogramas', 'SubsistemaPlanificacion\ConfiguracionController@listaAlineacionProgramas');
            Route::post('guardararnuevoprograma', 'SubsistemaPlanificacion\ConfiguracionController@guardararNuevoPrograma');
            Route::post('datosprogramamef', 'SubsistemaPlanificacion\ConfiguracionController@datosProgramaMef');
            Route::post('modificarprograma', 'SubsistemaPlanificacion\ConfiguracionController@modificarPrograma');
            Route::delete('eliminarprogramamef', 'SubsistemaPlanificacion\ConfiguracionController@eliminarProgramaMef');
            Route::delete('eliminararticulacionprogramapdes', 'SubsistemaPlanificacion\ConfiguracionController@eliminarArticulacionProgramaPDES');
            Route::post('actualizarProgramasSugeridos', 'SubsistemaPlanificacion\PlanesController@actualizarProgramasSugeridos');
            Route::get('cargarindicadorprocesoplantilla', 'SubsistemaPlanificacion\PlanesController@cargarindIcadorProcesoPlantilla');


    }
);
