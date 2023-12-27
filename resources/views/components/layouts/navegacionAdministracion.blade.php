<main class=" h-screen bg-slate-100" >
    
    <header class=" alto22Vh">
        <div class=" pl-8 flex items-center  justify-between h-12   text-xl bg-slate-300">
            <h3>Area de administracion</h3>

        </div>
        <div class="bg-slate-300 pl-8 h-24">
            <div class="flex justify-between pr-20">
                <p class="text-lg">tablas</p>
                <p>home</p>

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
    <div class="  pl-10 pt-5 pr-10 flex flex-col justify-start items-start " style="height: 79vh;">
        {{$slot}}
    </div>

</main>