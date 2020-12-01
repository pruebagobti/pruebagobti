
<p><b>Top 10 de productos con mayor stock</b></p>

<table class="table table-responsive">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Stock</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($consultaProductoCt as $item)
            <tr>
                <td>
                    {{$item->nombre}}
                </td>
                <td>
                    {{$item->stock}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

