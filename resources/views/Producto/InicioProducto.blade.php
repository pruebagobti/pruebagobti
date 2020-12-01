@extends('plantilla')

@section('content')

<h1><center>Producto</center></h1>

@if(session('alta'))
	<div class="container">
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Accion realizada!</strong> {{session('alta')}}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
	</div>
@endif

@if(session('modificacion'))
	<div class="container">
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Accion realizada!</strong> {{session('modificacion')}}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
	</div>
@endif

@if(session('eliminacion'))
	<div class="container">
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Accion realizada!</strong> {{session('eliminacion')}}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
	</div>
@endif

	<div class="container">
		<div>
			<p><a class="btn btn-primary" href="{{route('NuevoProducto')}}" role="button">Nuevo Producto</a></p>
		</div>
		
		<table class="table table-sm" id="TablaProducto">
			<thead>
				<tr>
					<th scope="col">#Clave</th>
					<th scope="col">Nombre</th>
					<th scope="col">Descripcio</th>
					<th scope="col">Stock</th>
					<th scope="col">Editar</th>
					<th scope="col">Eliminar</th>
				</tr>
			</thead>
			<tbody>
				@foreach($consultaProductoCt as $dato)
				<tr>
					<th scope="row">
						{{$dato->id}}
					</th>
					<td>
						{{$dato->nombre}}
					</td>
					<td>
						{{$dato->descripcion}}
					</td>
					<td>
						{{$dato->stock}}
					</td>
					<td>
						<a href="{{route('EditarProducto', $dato->id)}}" class="btn btn-warning">
						MODIFICAR
					    </a>
					</td> 
					<td>
						<a href="{{route('EliminarProducto', $dato->id)}}" class="btn btn-danger">
						ELIMINAR
					    </a>
					</td>  
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<script type="text/javascript">

		//Carga las funciones al cargar paguina
		$(document).ready(function() {
			
			//Aplica los estilos del datatable a la tabla de categoria
			$('#TablaProducto').DataTable({
				"language":{
					"info": "_TOTAL_ registros",
					"search": "Buscar",
					"paginate": {
						"next": "Siguiente",
						"previous": "Anterior"
					},
					"lengthMenu": 'Mostrar <select>'+
									'<option value="10">10</option>'+
									'<option value="15">15</option>'+
									'<option value="-1">Todos</option>'+
									'</select> registros',
					"loadingRecords": "Cargando...",
					"processing": "Procesando...",
					"emptyTable": "No hay datos",
					"zeroRecords": "No hay concidencias",
					"infoEmty": "",
					"infoFiltered": ""
				}
			});
	
		});
	
	</script>
	

@endsection


