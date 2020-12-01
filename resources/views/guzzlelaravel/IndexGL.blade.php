@extends('plantilla')

@section('content')


<div class="container">
    <p><h1><center>Lista de Posts</center></h1></p>
</div>
    
<div class="container">
    <div class="row">
        <div class="col-sm-10">

            <p>Quieres saber mas da clik en el titulo del post</p>

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">Clave</th>
                        <th scope="col">Titulo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($consultaJsonCt as $dato)
                        <tr>
                            <td>
                                <a href="{{route('showGL', $dato->id)}}">{{$dato->id}}</a>
                            </td>
                            <td>
                                <a href="{{route('showGL', $dato->id)}}">{{$dato->title}}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>    

<script type="text/javascript">

</script>

@endsection