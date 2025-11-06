<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Categoria extends Model
{
protected $table = 'categorias';
protected $primaryKey = 'cod_cat';
protected $fillable = ['descricao'];

public $timestamps = true;

public function pratos()
{
	return $this->hasMany(Prato::class, 'cod_cat', 'cod_cat');
}

public function getRouteKeyName()
{
	return $this->primaryKey;
}
}