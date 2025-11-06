<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Prato extends Model
{
protected $table = 'pratos';
protected $primaryKey = 'cod_prato';
protected $fillable = ['descricao', 'cod_cat', 'valor_unitario'];

public $timestamps = true;


public function categoria()
{
	return $this->belongsTo(Categoria::class, 'cod_cat', 'cod_cat');
}


public function composicoes()
{
	return $this->hasMany(Composicao::class, 'cod_prato', 'cod_prato');
}


public function itensPedido()
{
	return $this->hasMany(ItemPedido::class, 'cod_prato', 'cod_prato');
}
}