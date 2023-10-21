<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Existencias extends Model
{
    use HasFactory;

    protected $fillable = [
        'lugar',
        'cve_prod',
        'existencia',
        'costo',
        'desc_prod',
        'cse_prod',
        'cve_tial',
        'codbar',
        'uni_med',
        'des_lug',
        'des_tial'
    ];
}
