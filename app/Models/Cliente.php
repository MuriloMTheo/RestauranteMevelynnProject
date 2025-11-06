<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Cliente extends Model
{
protected $table = 'clientes';
protected $primaryKey = 'cod_cliente';
protected $fillable = ['nome', 'rg', 'cpf', 'data_nasc', 'endereco', 'numero', 'bairro', 'cod_cidade', 'cep', 'celular', 'email'];

public $timestamps = true;

public function cidade()
{
	return $this->belongsTo(Cidade::class, 'cod_cidade', 'cod_cidade');
}

public function pedidos()
{
	return $this->hasMany(Pedido::class, 'cod_cliente', 'cod_cliente');
}

public function getRouteKeyName()
{
	return $this->primaryKey;
}
}