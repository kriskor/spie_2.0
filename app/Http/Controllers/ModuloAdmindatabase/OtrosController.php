<?php

namespace App\Http\Controllers\ModuloAdmindatabase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ModuloAdmindatabase\OtroSinonimo;
use App\ModuloAdmindatabase\Otro;

class OtrosController extends Controller
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
    return view('ModuloAdmindatabase.otros');
  }

  public function store(Request $request)
  {
    if($request->ajax()) {
      $otro = new Otro();
      $otro->nombre = "";
      $otro->descripcion = "";
      $otro->activo = true;
      $otro->save();
      return \Response::json($otro->id);
    }
  }

  public function update(Request $request)
  {
    if($request->ajax()) {
      $otro = Otro::find($request->id) ;

      if($otro->nombre == ""){
        $sinonimo = new OtroSinonimo;
        $sinonimo->sinonimo =$request->nombre;
        $sinonimo->id_otro = $request->id;
        $sinonimo->save();
      }

      $otro->nombre = $request->nombre;
      $otro->descripcion = $request->descripcion;
      $otro->save();



      return \Response::json(1);
    }
  }

  public function destroy(Request $request)
  {
    if($request->ajax()) {
         $otro = Otro::find($request->id);
         $otro->activo = false;
         $otro->save();
         return \Response::json(1);

     }
  }
  public function listaClasificadorOtros()
  {
    $otros = Otro::where('activo', true)->orderBy('id','DESC')->get();
    return json_encode($otros);
  }
  public function listaSinonimosOtro(Request $request)
  {

    if($request->ajax()) {
        $sinonimosOtro = OtroSinonimo::where('id_otro','=' ,$request->get('id'))->orderBy('id','DESC')->get();
        return \Response::json($sinonimosOtro);
    }


  }
  public function addSinonimoOtro(Request $request)
  {

     if($request->ajax()) {
          $sinonimo = new OtroSinonimo;
          $sinonimo->sinonimo ="Registrar sinonimo";
          $sinonimo->id_otro = $request->id_otro;
          $sinonimo->save();
          return \Response::json($sinonimo->id);
      }
  }

  public function updateSinonimoOtro(Request $request)
  {

   if($request->ajax()) {
        $sinonimo = OtroSinonimo::find($request->id);
        $sinonimo->sinonimo = strtoupper($request->sinonimo);
        $sinonimo->id_otro = $request->id_otro;
        $sinonimo->save();
        return \Response::json(1);

    }
  }

  public function deleteSinonimoOtro(Request $request){

   if($request->ajax()) {
        $sinonimo = OtroSinonimo::find($request->id);
        $sinonimo->delete();
        return \Response::json(1);

    }
  }






}
