<x-layouts.plantillaPrincipal

title="tabla detalles factura "
meta-description="Esta es la descripcion de la tabla detalles de la Factura"
>
<x-layouts.navegacionAdministracion>

    <div>
        <table>
            <thead>
                <th>Producto</th>
                <th>CantidadDetalle</th>
                <th>SubtotalDetalle</th>
            </thead>
            <tBody>
                @foreach ($detallesFactura as $informacion)
                    <tr>
                        <td>
                            <p>{{ $informacion->producto->nombreProducto}}</p>
                        </td>
                        <td>
                            <p>{{ $informacion->cantidadDetalle }}</p>
                        </td>
                        <td>
                            <p>{{ $informacion->subTotalDetalle }}</p>
                        </td>
                    </tr>    
                @endforeach
            </tBody>
        </table>
        

    </div>



       
</x-layouts.navegacionAdministracion>
</x-layouts.plantillaPrincipal>