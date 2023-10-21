<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conteos extends Model
{
    use HasFactory;

    protected $fillable = ['codbar', 'cve_prod', 'conteo1','conteo2', 'id_usuario', 'id_producto', 'id_existencia'];
}
