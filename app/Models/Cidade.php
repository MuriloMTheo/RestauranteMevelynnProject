<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Cidade extends Model
{
protected $table = 'cidades';
protected $primaryKey = 'cod_cidade';
protected $fillable = ['nome', 'uf'];

public $timestamps = true;

public function clientes()
{
	return $this->hasMany(Cliente::class, 'cod_cidade', 'cod_cidade');
}

public function fornecedores()
{
	return $this->hasMany(Fornecedor::class, 'cod_cidade', 'cod_cidade');
}

public function getRouteKeyName()
{
	return $this->primaryKey;
}
}