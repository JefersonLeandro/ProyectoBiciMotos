<x-layouts.plantillaPrincipal

title="tabla factura "
meta-description="Esta es la descripcion de la tabla factura"
>
<x-layouts.navegacionAdministracion>
    <div>
        <table border="1">
            <thead>
                <th>Nombre </th>
                <th>Identificacion </th>
                <th>Fecha factura</th>
                <th>Total factura</th>
                <th>Accion</th>
            </thead>
            <tbody>
                @foreach ($facturas as $factura)
                    <tr>
                        <form action="{{route('detallesFactura', ['idFactura'=>$factura->idFactura])}}" method="POST">
                            @csrf
                            <td>{{$factura->usuario->nombreUsuario." ".$factura->usuario->apellidoUsuario}}</td>
                            <td>{{$factura->usuario->identificacionUsuario}}</td>
                            <td>{{$factura->fechaFactura}}</td>
                            <td>{{$factura->totalFactura}}</td>
                            <td>
                                <button type="submit" class="hover:underline">Ver detalles</button>
                            </td>
                        </form>    
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-layouts.navegacionAdministracion>
</x-layouts.plantillaPrincipal>