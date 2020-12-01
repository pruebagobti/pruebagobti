@extends('plantilla')

@section('content')

<div class="container">
<p><h1><center>Categoria</center></h1></p>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<div id="listaCategoria">
			<table class="table table-sm" id="TablaCategoria">
				<thead>
					<tr>
						<th scope="col">#Clave</th>
						<th scope="col">Nombre</th>
						<th scope="col">Descripcio</th>
						<th scope="col">Editar</th>
						<th scope="col">Eliminar</th>
					</tr>
				</thead>
				<tbody>
					@foreach($consultaCategoriaCt as $dato)
						<tr>
							<th scope="row">
								{{$dato->idCategoria}}
							</th>
							<td>
								{{$dato->NombreCategoria}}
							</td>
							<td>
								{{$dato->DescripcionCategoria}}
							</td>
							<td>
								<button type="button" class="btn btn-warning modificaCategoria" name="{{$dato->idCategoria}}" >MODIFICAR</button>
							</td> 
							<td>
								<button type="button" class="btn btn-danger eliminaCategoria" name="{{$dato->idCategoria}}" >ELIMINAR</button>
							</td>  
						</tr>
					@endforeach
				</tbody>
			</table><br>
			</div>
		</div>
		<div class="col-sm-4">

			<form>

				<div class="form-group">
					<label>Nueva Categoria</label>
					<input type="text" class="form-control" id="NombreCategoria" name="NombreCategoria">
					<div class="text-danger" id="errorNombreCategoria"></div>
				</div>

				<div class="form-group">
					<label>Descripcion:</label>
					<textarea class="form-control" id="DescripcionCategoria" name="DescripcionCategoria"></textarea>
					<div class="text-danger" id="errorDescripcionCategoria"></div>
				</div>

				<button type="submit" class="btn btn-primary" id="GuardarCategoria" >Guardar</button>

			</form>

		</div>
	</div>
</div>

