<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB; // El DB es una funcion que permite realizar consulta en la tablas

class Producto extends Model
{

    protected $table='productos';

    protected $fillable = 
    [
		'id',
		'caratula',
    	'nombre',
		'descripcion',
		'stock',
    	'created_at',
    	'updated_at'
    ];

    public static function ProductoCt()
	{
		return DB::table('productos')
		->select('productos.*')
		->orderBy('productos.id', 'desc')
		->get();
	}

	public static function ProductoCn($id)
	{
		return DB::table('productos')
		->select('productos.*')
		->where('productos.id','=',$id)
		->get();
	}

	public static function Top3ProductosStock()
	{
		return DB::table('productos')
		->select('productos.*')
		->orderBy('productos.stock', 'desc')
		->limit(3)
		->get();
	}


}
