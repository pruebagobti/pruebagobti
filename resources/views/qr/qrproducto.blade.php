@extends('plantilla')

@section('content')

<h1><center>Lista de productos por QR</center></h1>

	<div class="container">
		
		<p>Escanea el QR para entran a la lista de nuestros productos</p>

		<div class="row">
			<div class="col">
				<center>
				{!! QrCode::size(200)->generate('http://localhost:8888/laravel58/public/ListaProductosQR'); !!}
				</center>
			</div>
			<div class="col">
				<p>Por motivos de la contigencia sanitaria podra checar 
					nuestros productos en nuestra paguina web.</p>
			</div>
		</div>

		<p>
			Nesitas tener nuestro QR bajalo <a class="btn btn-outline-primary" href="{{route('DescargarQrPng')}}" role="button">aqui</a>
		</p>

	</div>

@endsection


