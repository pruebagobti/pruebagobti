<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB; // El DB es una funcion que permite realizar consulta en la tablas

class Categoria extends Model
{
	protected $table='categorias';

    protected $fillable = 
    [
    	'idCategoria',
    	'NombreCategoria',
    	'DescripcionCategoria',
    	'ActivoCategoria',
    	'created_at',
    	'updated_at'
    ];

    public static function CategoriaCt()
    {
        return DB::table('categorias')
        ->select('categorias.*')
        ->orderBy('categorias.idCategoria', 'desc')
        ->get();
    }

    public static function CategoriaCn($idCategoria)
    {
        return DB::table('categorias')
        ->select('categorias.*')
        ->where('categorias.idCategoria','=',$idCategoria)
        ->get();
    }

    public static function altaCategoria($NombreCategoria,$DescripcionCategoria,$ActivoCategoria)
    {
        DB::table('categorias')->insert([
            'NombreCategoria'       =>  $NombreCategoria, 
            'DescripcionCategoria'  =>  $DescripcionCategoria,
            'ActivoCategoria'       =>  $ActivoCategoria
        ]);
    }

    public static function modificaCategoria($idCategoria,$NombreCategoria,$DescripcionCategoria,$ActivoCategoria)
    {
        DB::table('categorias')
            ->where('idCategoria', $idCategoria)
            ->update([
            'NombreCategoria'       =>  $NombreCategoria,
            'DescripcionCategoria'  =>  $DescripcionCategoria,
            'ActivoCategoria'       =>  $ActivoCategoria
        ]);
    }

    public static function eliminaCategoria($id)
    {
        DB::table('categorias')
        ->where('idCategoria','=',$id)
        ->delete();
    }

}
