<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Garcon extends Model
{
protected $table = 'garcons';
protected $primaryKey = 'cod_garcom';
protected $fillable = ['nome', 'celular'];

public $timestamps = true;

public function pedidos()
{
	return $this->hasMany(Pedido::class, 'cod_garcom', 'cod_garcom');
}

public function getRouteKeyName()
{
	return $this->primaryKey;
}
}