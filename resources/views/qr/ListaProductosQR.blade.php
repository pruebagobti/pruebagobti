@extends('plantilla')

@section('content')

    <h1><center>Lista de productos</center></h1>

    <br><br>

	<div class="container">
        <div class="row">
            @foreach($consultaProductoCt as $dato)
                <div class="col-sm-4">
                    <div class="card">
                        <img class="card-img-top" src="{{asset('imagenes/'.$dato->caratula)}}" class="img-rounded img-responsive" width="100" height="200">
                        <div class="card-body">
                            <h5 class="card-title">{{$dato->nombre}}</h5>
                            <p class="card-text">{{$dato->descripcion}}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                @if($dato->stock > 0)
                                    
                                    <span class="badge badge-success">Con estock</span>
                                @else
                                    <span class="badge badge-danger">Sin estock</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <br><br>

@endsection


