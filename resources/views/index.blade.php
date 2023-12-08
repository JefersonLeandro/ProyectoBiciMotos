<x-layouts.plantillaPrincipal 

    title="index"
    meta-description=" esta es la descripcion del index"

>


<main class=" w-full h-screen flex  justify-center items-start ">
        
    <section class="  w-full " style="height: 90vh" >
        <div class=" text-center w-full h-20 flex items-center  justify-center  ">
            
            <div class="w-full ">
                        
                    <div class="w-full  flex  h-20  gap-3">
                        <div class=" w-6/12 h-full flex items-center justify-center">
                            <h2 class="text-xl">BICIMOTOS</h2>

                        </div>
                        

                        <div  class=" ancho30 h-full flex justify-center items-center" >
                            <ul class="flex gap-4 justify-center items-center">

                                @auth
                                    <li class=" underline cursor-pointer"><a href="{{route("carrito")}}">carrito({{$tamanoCarrito}})</a></li>
                                @else
                                    <li class=" underline cursor-pointer"><a href="{{route("carrito")}}">Carrito(0)</a></li>

                                @endauth

                                <li class=" underline">item</li>
                                <li class=" underline">item</li>
                                <li class=" underline">item</li>
                                <li class=" underline">item</li>
                            </ul>
                        </div>


                        @guest
                            
                            <div class=" ancho20 flex gap-3 items-center ">
                                <a href="{{route("registro")}}" class="underline">Registro</a>
                                <a href="{{route("login")}}" class="underline">InciarSession</a>
                            </div>

                        @endguest


                        @auth
                            <form class=" ancho20 flex gap-3 items-center " method="POST" action="{{route("auth.logout")}}">
                                @csrf

                                <button type="submit" class="underline" >Cerrar session</a>
                                
                            </form>
                            
                        @endauth
                    </div>
            </div>
        </div>

       
        <div class="bg-white">
            <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2>productos </h2>
            @auth
                     
                <strong>usuario atenticado</strong>
                <!-- Contenido para usuarios autenticados -->
            @else
                    <!-- Contenido para usuarios no autenticados -->
                    <strong>Usuario no autenticado</strong>
            @endauth                            

            <pre>{{Auth::user()}}--final</pre>
        
            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                    

                @if (isset($productos))
                    
                @foreach ($productos as $producto)
                    
                    <div href="#" class=" flex flex-col">
                        <a href="#">
                            <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                                <img src="{{asset('imagenes/vino.jpg') }} " alt="vinoooooooo" class="h-full w-full object-cover object-center group-hover:opacity-75">
                            </div>
                        </a>
                        <h3 class="mt-4 text-sm text-gray-700">{{$producto->nombreProducto}}</h3>
                        <div class="flex  justify-between">

                            <p class="mt-1 text-lg font-medium text-gray-900">{{$producto->precioProducto}}</p>
                            <p class="mt-1 text-lg font-medium text-gray-900">stock: {{$producto->stockProducto}}</p>
                        </div>
                        
                        @auth

                            <form class=" flex justify-between" action="{{route("agregarCarrito",$producto->idProducto)}}" method="POST">
                                @csrf
                                <button>Agregar 🛒</button>
                                <button type="button">Comprar</button>
                            </form>
                            

                        @else
                            <div>
                                <a href="{{route("login")}}" class=" flex justify-between" >
                                
                                    <button>Agregar 🛒</button>
                                    <button type="button">Comprar</button>
                                </a>
                            </div>
                        @endauth 
                    </div>
                @endforeach
                @endif
             

            </div>
            </div>
        </div>

    </section>
</main>



</x-layouts.plantillaPrincipal>