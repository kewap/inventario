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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function pistolear(){
        return view('zonapistola');
    }

    public function producto(){
        return view('producto');
    }

    public function inventariofull(){
        return view('inventario');
    }

    public function inventariofullfabricalonline(){
        return view('fabricalonline');
    }

    public function despachodrima(){
        return view('despachodrima');
    }

    public function despachofabricalonline(){
        return view('despachofabricalonline');
    }

    public function despachomercadolibre(){
        return view('despachomercadolibre');
    }

    public function despachofalabella(){
        return view('despachofalabella');
    }

    public function agregararticulo(){
        return view('articulo');
    }
}
