<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class ItemCompra extends Model
{
protected $table = 'itens_compra';
protected $primaryKey = 'cod_item';
protected $fillable = ['cod_ingrediente', 'cod_compra', 'quantidade', 'valor_unitario'];

public $timestamps = true;

public function compra()
{
	return $this->belongsTo(Compra::class, 'cod_compra', 'cod_compra');
}

public function ingrediente()
{
	return $this->belongsTo(Ingrediente::class, 'cod_ingrediente', 'cod_ingrediente');
}
}