<!-- Modal para modificar la categoria-->
<div class="modal fade" id="modificaCategoriaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Estas modificado</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>

					<!-- Valores ocultos -->
					<input type="hidden" class="form-control" id="modificaidCategoria">
					<input type="hidden" class="form-control" id="modificaActivoCategoria"> 

					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Nombre de la categoria:</label>
						<input type="text" class="form-control" id="modificaNombreCategoria">
						<div class="text-danger" id="errorMonNomCat"></div>
					</div>
					<div class="form-group">
						<label for="message-text" class="col-form-label">Descripcion:</label>
						<textarea class="form-control" id="modificaDescripcionCategoria"></textarea>
						<div class="text-danger" id="errorMonDesCat"></div>
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" id="GuardarModificacionCategoria">Modificar</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	//Carga las funciones al cargar paguina
	$(document).ready(function() {

		//Este meto trae el valor del meta de la plantilla principal que carga el token
		//Peticiones con AJAX
		$.ajaxSetup({
			headers:{
				'X-CSRF-TOKEN': $('meta[name="crsf-token"]').attr('content')
			}
		});

		//Aplica los estilos del datatable a la tabla de categoria
		$('#TablaCategoria').DataTable({
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

		//Funcion que Guarda los datos del formulario Categoria
		$("#GuardarCategoria").click(function(e){

			//Evita recargar la paguina
			e.preventDefault();

			var NombreCategoria = $("#NombreCategoria").val();
			var DescripcionCategoria = $("#DescripcionCategoria").val();
			var ActivoCategoria = "Si";

			$("#errorNombreCategoria").html('');
			$("#errorDescripcionCategoria").html('');

			$.ajax({

				type:'POST',
				url:"{{ route('GuardarCategoria')}}",
				data:{
						NombreCategoria:NombreCategoria, 
						DescripcionCategoria:DescripcionCategoria, 
						ActivoCategoria:ActivoCategoria
					},
				success:function(data){

					//Aleta de guardado
					swal({
						icon: "success",
						title: "Guardado", 
						text: data.mensaje, 
						type: "success"
					})
					.then(function(){ 
						//Limpia el formulario
						limpiaFormulario();
						location.reload();
					});

				},
				error:function(data){
					//alert("fallo algo");
					//console.log(data);
					//console.log(data.responseJSON.errors.DescripcionCategoria);

					//Errores de la validaciones
					if(data.responseJSON.errors.NombreCategoria !== undefined){
						//alert(data.responseJSON.errors.NombreCategoria);
						$("#errorNombreCategoria").html(data.responseJSON.errors.NombreCategoria);
					}
					if(data.responseJSON.errors.DescripcionCategoria !== undefined){
						//alert(data.responseJSON.errors.DescripcionCategoria);
						$("#errorDescripcionCategoria").html(data.responseJSON.errors.DescripcionCategoria);
					}
				}
			});

		});

		//Elimina un elemento de la tabla que sea de la clase eliminaCategoria
		$('.eliminaCategoria').on('click', function(e) {

			//Evita recargar la paguina
			e.preventDefault();

			var id = $(this).attr('name');

			swal({
			  title: "¿Estas eliminado?",
			  text: "Estas apunto de eliminar una categoría.",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {

			 	if (willDelete) {

				  	$.ajax({
						type:'GET',
						url:'{{ url('EliminarCategoria')}}' + '/' + id,
						success:function(data){

							//Aleta de eliminacion
							swal({
								icon: "success",
								title: "Eliminacion realizada", 
								text: data.mensaje, 
								type: "success"
							})
							.then(function(){ 
   								location.reload();
   							});
						}
					});

			 	} else {
			  		swal("No se ha eliminado la categoría.");
			 	}

			});
		      
		});

		//Modifica un elemento de la tabla que sea de la clase modificaCategoria
		$('.modificaCategoria').on('click', function(e) {

			//Evita recargar la paguina
			e.preventDefault();

			var id = $(this).attr('name');

			$.ajax({
				type:'GET',
				url:'{{ url('ModificaCategoria')}}' + '/' + id,
				success:function(data){
						//alert(data.NombreCategoria);
						//alert(data[0].NombreCategoria);

						//Abre el modal
						$("#modificaCategoriaModal").modal("show");

						//Limpia el div donde se muestra el error de validacion
						$("#errorMonNomCat").html('');
						$("#errorMonDesCat").html('');

						//Variables que se mandaran al controlador
						$("#modificaidCategoria").val(data[0].idCategoria);
						$("#modificaNombreCategoria").val(data[0].NombreCategoria);
						$("#modificaDescripcionCategoria").val(data[0].DescripcionCategoria);
						$("#modificaActivoCategoria").val(data[0].ActivoCategoria);
				}
			});
			
		});

		//Funcion que Guarda la modificacion de la categoria
		$("#GuardarModificacionCategoria").click(function(e){

			//Evita recargar la paguina
			e.preventDefault();

			var idCategoria = $("#modificaidCategoria").val();
			var NombreCategoria = $("#modificaNombreCategoria").val();
			var DescripcionCategoria = $("#modificaDescripcionCategoria").val();
			var ActivoCategoria = $("#modificaActivoCategoria").val();

			//Limpia el div donde se muestra el error de validacion
			$("#errorMonNomCat").html('');
			$("#errorMonDesCat").html('');

			$.ajax({

				type:'POST',
				url:"{{ route('GuardarModificacionCategoria')}}",
				data:{
						idCategoria:idCategoria,
						NombreCategoria:NombreCategoria, 
						DescripcionCategoria:DescripcionCategoria, 
						ActivoCategoria:ActivoCategoria
					},
				success:function(data){
					
					//alert(data.mensaje);

					//Limpia el div donde se muestra el error de validacion
					$("#errorMonNomCat").html('');
					$("#errorMonDesCat").html('');

					//Cierre del modal
					$("#modificaCategoriaModal").modal("hide");

					//Alerta de modificacion
					swal({
						icon: "success",
						title: "Modificacion realizada", 
						text: data.mensaje, 
						type: "success"
					})
					.then(function(){ 
						   location.reload();
					});

				},
				error:function(data){
					//alert(data.responseJSON.errors.DescripcionCategoria);
					//console.log(data);
					//console.log(data.responseJSON.errors.DescripcionCategoria);

					//Errores de la validaciones
					if(data.responseJSON.errors.NombreCategoria !== undefined){
						//alert(data.responseJSON.errors.NombreCategoria);
						$("#errorMonNomCat").html(data.responseJSON.errors.NombreCategoria);
					}
					if(data.responseJSON.errors.DescripcionCategoria !== undefined){
						//alert(data.responseJSON.errors.DescripcionCategoria);
						$("#errorMonDesCat").html(data.responseJSON.errors.DescripcionCategoria);
					}

				}
			});

		});

		//Funcion que limpia el formulario
		function limpiaFormulario()
		{
			$("#NombreCategoria").val('');
			$("#DescripcionCategoria").val('');
		};

	});

</script>

@endsection