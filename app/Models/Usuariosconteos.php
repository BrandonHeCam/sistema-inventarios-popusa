<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuariosconteos extends Model
{
    use HasFactory;

    protected $fillable = ['id_inventario','id_usuario', 'fechaInicial', 'fechaFinal'];

}