<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Pedido extends Model
{
protected $table = 'pedidos';
protected $primaryKey = 'cod_pedido';
protected $fillable = ['datahora', 'cod_cliente', 'tipo_pedido', 'cod_entregador', 'valor_entrega', 'cod_mesa', 'encerrado', 'datahora_encerramento', 'desconto', 'pago', 'data_pago', 'valor_pago', 'taxa_servico'];

public $timestamps = true;

public function cliente()
{
	return $this->belongsTo(Cliente::class, 'cod_cliente', 'cod_cliente');
}

public function garcon()
{
	return $this->belongsTo(Garcon::class, 'cod_garcom', 'cod_garcom');
}

public function mesa()
{
	return $this->belongsTo(Mesa::class, 'cod_mesa', 'cod_mesa');
}

public function entregador()
{
	return $this->belongsTo(Entregador::class, 'cod_entregador', 'cod_entregador');
}

public function itensPedido()
{
	return $this->hasMany(ItemPedido::class, 'cod_pedido', 'cod_pedido');
}

public function getRouteKeyName()
{
	return $this->primaryKey;
}
}