<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class ItemPedido extends Model
{
protected $table = 'itens_pedido';
protected $primaryKey = 'cod_item';
protected $fillable = ['cod_pedido', 'cod_prato', 'quantidade', 'valor_unitario', 'cod_garcom', 'data_hora'];

public $timestamps = true;

public function pedido()
{
	return $this->belongsTo(Pedido::class, 'cod_pedido', 'cod_pedido');
}

public function prato()
{
	return $this->belongsTo(Prato::class, 'cod_prato', 'cod_prato');
}
}