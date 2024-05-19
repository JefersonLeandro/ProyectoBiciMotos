<x-layouts.plantillaPrincipal

title="tabla Roles"
meta-description="Esta es la descripcion de la tabla roles"
>
<x-layouts.navegacionAdministracion>
    
    <div class="ml-6 mr-6 mt-5 bg-slate-500">
        <table border="1" class="">
            <thead>
                <th>Nombre rol</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach($roles as $rol)
                    <form action="{{route("crudTablaRoles", ['idRol' => $rol->idRol])}}" method="POST">
                        @csrf
                        <tr>
                            <td>
                                <input type="text" name="fNombreRol" value="{{$rol->nombreRol}}" required>
                            </td>
                            <td>
                                <button name="fAccion" type="submit" value="modificar">Modificar</button>
                                <button name="fAccion" type="submit" value="eliminar">Eliminar</button>
                            </td>
                        </tr>
                    </form>
                @endforeach 
                <tr>
                    <form action="{{route('crudTablaRoles', ['idRol' => 0])}}" method="POST">
                        @csrf
                        <td>         
                            <input type="text" name="fNombreRol" class=" border-2  border-black" required>
                        </td>
                        <td>
                            <button class="border-1" type="submit" name="fAccion" value="insertar">Insertar</button>
                            <button type="reset"  class="border-1">Limpiar</button>
                        </td>
                    </form>
                </tr>
            </tbody>

        </table>
    </div>

    
</x-layouts.navegacionAdministracion>
</x-layouts.plantillaPrincipal>