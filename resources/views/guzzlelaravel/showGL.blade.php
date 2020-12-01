@extends('plantilla')

@section('content')


<div class="container">
    <p><h1><center>Post con la clave: {{$consultaJsonCn->id}}</center></h1></p>
</div>
    
<div class="container">
    <div class="row">
        <div class="col-sm-10">

            <div class="card">
                <h5 class="card-header">{{$consultaJsonCn->title}}</h5>
                <div class="card-body">
                    <p class="card-text">{{$consultaJsonCn->body}}</p>
                    <a href="{{route('IndexGL')}}" class="btn btn-primary">Regresar a la lista de posts</a>
                </div>
            </div>

        </div>
    </div>
</div>    

<script type="text/javascript">

</script>

@endsection