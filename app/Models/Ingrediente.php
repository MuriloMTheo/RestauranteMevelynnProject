<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Ingrediente extends Model
{
protected $table = 'ingredientes';
protected $primaryKey = 'cod_ingrediente';
protected $fillable = ['descricao', 'cod_unidade', 'controle_estoque', 'quantidade_estoque', 'valor_unitario'];

public $timestamps = true;

public function unidade()
{
	return $this->belongsTo(Unidade::class, 'cod_unidade', 'cod_unidade');
}

public function composicoes()
{
	return $this->hasMany(Composicao::class, 'cod_ingrediente', 'cod_ingrediente');
}

public function itensCompra()
{
	return $this->hasMany(ItemCompra::class, 'cod_ingrediente', 'cod_ingrediente');
}
}