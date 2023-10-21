<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    protected $fillable = [
        'cse_prod',
        'cve_prod',
        'sub_cse',
        'sub_subcse',
        'desc_prod',
        'uni_med',
        'cve_tial',
        'costo_prod',
        'codbar',
        'factor',
        'conver'
    ];
}
