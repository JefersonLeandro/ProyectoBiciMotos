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
            <div class="mx-auto max-w-2xl px-4 sm:px-6 pt-10 lg:max-w-7xl lg:px-8">
            @auth
                <div class="h-20 flex flex-col gap-1">

                    <p>{{Auth::user()->nombreUsuario}}</p>
                    <nav >
                        <ul class="flex gap-5">
                            <li>Perfil</li>
                            <li>item</li>
                            <li>item</li>
                        </ul>
                    </nav>
                </div>
            @endauth  


            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                    

                @if (isset($productos))
                    
                @foreach ($productos as $producto)

                    @php
                        $stockProducto = $producto->stockProducto;
                    @endphp
                    
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
                        
                       

                            @if ($stockProducto > 0)
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

                            @else
                                <p class="text-red-400">Producto sin stock</p>

                            @endif
                        
                        
                    </div>
                @endforeach
                @endif
             

            </div>
            </div>
            <footer>
                <div class=" h-32  flex items-center justify-center gap-5">
                    
                    <strong>Hacer un pie de pagina</strong>
                    <p>ideas : acerca de nosotros , las redes con logos etc... </p>
                </div>
            </footer>
        </div>

    </section>
</main>



</x-layouts.plantillaPrincipal>