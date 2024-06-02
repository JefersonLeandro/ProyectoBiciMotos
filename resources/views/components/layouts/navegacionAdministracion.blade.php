<main class=" h-screen bg-slate-100">
    
    <header class=" alto22Vh">
        <div class=" pl-8 flex items-center  justify-start h-12 bg-slate-300">
            <h3 class="text-xl pr-28">Area de administracion</h3>
            
            <div>
                <form class="flex gap-2" action='{{ $search ?? " " }}' method="get">
                    @csrf
                    <a href="{{ $ruta ?? ' '}}">
                        <svg class="h-7 w-7 text-slate-900 "   fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </a>
                        
                    <input type="search" name="fBuscar" id="inputBuscar" placeholder="{{ $placeholder ?? '' }}" value="{{ $valor ?? '' }}" class=" px-2 rounded w-72 " required>
                    
                    @isset($columnas)    
                        <select name="fOpcion" id="selectBuscar" >
                            @foreach ($columnas as $columna)
                                <option  value="{{$columna}}" {{ (isset($columnaSeleccionada) && $columna == $columnaSeleccionada ) ? "Selected" : '' }}>{{$columna}}</option>
                            @endforeach
                        </select>
                    @endisset 
                
                    <button type="submit">buscar</button>
                </form>
            </div>
            
        </div>
        <div class="bg-slate-300 pl-8 h-24">
            <div class="flex justify-between pr-20">
                <p class="text-lg">tablas</p>
                <a href="{{route('index')}}">home</a>

            </div>
            <div class="flex  pt-2 gap-3 h-14  pl-6 scrollTablas">
                <div class="rounded-t flex  justify-center items-center w-20 h-8   cursor-pointer {{request()->routeIs("areaAdmin") ? 'text-black bg-white' : 'text-slate-700 bg-slate-400'}} ">
                    <a href="{{route("areaAdmin")}}">Usuarios</a>    
                </div>
                <div class="rounded-t flex   justify-center items-center w-20 h-8   cursor-pointer {{request()->routeIs("tablaRoles") ? 'text-black bg-white' : 'text-slate-700 bg-slate-400'}} ">
                    <a href="{{route("tablaRoles")}}">Roles</a>   
                </div>
                <div class="rounded-t flex   justify-center items-center w-20 h-8   cursor-pointer {{request()->routeIs("tablaProducto") ? 'text-black bg-white' : 'text-slate-700 bg-slate-400'}} ">
                    <a href="{{route("tablaProducto")}}">Productos </a>    
                </div>
                <div class="rounded-t flex   justify-center items-center w-20 h-8   cursor-pointer {{request()->routeIs("tablaImagen") ? 'text-black bg-white' : 'text-slate-700 bg-slate-400'}} ">
                    <a href="{{route("tablaImagen")}}">Imagenes</a>    
                </div>
                <div class="rounded-t flex   justify-center items-center w-20 h-8   cursor-pointer  {{request()->routeIs("tablaFactura") ? 'text-black bg-white' : 'text-slate-700 bg-slate-400'}}">
                    <a href="{{route("tablaFactura")}}">Facturas</a>    
                </div>
                <div class="rounded-t flex   justify-center items-center w-36 h-8   cursor-pointer {{request()->routeIs("tablaDetallesFactura") ? 'text-black bg-white' : 'text-slate-700 bg-slate-400'}} ">
                    <a href="{{route("tablaDetallesFactura")}}">Detalles Facturas</a>    
                </div>
            </div>
        </div>
    </header>

    {{$slot}}
   

</main>