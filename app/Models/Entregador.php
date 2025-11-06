<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Entregador extends Model
{
protected $table = 'entregadores';
protected $primaryKey = 'cod_entregador';
protected $fillable = ['nome', 'celular'];

public $timestamps = true;

public function pedidos()
{
	return $this->hasMany(Pedido::class, 'cod_entregador', 'cod_entregador');
}

public function getRouteKeyName()
{
	return $this->primaryKey;
}
}