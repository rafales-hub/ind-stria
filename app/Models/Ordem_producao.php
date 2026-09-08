<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Setor;
use App\Models\Funcionario;

class Ordem_producao extends Model
{
    protected $table = 'ordens_producao';
    public $timestamps = false;
   
    protected $fillable = [
        'setor_id',
        'funcionario_id',
        'codigo_ordem',
        'produto',
        'quantidade_planejada',
        'quantidade_produzida',
        'data_inicio',
        'data_fim',
        'status',
        'descricao'

    ];

   
     public function setores (){
        return $this->belongto (Setor::class,'setor_id');
     }

     public function funcionarios (){
        return $this->belongTo (Funcionario::class,'funcionario_id');
     }
}
