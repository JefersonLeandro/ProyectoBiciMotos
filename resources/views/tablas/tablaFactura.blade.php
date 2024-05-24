<x-layouts.plantillaPrincipal

title="tabla factura "
meta-description="Esta es la descripcion de la tabla factura"
>
<x-layouts.navegacionAdministracion>
    <div>
        <table border="1">
            <thead>
                 <th>Fecha factura</th>
                 <th>Total factura</th>
                 <th>Nombre Usuario</th>
                 <th></th>
            </thead>
            <tbody>
                @foreach ($facturas as $factura)
                    <tr>
                        <form action="" method="POST">
                            <td>{{$factura->fechaFactura}}</td>
                            <td>{{$factura->totalFactura}}</td>
                            <td>{{$factura->usuario->nombreUsuario}}</td>
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