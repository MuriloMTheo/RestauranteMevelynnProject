<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Composicao extends Model
{
protected $table = 'composicao';
// composite primary key (cod_prato, cod_ingrediente) - Eloquent doesn't support this natively
public $incrementing = false;
protected $primaryKey = null;
protected $fillable = ['cod_prato', 'cod_ingrediente', 'quantidade'];

public function prato()
{
	return $this->belongsTo(Prato::class, 'cod_prato', 'cod_prato');
}

public function ingrediente()
{
	return $this->belongsTo(Ingrediente::class, 'cod_ingrediente', 'cod_ingrediente');
}
}