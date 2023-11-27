<x-layouts.plantillaPrincipal 

    title="index"
    meta-description=" esta es la descripcion del index"

>

aaaa



<main class=" h-screen flex  justify-center items-start">
        
    <section class="container  h- w-11/12  " style="height: 90vh" >
        <div class=" text-center w-full h-20 flex items-center  justify-center  ">
            
            <div class="w-full flex ">
                    <div class=" w-full flex ">
                        
                        <div class="w-5/6 pl-72">

                            <p class="text-lg">BICIMOTOS</p>
                            <p>vista welcome</p>
                        </div>
                    
                            
                        @guest
                            
                            <div class=" mr-5 flex gap-3 items-center">
                                <a href="{{route("registro")}}" class="underline">Registro</a>
                                <a href="" class="underline">InciarSession</a>
                            </div>

                        @endguest
                        
                     
                       
                            
                      
                    </div>
                    
              
                
            </div>
        </div>

       
        <div class="bg-white">
            <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="sr-only">Products</h2>
        
            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
              
              
               
                    
                    @foreach ($productos as $producto)
                        
                        <a href="#" class="group">
                            <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                                <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-01.jpg" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="h-full w-full object-cover object-center group-hover:opacity-75">
                            </div>
                            <h3 class="mt-4 text-sm text-gray-700">{{$producto->nombreProducto}}</h3>
                            <div class="flex  justify-between">

                                <p class="mt-1 text-lg font-medium text-gray-900">{{$producto->precioProducto}}</p>
                                <p class="mt-1 text-lg font-medium text-gray-900">stock: {{$producto->stockProducto}}</p>
                            </div>
                            <div class=" flex justify-between">
                                
                                <button>Agregar 🛒</button>
                                <button>Comprar</button>
                            </div>
                            
                        </a>
                    @endforeach
             
                   
             

                        {{-- <a href="#" class="group">
                        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                            <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-02.jpg" alt="Olive drab green insulated bottle with flared screw lid and flat top." class="h-full w-full object-cover object-center group-hover:opacity-75">
                        </div>
                        <h3 class="mt-4 text-sm text-gray-700">Nomad Tumbler</h3>
                        <p class="mt-1 text-lg font-medium text-gray-900">$35</p>
                        </a>
                        <a href="#" class="group">
                        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                            <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-03.jpg" alt="Person using a pen to cross a task off a productivity paper card." class="h-full w-full object-cover object-center group-hover:opacity-75">
                        </div>
                        <h3 class="mt-4 text-sm text-gray-700">Focus Paper Refill</h3>
                        <p class="mt-1 text-lg font-medium text-gray-900">$89</p>
                        </a>
                        <a href="#" class="group">
                        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                            <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-04.jpg" alt="Hand holding black machined steel mechanical pencil with brass tip and top." class="h-full w-full object-cover object-center group-hover:opacity-75">
                        </div>
                        <h3 class="mt-4 text-sm text-gray-700">Machined Mechanical Pencil</h3>
                        <p class="mt-1 text-lg font-medium text-gray-900">$35</p>
                        </a>
                --}}
                <!-- More products... -->
            </div>
            </div>
        </div>

    </section>
</main>



</x-layouts.plantillaPrincipal>