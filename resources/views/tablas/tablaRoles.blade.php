<x-layouts.plantillaPrincipal

title="tabla Roles"
meta-description="Esta es la descripcion de la tabla roles"
>
<x-layouts.navegacionAdministracion>
    
    <div class="w-auto ml-32 mt-5 ">
        <table border="1" >
            <thead>
                <th class="pl-1 text-start">Nombre rol</th>
                <th class="pl-1 text-start">Acciones</th>
            </thead>
            <tbody class="">
                @foreach($roles as $rol)
                    <form action="{{route("crudTablaRoles", ['idRol' => $rol->idRol])}}" method="POST">
                        @csrf
                        <tr>
                            <td class="p-2">
                                <input  class="pl-2 h-7 rounded" type="text" name="fNombreRol" value="{{$rol->nombreRol}}" required>
                            </td>
                            <td>
                                <button name="fAccion" class="bg-slate-400 w-20 h-7 rounded" type="submit" value="modificar">Modificar</button>
                                <button name="fAccion" class="bg-red-300 w-20 h-7 rounded " type="submit" value="eliminar">Eliminar</button>
                            </td>
                        </tr>
                    </form>
                @endforeach 
                <tr>
                    <form action="{{route('crudTablaRoles', ['idRol' => 0])}}" method="POST">
                        @csrf
                        <td class="p-2">         
                            <input type="text" name="fNombreRol" class=" border-2 rounded  border-black h-7 w-48" required>
                        </td>
                        <td>
                            <button class="bg-sky-400 w-20 h-7 rounded" type="submit" name="fAccion" value="insertar">Insertar</button>
                            <button type="reset"  class="bg-amber-300 w-20 h-7 rounded">Limpiar</button>
                        </td>
                    </form>
                </tr>
            </tbody>

        </table>
    </div>

    
</x-layouts.navegacionAdministracion>
</x-layouts.plantillaPrincipal>