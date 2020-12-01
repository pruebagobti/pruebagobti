<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use SweetAlert;//Paquete para el SweetAlert
use DB;
use App\Producto;//BD 


class GraficaController extends Controller
{
    public function index()
    {
        $consultaTop3ProductosStock = Producto::Top3ProductosStock();
        return view('Grafica.IndexGrafica',compact('consultaTop3ProductosStock'));
    }


    public function listaProducto()
    {
        $consultaProductoCt = Producto::ProductoCt();
        return view('Grafica.listaProducto',compact('consultaProductoCt'));
    }

    public function GuardarProductoAjax(Request $request)
    {
        //Validacion del formulario
        $request->validate([
            'nombre' => 'required|max:10',
            'descripcion' => 'required',
            'stock' => 'required'
        ]);
    
        //Valores que se enviaran a la funcion altaCategoria
        $nombre = $request->nombre;
        $descripcion = $request->descripcion;
        $stock = $request->stock;

        //El if que pone sombra en caso de no tener foto disponible
        if($request->file('caratuladata') == "")
        {
            $caratula = "sin_imagen.jpg";
        }
        else
        {
            $file = $request->file('caratuladata');
            $ldate = date('Ymd_His_');
            $caratula = $file->getClientOriginalName();
            $caratula = $ldate.$caratula;
            \Storage::disk('local')->put($caratula, \File::get($file));
        }

        //Incercion
        $guardaProducto = new Producto;
        $guardaProducto->caratula = $caratula;
        $guardaProducto->nombre = $request->nombre;
        $guardaProducto->descripcion = $request->descripcion;
        $guardaProducto->stock = $request->stock;
        $guardaProducto->save();

        return response()->json(['mensaje'=>'El producto fue guardada correctamente.']);
    }

}
