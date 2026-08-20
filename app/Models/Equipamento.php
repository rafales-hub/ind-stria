<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    protected $table = 'equipamentos';

    protected $fillable = [
        'nome',
        'patrimonio',
        'setor_id',
        'status'
    ];

    public $timestamps = false;
}