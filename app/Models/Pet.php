<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pets';

    protected $fillable = [
        'nome',
        'foto',
        'especie',
        'cor',
        'sexo',
        'raca',
        'peso',
        'data_de_aniversario',
        'vacinas',
        'observacoes',
    ];
}
