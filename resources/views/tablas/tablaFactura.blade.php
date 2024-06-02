<x-layouts.plantillaPrincipal

title="tabla factura "
meta-description="Esta es la descripcion de la tabla factura"
>
<x-layouts.navegacionAdministracion
search="{{route('busquedaFacturas')}}"
placeholder="Buscar facturas..."
:columnas="['Nombre','identificacion','fecha']"
>
    {{-- incluir javaScript para cuando se selecione la fecha y este cambie el type del input por date y despues por otros --}}
    <div class="ml-10 mt-5">
        <table border="1">
            <thead>
                <th class="text-start pl-5">Nombre </th>
                <th class="text-start pl-5">Identificacion </th>
                <th class="text-start pl-5">Fecha factura</th>
                <th class="text-start pl-5">Total factura</th>
                <th class="text-start pl-5">Accion</th>
            </thead>
            <tbody>
                @foreach ($facturas as $factura)
           
                    <tr class="hover:bg-sky-200">
                            @csrf
                            <td class=" ">
                                <p class=" px-6 ">{{$factura->usuario->nombreUsuario." ".$factura->usuario->apellidoUsuario}}</p>
                            </td>
                            <td class="">
                                <p class=" px-6 ">{{$factura->usuario->identificacionUsuario}}</p>
                            </td>
                            <td class="">
                                <p class=" px-6  ">{{$factura->fechaFactura}}</p>
                            </td>
                            <td class=" ">
                                <p class=" px-6  "> {{$factura->totalFactura}}</p>
                            </td>
                            <form action="{{route('detallesFactura', ['idFactura'=>$factura->idFactura])}}" method="POST">
                                <td class="pd-2 ">
                                    <button class="px-6" type="submit" class="hover:underline">Ver detalles</button>
                                </td>
                            </form>    
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-layouts.navegacionAdministracion>
</x-layouts.plantillaPrincipal>