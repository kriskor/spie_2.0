<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenusController extends Controller
{
  public function menuTop()
  {
    $modulo = 1;
     $sql = \DB::select("SELECT m.*
                        FROM menus m
                        INNER JOIN roles_menu rm ON m.id = rm.id_menu
                        WHERE rm.id_rol = ?
                        AND id_modulo = ?
                        ORDER BY m.orden ASC", [\Auth::user()->id_rol,$modulo]);
      //return view('home',['modulos' => $sql]);

      return $sql;
  }
  public function modulos()
  {
      return view('modulos');
  }
}
