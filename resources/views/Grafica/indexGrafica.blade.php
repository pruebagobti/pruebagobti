@extends('plantilla')

@section('content')

<div class="container">
<p><h1><center>Graficas</center></h1></p>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-8">
			
            <div id="piechart" style="width: 900px; height: 500px;"></div>

		</div>
		<div class="col-sm-4">

            <p><button type="button" class="btn btn-success" id="nuevoProducto">Nuevo Producto</button></p>

            <!-- En este div carga la lista de prouctos -->
            <div id="listaProducto"></div>

		</div>
	</div>
</div>


<!-- Modal para modificar la categoria-->
<div class="modal fade" id="altaProductoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="col-form-label">Caratula:</label>
                        <input type="file" class="form-control-file" id="altaCaratulaProductos" name="altaCaratulaProductos">
                    </div>
					<div class="form-group">
						<label class="col-form-label">Nombre del producto:</label>
						<input type="text" class="form-control" id="altaNombreProductos">
					</div>
					<div class="form-group">
						<label class="col-form-label">Descripcion:</label>
						<textarea class="form-control" id="altaDescripcionProductos"></textarea>
                    </div>
                    <div class="form-group">
						<label class="col-form-label">Stonck:</label>
						<input type="number" class="form-control" id="altaStockProductos">
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" id="guardarProductoModal">Guardar</button>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">

    //Carga las funciones al cargar paguina por primera vez
    $(document).ready(function(){

        //Este meto trae el valor del meta de la plantilla principal que carga el token
		//Peticiones con AJAX
		$.ajaxSetup({
			headers:{
				'X-CSRF-TOKEN': $('meta[name="crsf-token"]').attr('content')
			}
        });
        
        //Carga la lista de productos
        listaProducto();

        //Funcion que abre el modal
		$("#nuevoProducto").click(function(e){

			//Evita recargar la paguina
			e.preventDefault();

            //Abre el modal
            $("#altaProductoModal").modal("show");
            
        });

        //Funcion que guardara los valores del modal a la bd
        $("#guardarProductoModal").click(function(e){

			//Evita recargar la paguina
            e.preventDefault();

            var formData = new FormData();

            //Se obtine los valores del modal
            var files = $('#altaCaratulaProductos')[0].files[0];
            var nombre = $("#altaNombreProductos").val();
            var descripcion = $("#altaDescripcionProductos").val();  
            var stock = $("#altaStockProductos").val();  

            formData.append('caratuladata',files);
            formData.append('nombre',nombre);
            formData.append('descripcion',descripcion);
            formData.append('stock',stock);
            
            $.ajax({

				type:'POST',
				url:"{{route('GuardarProductoAjax')}}",
                data:formData,
                contentType: false,
                processData: false,
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
						//limpiaFormulario();
						location.reload();
					});

				},
				error:function(data){
					alert("fallo algo");
				}
			});

        });


    });

    //Funcion que carga la lista de productos
    function listaProducto(){
        $.ajax({
            type:'GET',
            url:"{{ route('listaProducto')}}",
            data:{},
            success:function(data){
                $('#listaProducto').empty().html(data);
            },
            error:function(data){

            }
        });
    };

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = google.visualization.arrayToDataTable([
        ['Producto', 'Stock'],
        @foreach ($consultaTop3ProductosStock as $item)
        ['{{$item->nombre}}',{{$item->stock}}], 
        @endforeach
    ]);

    var options = {
        title: 'Mayor Stock'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
}

</script>

@endsection