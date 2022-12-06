<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_inventario extends Model
{
    protected $table = 'tbl_inventario';
    //campos a utilizar de la tabla
    protected $fillable = [
        'id',
        'uuid',
        'id_producto',
        'estado',
        'plataforma',
        'created_at',
        'updated_at'
    ];
}
