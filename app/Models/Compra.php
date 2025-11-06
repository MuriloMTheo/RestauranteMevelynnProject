<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Compra extends Model
{
protected $table = 'compras';
protected $primaryKey = 'cod_compra';
protected $fillable = ['data', 'nota_fiscal', 'valor_total', 'cod_fornecedor'];

public $timestamps = true;

public function fornecedor()
{
	return $this->belongsTo(Fornecedor::class, 'cod_fornecedor', 'cod_fornecedor');
}

public function itensCompra()
{
	return $this->hasMany(ItemCompra::class, 'cod_compra', 'cod_compra');
}

public function getRouteKeyName()
{
	return $this->primaryKey;
}
}