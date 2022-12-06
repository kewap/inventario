<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_productos extends Model
{
    protected $table = 'tbl_productos';
    //campos a utilizar de la tabla
    protected $fillable = [
        'id',
        'uuid',
        'nombre',
        'descripcion',
        'title',
        'marca',
        'created_at',
        'updated_at'
    ];
}
