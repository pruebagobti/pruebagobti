<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Categoria;//BD 
use SweetAlert;//Paquete para el SweetAlert
use DB;

class CategoriaController extends Controller
{

    public function index()
    {
        //Funcion que trae todas las categorias y las guarda en una variable
        $consultaCategoriaCt = Categoria::CategoriaCt();

        return view('Categoria.IndexCategoria',compact('consultaCategoriaCt'));
    }

    public function store(Request $request)
    {
        //Validacion del formulario
        $request->validate([
        'NombreCategoria' => 'required|max:10',
        'DescripcionCategoria' => 'required',
        'ActivoCategoria' => 'required'
        ]);

        //Valores que se enviaran a la funcion altaCategoria
        $NombreCategoria = $request->NombreCategoria;
        $DescripcionCategoria = $request->DescripcionCategoria;
        $ActivoCategoria = $request->ActivoCategoria;

        //Funcion que realiza una alta de categoria
        Categoria::altaCategoria($NombreCategoria,$DescripcionCategoria,$ActivoCategoria);  
        
        return response()->json(['mensaje'=>'La categoría fue guardada correctamente.']);
    }

    public function edit($id)
    {
        //Funcion que busca solo por id categoria
        $consultaCategoriaCn = Categoria::CategoriaCn($id);

        //$NombreCategoria = $consultaCategoriaCn[0]->NombreCategoria;
        //return response()->json(['NombreCategoria'=>$NombreCategoria]);

        return response()->json($consultaCategoriaCn);
    }

    public function update(Request $request)
    {   
        //Validacion del formulario
        $request->validate([
            'NombreCategoria' => 'required|max:10',
            'DescripcionCategoria' => 'required',
            'ActivoCategoria' => 'required'
        ]);

        //Valores que se enviaran a la funcion modificaCategoria
        $idCategoria = $request->idCategoria;
        $NombreCategoria = $request->NombreCategoria;
        $DescripcionCategoria = $request->DescripcionCategoria;
        $ActivoCategoria = $request->ActivoCategoria;

        //Funcion que realiza una modificacion de la categoria
        Categoria::modificaCategoria($idCategoria,$NombreCategoria,$DescripcionCategoria,$ActivoCategoria);  

        return response()->json(['mensaje'=>'La categoría fue modificada correctamente.']);
    }

    public function eliminaCategoria($id)
    {
        //Funcion que elimina una categoria
        Categoria::eliminaCategoria($id);

        return response()->json(['mensaje'=>'La categoría fue eliminada correctamente.']);
       
    }


}
