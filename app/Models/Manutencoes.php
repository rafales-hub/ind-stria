<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Equipamento;
use App\Models\Funcionario;

class Manutencoes extends Model
{
    protected $table = 'manutencoes';
    public $timestamps = false;
   
    protected $fillable = [
        'equipamento_id',
        'funcionario_id',
        'tipo',
        'descricao',
        'data_manutencao',
        'proxima_manutencao',
        'custo',
        'status'

    ];

   
     public function equipamentos (){
        return $this->belongto (Equipamento::class,'equipamento_id');
     }

     public function funcionarios (){
        return $this->belongTo (Funcionario::class,'funcionario_id');
     }
}
