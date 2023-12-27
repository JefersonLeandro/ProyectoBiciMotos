<x-layouts.plantillaPrincipal

title="tabla usuarios"
meta-description="Esta es la descripcion de la tabla Usuarios"
>
<x-layouts.navegacionAdministracion>
   
       

    <table class="" style="width: 98%; height:full;">
            
        <thead class="bg-slate-400 h-12 ">
            <th class="py-2 px-3 text-start w-44 ">Nombre </th>
            <th class="py-2 px-3 text-start w-44" >Apellido</th>
            <th class="py-2 px-2 text-center w-40 " >Identificaion</th>
            <th class="py-2 px-3 text-start w-60 " >Email</th>
            <th class="py-2 px-3 pl-5 text-start w-60 " >Contraseña</th>
            <th class="py-2 px-3  text-start w-40 " >Rol</th>
            <th class="py-2 px-3 w-38 "></th>
        </thead>
        <tbody class="">
            @foreach ($usuarios as $unUsuario)
            
                @php
                $idRolUsuario = $unUsuario->idRol; 
                @endphp
                
                <tr class="h-10">
                    <form action="{{route("crudUsuario")}}" method="post" >
                        @csrf
                        <td class=" py-2 text-center w-44 ">
                            <input type="hidden" name="idUsuario" value="{{$unUsuario->idUsuario}}">
                            <input type="text" name="nombreUsuario" class="h-7 px-2 rounded w-40" required value="{{$unUsuario->nombreUsuario}}">
                        </td>
                        <td class=" py-2 text-center w-44"><input type="text" name="apellidoUsuario" class="h-7 px-2 rounded  w-40" required value="{{$unUsuario->apellidoUsuario}}"></td>
                        <td class=" py-2 text-center  w-40   "><input type="number" name="identificacionUsuario" class="h-7 px-2 rounded w-32" required  value="{{$unUsuario->identificacionUsuario}}"></td>
                        <td class=" py-2 text-center w-60"><input type="email" class="h-7 px-2 rounded w-56 bg-slate-50" readonly disabled  value="{{$unUsuario->email}}"></td>
                        <td class=" py-2 text-center w-60"><input type="text" class="h-7 px-2 rounded bg-slate-50 w-52" readonly disabled  value="{{$unUsuario->password}}"></td>
                        <td class=" py-2 text-center ">
                        <select name="idRol" id="" required  class="h-7 px-1 rounded w-36">
                            @foreach ($roles as $unRol)
                            
                                @if ($idRolUsuario == $unRol->idRol)

                                <option value="{{$unUsuario->idRol}}" selected>{{$unRol->nombreRol}}</option>

                                @else

                                <option value="{{$unRol->idRol}}"  >{{$unRol->nombreRol}}</option>
                                @endif

                            @endforeach
                        </select>
                        </td>
                        
                        <td class="py-2 pl-3">
                            <button class="bg-slate-400 w-20 h-7 rounded " name="fAccion" value="modificar">Modificar</button>
                            <button class="bg-red-300 w-20 h-7 rounded " name="fAccion" value="eliminar">Eliminar</button>
                        </td>
                    </form>
                </tr>
                @endforeach
                    
           

            <tr>
                <form action="{{route("crudUsuario")}}" method="post">
                    @csrf
                    <td class="py-2 text-center w-44" >
                        <input type="text" name="nombreUsuario"  required class=" w-40 h-7 px-2 rounded ">
                    </td>
                    <td class=" py-2 text-center w-44 ">
                        <input type="text" name="apellidoUsuario" required class="w-40 h-7 px-2 rounded ">
                    </td>
                    <td class=" py-2 text-center w-32">
                        <input type="text" name="identificacionUsuario" required class="h-7 w-32 px-2  rounded ">
                    </td>
                    <td class=" py-2 text-center w-60 ">
                        <input type="email" name="email" required class=" w-56 h-7 px-2 rounded ">
                    </td>
                    </td>
                    <td class=" py-2 text-center " >
                        <input type="password" name="password" required class="w-52 h-7 px-2 rounded ">
                    </td>
                    <td  class=" py-2 text-center w-40 ">
                        <select required name="idRol" id="" class="h-7 px-1 rounded w-36">
                            <option value="" selected  disabled>Selecciona</option>
                        @foreach ($roles as $unRol)
                            <option value="{{$unRol->idRol}}">{{$unRol->nombreRol}}</option>
                        @endforeach
                        </select>
                    </td>
                    <td class=" p-3 ">
                        <button class="bg-sky-400 w-20 h-7 rounded"  type="submit"  name="fAccion" value="insertar">Insertar</button>
                        <button  class="bg-amber-300 w-20 h-7 rounded" type="reset" >Limpiar</button>
                    </td>
                </form>
            </tr>
           
        </tbody>
        
    </table>
   
</x-layouts.navegacionAdministracion>
</x-layouts.plantillaPrincipal>