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
        $marca = $producto[0]->marca;
        
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
                "nombre" => $marca,
                "descripcion" => $producto_descripcion 
            ];
            $barcode[] = $return;
        }
        
        return view('barcode', compact('barcode'));
        //print_r($producto);
        //return $producto[0]->id;
        //return $barcode;
    }

    public function pistolear($id,$plataforma){
        return tbl_inventario::where('id',$id)->update(['estado'=>'1','plataforma'=>$plataforma]);
        
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
        WHERE marca='DRIMA' 
        GROUP BY nombre_producto") );

        
        return $results;
    }

    public function productosallfabricalonline(){
        $results = DB::select( DB::raw("SELECT 
        nombre_producto,
        COUNT(if(estado_inventario = 0,1,null)) as 'stock',
        COUNT(if(estado_inventario = 1,1,null)) as 'despachado'
        FROM vw_inventario2
        WHERE marca='FABRICALONLINE' 
        GROUP BY nombre_producto") );

        
        return $results;
    }

    public function productosallmercadolibre(){
        $results = DB::select( DB::raw("SELECT 
        nombre_producto,
        COUNT(if(estado_inventario = 0,1,null)) as 'stock',
        COUNT(if(estado_inventario = 1,1,null)) as 'despachado'
        FROM vw_inventario2
        WHERE marca='MERCADOLIBRE' 
        GROUP BY nombre_producto") );

        
        return $results;
    }

    public function productosallfalabella(){
        $results = DB::select( DB::raw("SELECT 
        nombre_producto,
        COUNT(if(estado_inventario = 0,1,null)) as 'stock',
        COUNT(if(estado_inventario = 1,1,null)) as 'despachado'
        FROM vw_inventario2
        WHERE marca='FALABELLA' 
        GROUP BY nombre_producto") );

        
        return $results;
    }

    public function getdespachodrima(){
        $results = DB::select( DB::raw("SELECT id_inventario,nombre_producto,plataforma,marca,updated_at FROM `vw_inventario2` WHERE estado_inventario = 1 AND plataforma='DRIMA'") );

        
        return $results;
    }

    public function getdespachofabricalonline(){
        $results = DB::select( DB::raw("SELECT id_inventario,nombre_producto,plataforma,marca,updated_at FROM `vw_inventario2` WHERE estado_inventario = 1 AND plataforma='FABRICALONLINE'") );

        
        return $results;
    }

    public function getdespachomercadolibre(){
        $results = DB::select( DB::raw("SELECT id_inventario,nombre_producto,plataforma,marca,updated_at FROM `vw_inventario2` WHERE estado_inventario = 1 AND plataforma='MERCADOLIBRE'") );

        
        return $results;
    }

    public function getdespachofalabella(){
        $results = DB::select( DB::raw("SELECT id_inventario,nombre_producto,plataforma,marca,updated_at FROM `vw_inventario2` WHERE estado_inventario = 1 AND plataforma='FALABELLA'") );

        
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

    public function pdf($cantidad,$idproducto){

        $producto = tbl_productos::where('id', $idproducto)->get();
        
        $producto_nombre = $producto[0]->title;
        $producto_descripcion = $producto[0]->descripcion;
        $marca = $producto[0]->marca;
        
        //crear inventario
        for ($x = 0; $x < $cantidad; $x++) {
            $inventario = new tbl_inventario;
            $inventario->uuid = Uuid::generate()->string;
            $inventario->id_producto = $idproducto;
            $inventario->estado = 0;
            $inventario->plataforma = $marca;
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

    public function postarticulo($nombre_producto,$marca,$titulo_etiqueta,$descripcion_etiqueta){

        $articulo = new tbl_productos;
        $articulo->uuid = Uuid::generate()->string;
        $articulo->nombre = $nombre_producto;
        $articulo->descripcion = $descripcion_etiqueta;
        $articulo->title = $titulo_etiqueta;
        $articulo->marca = $marca;
        $articulo->save();
        return $id = $articulo->id;

    }

    public function postarticulodirecto($nombre_producto,$marca,$titulo_etiqueta,$descripcion_etiqueta,$destino){

        $articulo = new tbl_productos;
        $articulo->uuid = Uuid::generate()->string;
        $articulo->nombre = $nombre_producto;
        $articulo->descripcion = $descripcion_etiqueta;
        $articulo->title = $titulo_etiqueta;
        $articulo->marca = $marca;
        $articulo->save();
        $idproducto = $articulo->id;

        $cantidad = 1;
        $producto = tbl_productos::where('id', $idproducto)->get();
        
        $producto_nombre = $producto[0]->title;
        $producto_descripcion = $producto[0]->descripcion;
        $marca = $producto[0]->marca;
        
        //crear inventario
        for ($x = 0; $x < $cantidad; $x++) {
            $inventario = new tbl_inventario;
            $inventario->uuid = Uuid::generate()->string;
            $inventario->id_producto = $idproducto;
            $inventario->estado = 1;
            $inventario->plataforma = $destino;
            $inventario->save();
            $id_inventario = $inventario->id;
            $return = [
                "id" => $id_inventario,
                "nombre" => $producto_nombre,
                "descripcion" => $producto_descripcion 
            ];
            $barcode[] = $return;
        }
        
        if($marca == 'DRIMA'){
            return "^XA ^FO50,60^A0,30^FD DRIMA - ORTOPEDIA DIGITAL ^FS ^FO45, 110^ADN, 12, 7^FD ".$producto_nombre." ^FS ^FO45, 140^ADN, 12, 7^FD ".$producto_descripcion." ^FS ^FO70,180^BY4^BC,60,N,N,N,N^A1,20,^FD ".$id_inventario." ^FS ^FO90, 260^ADN, 12, 7^FD www.drima.cl - La Serena ^FS ^FO25,25^GB435,275,2^FS ^XZ ^XA";
        }else{
            return "^XA ^FO90,60^A0,30^FD FABRICALONLINE.COM ^FS ^FO45, 110^ADN, 12, 7^FD ".$producto_nombre." ^FS ^FO45, 140^ADN, 12, 7^FD ".$producto_descripcion." ^FS ^FO70,180^BY4^BC,60,N,N,N,N^A1,20,^FD ".$id_inventario." ^FS ^FO50, 260^ADN, 12, 7^FD www.fabricalonline.com - Chile ^FS ^FO25,25^GB435,275,2^FS ^XZ ^XA";
        
        }
        
                            
        return $pdf->stream('archivo.pdf');

    }

}
