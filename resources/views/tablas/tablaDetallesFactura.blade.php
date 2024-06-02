<x-layouts.plantillaPrincipal

title="tabla detalles factura "
meta-description="Esta es la descripcion de la tabla detalles de la Factura"
>
<x-layouts.navegacionAdministracion
search="{{route('busquedaDetalles')}}"
placeholder="Buscar destalles factura.."
>

    <div class="ml-16 mt-5">
        <table border=1 class="">
            <thead class=" ">
                <th class="text-start pl-2 ">Producto</th>
                <th class="text-start pl-2 ">Cantidad</th>
                <th class="text-start pl-2 ">Subtotal</th>
            </thead>
            <tBody class="  ">
                @foreach ($detallesFactura as $informacion) 
                    <tr class="hover:bg-sky-200">
                        <td class="px-2  ">
                           
                           {{-- limitar la informacion del producto  --}}
                            <p>{{ $informacion->producto->nombreProducto}}</p>
                        </td>
                        <td class="px-2 text-center ">
                            <p >{{ $informacion->cantidadDetalle }}</p>
                        </td>
                        <td class="px-2">
                            <p>{{ $informacion->subTotalDetalle }}</p>
                        </td>
                    </tr>    
                @endforeach
            </tBody>
        </table>
        

    </div>



       
</x-layouts.navegacionAdministracion>
</x-layouts.plantillaPrincipal>