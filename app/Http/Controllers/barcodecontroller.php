<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class barcodecontroller extends Controller
{
    public function barcode(){
        return view('barcode');
    }
}
