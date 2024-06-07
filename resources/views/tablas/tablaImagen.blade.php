<x-layouts.plantillaPrincipal

title="tabla  imagen "
meta-description="Esta es la descripcion de la tabla imagen"
>
<x-layouts.navegacionAdministracion 
search="{{route('busquedaImagenes')}}"
placeholder="Buscar imagenes"
:columnas="['Id-producto','Nombre-producto','Nombre-imagen','Tipo-imagen' ]"
:campo="$campo ?? '' "
>

<section class=" flex  w-full" style="height: 80vh;" >
    <div class="  flex flex-col  pt-5 items-center " style="width: 30% ; height: 95%;">
        <div class="border border-solid rounded  bg-slate-300 w-4/5" style="height: 75%;">

            <h3 class="text-lg pl-8 my-3">Buscar un producto</h3>
            <form class="  pl-10" action="{{route("crudTablaImagen")}}" method="post">
                @csrf
                <input type="search" name="valor" required class="w-60 h-8 p-2" value="{{isset($valor) ? $valor : ''}}" placeholder="Nombre o descripcion">
                <button class="bg-slate-500 rounded w-14 h-7" name="fAccion" value="buscar">buscar</button>
            </form>
            <div class=" h-80  flex pl-10 pt-5   ">
                <div class="border border-solid w-11/12  h-72   border-black border-x-2 border-y-2  scrollBusqueda ">
                    <ul class="lista ">
                    
                            @if ( isset($productosEncontrados))
                            @foreach ($productosEncontrados as $unProducto)
                            
                                @if($unProducto['nombreProducto']=="nose encontraron concidencias")

                                    <li>{{$unProducto['nombreProducto']}}</li>
                           
                                @else
                                <div class=" divContainer bg-slate-200  px-2 border-b-2 hover:text-white cursor-pointer flex flex-col  border-solid  border-black" style="height: 59px">
                                    
                                    <div class="flex justify-end gap-2 pt-1">
                                        <p>#id</p>
                                        <strong class="bg-slate-500 w-auto px-2 text-white text-center rounded-md strongIdProducto">{{$unProducto->idProducto}}</strong>
                                    </div>
                                    <li class="text-lg">{{$unProducto->nombreProducto." ".$unProducto->precioProducto }}</li>
                                  
                                    
                                </div>

                                @endIf
                            @endforeach
                            @endif
                    </ul>
                </div>
                
            </div>
        </div>
        <div class=" pl-12 p-4">
            <p class="text-lg">Recuerda el id del producto solicitado lo puedes encontrar arriba en la caja de busqueda. </p>
        </div>
    </div>
    {{-- <div class="border-2  border-solid border-l-black border-r-black "></div> --}}
    <div class=" pl-2 pt-3" style="width: 69%;">
        <div class="py-2 px-3 flex flex-col gap-3 border border-solid border-black bg-slate-300  ">
            <h3 class="text-lg">Insertar una imagen</h3>
            <form action="{{route("crudTablaImagen")}}" method="post" class=" px-6 flex gap-4">
                @method("post")
                @csrf
                <div class="flex flex-col gap-2">
                    
                    <label for="">nombreImagen</label>
                    <input type="file" name="nombreImagen" class="" required >
                </div>
                <div class="flex flex-col gap-2">
                    
                    <label for="">tipoImagen</label>
                    <select name="tipoImagen" id=""  required>
                        <option value="" disabled selected>Selecciona</option>
                        <option value="0">Primaria</option>
                        <option value="1">Secundaria</option>
                    </select>
                </div>
                <div class="flex flex-col gap-2">
                    
                    <label for="">idProducto</label>
                    <input type="number" id="inputIdProducto" name="idProducto" class="pl-2 w-24" required>
                </div>
                <div class="flex gap-2 h-14 items-end">
                    <button type="submit"  name="fAccion" value="insertar" class="bg-slate-400 h-8 w-16 rounded ">insertar</button>
                    <button type="reset" class=" bg-amber-300 h-8 w-16 rounded">Limpiar</button>

                </div>
            </form>
        </div>
        <div class=" h-4/5">

            <div class="p-5 ">
                <div class="   scrollTablaImagen " style="width: 75%">
                <table class="  " style="width: 100%; height:full;">
            
                    <thead class="bg-slate-400 h-12 ">
                        <th class="py-2 px-3 text-start w-60  ">Nombre de la imagen  </th>
                        <th class="py-2 px-3 text-start w-44 pl-6  "  >Tipo de imagen </th>
                        <th class="py-2 px-2 text-center w-40  " >idProducto</th>
                        <th class="py-2 px-3 w-38 "></th>
                    </thead>
                    <tbody class="">

                        @if (!empty($imagenes))
                            @foreach ($imagenes as $unaImagen)
                                @php
                                    $tipoImagen = $unaImagen->tipoImagen;
                                @endphp
                                
                                <tr class="h-10">
                                    <form action="{{route("crudTablaImagen")}}" method="post" class="" >
                                        @csrf
                                        <td class=" py-2 text-center w-44 ">
                                            <input type="hidden" name="idImagen" value="{{$unaImagen->idImagen}}">
                                            <input type="text" name="nombreImagen" class="h-7 px-2 rounded w-56 bg-slate-300" required readonly value="{{$unaImagen->nombreImagen}}">
                                        </td>
                                        <td class=" py-2 text-center w-44">

                                            
                                            <select name="tipoImagen" class="w-32" id="">
                                                @if ($tipoImagen == 0)
                                                    <option value="0" selected >Primaria</option>
                                                    <option value="1">Secundaria</option>
                                                @else
                                                    <option value="0" >Primaria</option>
                                                    <option value="1" selected>Secundaria</option>
                                                @endif
                                            </select>
                                            
                                        </td>
                                        <td class=" py-2 text-center  w-40   "><input type="number" name="idProducto"  class="  h-7 px-2 rounded w-32" required  value="{{$unaImagen->idProducto}}"></td>
                                        
                                        <td class="py-2 pl-3">
                                            <button class="bg-slate-400 w-20 h-7 rounded " name="fAccion" value="modificar">Modificar</button>
                                            <button class="bg-red-300 w-20 h-7 rounded " name="fAccion" value="eliminar">Eliminar</button>
                                        </td>
                                    </form>
                                </tr>
                            @endforeach
                        @else
                        <tr>
                            <td class="pt-7 pl-7">
                                <p>No hay imagenes disponibles.</p>    
                            </td>
                        </tr>
                        @endif  
                    </tbody>
                </table>
                </div>
            </div>
        </div>

    </div>
   
    <script>
        let listaItems = document.querySelectorAll(".lista .divContainer");
        let inputIdProducto = document.querySelector("#inputIdProducto");
    
        // Iterar sobre cada elemento .bg-slate-200 utilizando forEach
        listaItems.forEach(function(div) {
            // Agregar un manejador de clic para cada elemento .bg-slate-200
            div.addEventListener("click", function(event) {
                // Imprimir un mensaje en la consola cuando se hace clic en un elemento .bg-slate-200
                console.log("Se hizo clic en un elemento con clase 'divContainer'");
    
                // Obtener el valor del elemento <strong> dentro del elemento clicado
                let strong = div.querySelector(".strongIdProducto");
    
                console.log("Valor del strong: " + strong.textContent);
                idProducto = parseInt(strong.textContent);
                inputIdProducto.value = idProducto;
            });
        });
    </script>
    


</section>      
</x-layouts.navegacionAdministracion>
</x-layouts.plantillaPrincipal>