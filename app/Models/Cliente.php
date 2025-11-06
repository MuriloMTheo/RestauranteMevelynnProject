<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $primaryKey = 'cod_cliente'; 

    protected $fillable = [
        'nome',
        'rg',
        'cpf',
        'data_nasc',
        'endereco',
        'numero',
        'bairro',
        'cod_cidade',
        'cep',
        'celular',
        'email'
    ];
}
