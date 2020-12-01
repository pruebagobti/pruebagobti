<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Producto;//BD 

class ProductoController extends Controller
{

    public function index()
    {
        $consultaProductoCt = Producto::ProductoCt();
        return view('Producto.InicioProducto',compact('consultaProductoCt'));
    }

    public function create()
    {
        return view('Producto.NuevoProducto');
    }

    public function store(Request $request)
    {
        //Validacion
        $this->validate($request,
        [
            'nombre'=>'required',
            'descripcion'=>'required',
            'stock'=>'required',
        ]);

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

        return redirect('/InicioProducto')->with('alta','El producto fue dado de alta exitosamente');
    }

    public function edit($id)
    {
        $consultaProductoCn = Producto::ProductoCn($id);
        return view ('Producto.EditaProducto')->with('consultaProductoCn',$consultaProductoCn[0]);
    }

    public function update(Request $request)
    {
        //Validacion
        $this->validate($request,
        [
            'nombre'=>'required',
            'descripcion'=>'required',
            'stock'=>'required',
        ]);

        //El if para cambio de foto
        if($request->file('caratuladata') == "")
        {
            $caratula = $request->caratulaActual;
        }
        else
        {
            $file = $request->file('caratuladata');
            $ldate = date('Ymd_His_');
            $caratula = $file->getClientOriginalName();
            $caratula = $ldate.$caratula;
            \Storage::disk('local')->put($caratula, \File::get($file));
        }

        //Modificacion
        $modificaProducto = Producto::findOrFail($request->id);
        $modificaProducto->caratula = $caratula;
        $modificaProducto->nombre = $request->nombre;
        $modificaProducto->descripcion = $request->descripcion;
        $modificaProducto->stock = $request->stock;
        $modificaProducto->save();

        return redirect('/InicioProducto')->with('modificacion','El producto fue modificado exitosamente');
    }

    public function destroy($id)
    {
        //Eliminacion
        $eliminaProducto = Producto::findOrFail($id);
        $eliminaProducto->delete();

        return redirect('/InicioProducto')->with('eliminacion','El producto fue eliminado exitosamente');
    }
}
