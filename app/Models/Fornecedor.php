<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Fornecedor extends Model
{
protected $table = 'fornecedores';
protected $primaryKey = 'cod_fornecedor';
protected $fillable = ['nome_social', 'nome_fantasia', 'cnpj', 'endereco', 'numero', 'bairro', 'cod_cidade', 'cep', 'celular', 'email'];

public $timestamps = true;

public function cidade()
{
	return $this->belongsTo(Cidade::class, 'cod_cidade', 'cod_cidade');
}

public function compras()
{
	return $this->hasMany(Compra::class, 'cod_fornecedor', 'cod_fornecedor');
}
}