<x-layouts.plantillaPrincipal

title="tabla tabla producto "
meta-description="Esta es la descripcion de la tabla producto"
>
<x-layouts.navegacionAdministracion>

    <div>
        <table>
            <thead>
                <th>Nombre </th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Stock</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                <tr>
                    <form action="{{route('crudTablaProducto', ['idProducto'=>$producto->idProducto])}}"  method="POST">
                        @csrf
                        <td  class="p-2">
                            <input type="text" class="pl-2 mx-2 h-7 rounded"  name="fNombreProducto" value="{{$producto->nombreProducto}}" required>
                        </td>
                        <td class="p-2">
                            <input type="text" class="pl-2 mx-2 h-7 rounded"  name="fDescripcionProducto" value="{{$producto->descripcionProducto}}" required>
                        </td>
                        <td class="p-2">
                            <input type="number" class="pl-2 mx-2 h-7 rounded" name="fPrecioProducto"  value="{{$producto->precioProducto}}" required>
                        </td>
                        <td class="p-2">
                            <input type="number" class="pl-2 mx-2 h-7 rounded"  name="fStockProducto" value="{{$producto->stockProducto}}" required>
                        </td>
                        <td>
                            <button type="submit" class="bg-slate-400 w-20 h-7 rounded" name="fAccion" value="modificar">Modificar</button>
                            <button type="submit" class="bg-red-300 w-20 h-7 rounded" name="fAccion" value="eliminar">Eliminar</button>
                        </td>
                    </form>
                </tr>
                @endforeach
                <tr>
                    <form action="{{route('crudTablaProducto', ['idProducto'=> 0])}}" method="POST">
                        @csrf
                        <td  class="p-2">
                          <input type="text"  name="fNombreProducto" class="pl-2 mx-2 h-7 rounded" required>  
                        </td>
                        
                        <td  class="p-2">
                          <input type="text"  name="fDescripcionProducto"class="pl-2 mx-2 h-7 rounded" required>  
                        </td>
                        
                        <td  class="p-2">
                          <input type="number" name="fPrecioProducto" class="pl-2 mx-2 h-7 rounded" required>  
                        </td>

                        <td  class="p-2">
                          <input type="number" name="fStockProducto" class="pl-2 mx-2 h-7 rounded" required>  
                        </td>
                        <td>
                            <button class="bg-sky-400 w-20 h-7 rounded" type="submit" name="fAccion" value="insertar">Insertar</button>
                            <button class="bg-amber-300 w-20 h-7 rounded" type="reset" >Limpiar</button>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>
    </div>

</x-layouts.navegacionAdministracion>
</x-layouts.plantillaPrincipal>