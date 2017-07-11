<?php

namespace App\Http\Controllers\SubsistemaPlanificacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $user;
    public $menus;

    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
        $this->user= \Auth::user();
        $rol = (int) $this->user->id_rol;
        $sql = \DB::select("SELECT m.* FROM menus m INNER JOIN roles_menu rm ON m.id = rm.id_menu WHERE rm.id_rol = ".$rol." AND id_modulo = 1 ORDER BY m.orden ASC");
        $this->menus = array();
        foreach ($sql as $mn) {

            $submenu = \DB::select("SELECT * FROM sub_menus WHERE id_menu = ".$mn->id." ORDER BY orden ASC");
            array_push($this->menus, array('id' => $mn->id,'titulo' => $mn->titulo,'descripcion' => $mn->descripcion,'url' => $mn->url,'icono' => $mn->icono,'id_html' => $mn->id_html,'submenus' => $submenu));
        }
        //dd($this->menus);
        \View::share([ 'menu'=> $this->menus ]);

        return $next($request);

        });

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('SubsistemaPlanificacion.dashboard');
    }

}
