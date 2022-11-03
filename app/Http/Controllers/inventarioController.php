<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_inventario;
use App\Models\tbl_productos;
use Webpatser\Uuid\Uuid;
use DB;
use PDF;

class inventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return tbl_productos::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function postproducto($cantidad,$idproducto){
        //buscar producto
        $producto = tbl_productos::where('id', $idproducto)->get();
        
        $producto_nombre = $producto[0]->nombre;
        $producto_descripcion = $producto[0]->descripcion;
        
        //crear inventario
        for ($x = 0; $x < $cantidad; $x++) {
            $inventario = new tbl_inventario;
            $inventario->uuid = Uuid::generate()->string;
            $inventario->id_producto = $idproducto;
            $inventario->estado = 0;
            $inventario->save();
            $id_inventario = $inventario->id;
            $return = [
                "id" => $id_inventario,
                "nombre" => $producto_nombre,
                "descripcion" => $producto_descripcion 
            ];
            $barcode[] = $return;
        }
        
        return view('barcode', compact('barcode'));
        //print_r($producto);
        //return $producto[0]->id;
        //return $barcode;
    }

    public function pistolear($id){
        return tbl_inventario::where('id',$id)->update(['estado'=>'1']);
        
        //return 'pistolea3';
        //return $producto;
    }

    public function getpistolear($id){
        $inventario = tbl_inventario::where('id', $id)->get();
        $id_producto = $inventario[0]->id_producto;
        $producto_estado = $inventario[0]->estado;
        $producto_fecha = $inventario[0]->updated_at;

        $producto = tbl_productos::where('id', $id_producto)->get();
        
        $producto_nombre = $producto[0]->nombre;
        $producto_descripcion = $producto[0]->descripcion;

        $return = [
            "nombre" => $producto_nombre,
            "descripcion" => $producto_descripcion,
            "estado" => $producto_estado,
            "fecha" => $producto_fecha
        ];
        return $return;
    }

    public function productosall(){
        $results = DB::select( DB::raw("SELECT 
        nombre_producto,
        COUNT(if(estado_inventario = 0,1,null)) as 'stock',
        COUNT(if(estado_inventario = 1,1,null)) as 'despachado'
        FROM vw_inventario2
        GROUP BY nombre_producto WHERE marca='DRIMA'") );

        
        return $results;
    }

    public function postproducto2($cantidad,$producto){
        //buscar producto
        //$producto = tbl_producto::where('id', $producto)->get();
        //$id_producto = $producto->id;
        $id_producto = $producto;
        
        //crear inventario
        for ($x = 0; $x < $cantidad; $x++) {
            $inventario = new tbl_inventario;
            $inventario->uuid = Uuid::generate()->string;
            $inventario->id_producto = $id_producto;
            $inventario->estado = 0;
            $inventario->save();
            $id_inventario = $inventario->uuid;
            $barcode[] = $id_inventario;
        }

        return view('barcode', compact('barcode'));
        //print_r($barcode);
    }

    public function pdf($cantidad,$idproducto,$tipo_empresa){

        $producto = tbl_productos::where('id', $idproducto)->get();
        
        $producto_nombre = $producto[0]->title;
        $producto_descripcion = $producto[0]->descripcion;
        
        //crear inventario
        for ($x = 0; $x < $cantidad; $x++) {
            $inventario = new tbl_inventario;
            $inventario->uuid = Uuid::generate()->string;
            $inventario->id_producto = $idproducto;
            $inventario->estado = 0;
            $inventario->save();
            $id_inventario = $inventario->id;
            $return = [
                "id" => $id_inventario,
                "nombre" => $producto_nombre,
                "descripcion" => $producto_descripcion 
            ];
            $barcode[] = $return;
        }
        
        $view = view('etiquetapdf', compact('barcode'));
        //$view = view('pdfview')->render();
        //$pdf = PDF::loadHTML($view)->setPaper('a4');
        $pdf = PDF::loadHTML($view)->setPaper('a4')
                            ;
                            
        return $pdf->stream('archivo.pdf');

        /*
        $view = view('etiquetapdf', compact('barcode'));
        //$view = view('pdfview')->render();
        //$pdf = PDF::loadHTML($view)->setPaper('a4');
        $pdf = PDF::loadHTML($view)->setPaper('a4')
                            ->setOption('page-width', '40')
                            ->setOption('page-height', '60');
                            
        return $pdf->stream('archivo.pdf');
        */

        
        
        /*
        $view = view('etiquetapdf')->render();
        //$view = view('pdfview')->render();
        $pdf = PDF::loadHTML($view)->setPaper('a4');
        return $pdf->stream('archivo.pdf');
        */
    }
}
