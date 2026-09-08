<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChamadoManutencao extends Model
{
    protected $table = 'chamados_manutencao';

    protected $fillable = [
        'titulo',
        'status',
        'equipamento_id',
        'user_id'
    ];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}