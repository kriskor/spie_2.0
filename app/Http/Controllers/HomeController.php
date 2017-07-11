<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
       $sql = \DB::select("SELECT *
                          FROM users_modulos um
                          INNER JOIN modulos m ON um.id_modulo = m.id
                          WHERE um.id_user = ?
                          ORDER BY orden ASC", [\Auth::user()->id]);
        return view('home',['modulos' => $sql]);
    }
    public function modulos()
    {
        return view('modulos');
    }
}
