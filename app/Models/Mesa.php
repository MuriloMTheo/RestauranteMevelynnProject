<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Mesa extends Model
{
protected $table = 'mesas';
protected $primaryKey = 'cod_mesa';
protected $fillable = ['descricao'];

public $timestamps = true;

public function pedidos()
{
	return $this->hasMany(Pedido::class, 'cod_mesa', 'cod_mesa');
}
}