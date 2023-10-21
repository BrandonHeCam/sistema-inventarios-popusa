<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produnid extends Model
{
    use HasFactory;

    protected $fillable = [
            'cve_prod',
            'unidad',
            'factor',
            'conver',
            'codbar'
    ];
}
