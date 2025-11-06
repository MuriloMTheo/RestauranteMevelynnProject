<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Unidade extends Model
{
protected $table = 'unidades';
protected $primaryKey = 'cod_unidade';
protected $fillable = ['descricao', 'sigla'];

public $timestamps = true;

public function ingredientes()
{
	return $this->hasMany(Ingrediente::class, 'cod_unidade', 'cod_unidade');
}

public function getRouteKeyName()
{
	return $this->primaryKey;
}
}