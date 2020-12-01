@extends('plantilla')

@section('content')

<h1><center>Editar Un Producto</center></h1>
<div class="container">

	<form action="{{route('ModificarProducto')}}" method="POST" enctype="multipart/form-data">

	 	@csrf

		<input type="hidden" name="id" value="{{$consultaProductoCn->id}}">
		<input type="hidden" name="caratulaActual" value="{{$consultaProductoCn->caratula}}">

		<div class="form-group">
			<label>Caratula Actual:</label>
			<img src = "{{asset('imagenes/'.$consultaProductoCn->caratula)}}" class="img-rounded img-responsive" width="100" height="100">
		</div>
		  
		<div class="form-group">
			<label>Nueva Caratula:</label>
			<input type="file" class="form-control-file" name="caratuladata">
		</div>
	  
		<div class="form-group">
			<label for="exampleInputPassword1">Nombre</label>
			<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="{{$consultaProductoCn->nombre}}">
		</div>
	
		<!--Validacion-->
		@if($errors->first('nombre'))
		<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡El nombre del producto es requerido :C !</strong>
		</div>
		@endif

		<div class="form-group">
			<label for="exampleInputPassword1">Descripcion</label>
			<input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion" value="{{$consultaProductoCn->descripcion}}">
		</div>

		<!--Validacion-->
		@if($errors->first('descripcion'))
		<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡La descripcion del producto es requerido :C !</strong>
		</div>
		@endif

		<div class="form-group">
			<label>Stock</label>
			<input type="number" class="form-control" name="stock" id="stock" value="{{$consultaProductoCn->stock}}">
		</div>

		<!--Validacion-->
		@if($errors->first('stock'))
		<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡La cantidad de stock es requerido :C !</strong>
		</div>
		@endif

		<center>
        <button type = "type" class = "btn btn-success btn-block">EDITAR</button>
        <a href="{{route('InicioProducto')}}" type="button" class="btn btn-danger btn-block">CANCELAR</a>
    	</center>

	</form>

</div>
<br>

@endsection