@extends('plantilla')

@section('content')

<h1><center>Nuevo Producto</center></h1>
<div class="container">

	<form action="{{route('GuardarProducto')}}" method="POST" enctype="multipart/form-data">
		
	  @csrf

		<div class="form-group">
			<label>Caratula:</label>
			<input type="file" class="form-control-file" name="caratuladata">
		</div>
	  
		<div class="form-group">
			<label>Nombre</label>
			<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
		</div>
	
		<!--Validacion-->
		@if($errors->first('nombre'))
		<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡El nombre del producto es requerido :C !</strong>
		</div>
		@endif

		<div class="form-group">
			<label>Descripcion</label>
			<input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion">
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
			<input type="number" class="form-control" name="stock" id="stock">
		</div>

		<!--Validacion-->
		@if($errors->first('stock'))
		<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡La cantidad de stock es requerido :C !</strong>
		</div>
		@endif

		<center>
        <button type="submit" class = "btn btn-success btn-block">AGREGAR</button>
        <a href="{{route('InicioProducto')}}" type="button" class="btn btn-danger btn-block">CANCELAR</a>
    	</center>

	</form>

</div>

@endsection