<x-layouts.plantillaPrincipal 

    title="carrito"
    meta-description=" esta es la descripcion del carrito"

>



<main class="w-full  " style="height: 100vh">
    <div class="flex flex-col justify-center items-center ">
        <header class="w-11/12  h-20 flex gap-40 border-black border ">
          <div class=" w-56 h-full flex items-center justify-center" >
            <h1>CARRITO COMPRAS</h1>
      
          </div>
          <div class="w-52 flex items-center justify-start">
            @auth
              <span>Cantidad({{$tamanoCarrito}})</span>

            @else
              <span>Cantidad(0)</span>
            @endauth
          </div>
          <div class="flex items-center justify-start list-none  gap-5 w-2/5 ">
            <li>items</li>
            <li>items</li>
            <li>items</li>
            <li>items</li>
          </div>
      
        </header>
        <nav class=" w-full flex justify-end h-10" >
          <div class=" gap-4 pr-14 flex  w-56">
              <div class="border-solid border-black border border-t-0 rounded-b-md">   
                home
              </div>
              <div class="border-solid  border-black border  border-t-0 rounded-b-md">
                item
              </div>
              <div class="border-solid  border-black border  border-t-0 rounded-b-md">
                item
              </div>
          </div>
        </nav>
    </div>
    <div class="w-full flex items-center justify-center h-4/5">
      
      <div class="w-11/12  h-full flex pt-5" >
        
        <section class=" w-3/5 p-5 flex flex-col gap-4 ">
          @auth  
            @foreach ($informacionCarrito as $carrito)
            
            
            <div class="p-3 h-36 rounded flex border-solid border-black border">
              <div class=" w-1/5  ">
                <img src="{{asset('imagenes/vino.jpg') }}" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="h-full w-full object-cover object-center group-hover:opacity-75">
              </div>
              <div class=" w-3/5 pl-3 pr-3">
                  <div class="w-full h-3/5 ">
                  
                    <p>{{$carrito->nombreProducto}}</p>
                  </div>
                  <div class="w-full h-2/5  flex justify-between pr-9">
                    <strong>stock en linea :({{$carrito->stockProducto}})</strong>
                    <div class="flex items-center w-44">
                      <button type="button" class=" w-10 h-10 border border-black  text-xl ">
                        +
                      </button>
                      <span class="w-10 border border-black h-10 text-xl flex items-center justify-center">{{$carrito->cantidadCarrito}}</span>
                      <button class="w-10 border border-black h-10 text-2xl">-</button>
                    </div>
                  </div>              
                </div>
                <div class="w-1/5  ">
                  <div class=" h-14 p-3 flex items-center justify-center text-lg">
                    <strong>${{$carrito->precioProducto}}$</strong>  
                  </div>
                  <form action="{{route("eliminarCarrito",$carrito->idCarritoCompra)}} " method="POST">
                    @csrf
                    <input type="hidden" name="idCarritoCompra" value="{{$carrito->idCarritoCompra}}">
                    <button class=" bg-neutral-300 w-full h-14 p-3 flex items-center justify-center text-lg">Eliminar</button>
                  </form>
                </div>
              </div>
            @endforeach
              
          @else
              <strong class="text-xl">¡Carrito vacio!</strong>
              <p class="text-lg">Para agregar un producto primero debes iniciar sesion <a href="{{route('login')}}" class="underline">aqui</a></p>

          @endauth
          
        </section>
     
            
        
        <section class=" w-2/5 flex justify-center">
          @auth
          <div class=" w-8/12">
            <div class="p-6 flex flex-col gap-5" style="height:50%">
              <div class="border border-black h-14 flex items-center pl-2 rounded text-lg gap-2">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                <strong>Subtotal: </strong>
                <p>400.000</p>
              </div>
              <div class="border border-black h-14 flex items-center pl-2 rounded text-lg gap-2">
                <strong>Iva - 19% :</strong>
                <p>76.000</p>
              </div>
              <div class="border border-black h-14 flex items-center pl-2 rounded text-lg gap-2">
                <strong>  Total :</strong>
              476.000
              </div>
            </div>
            <div class=" flex items-center flex-col gap-3" style="height: 20%">
              <button class="border border-black w-32 h-10 ">Generar factura</button>
                <a href="{{route("index")}}" class="underline">Continuar comprando</p>
                
            </div>
          </div>
          @endauth
        </section>
      </div>
    </div>

 
</main>


</x-layouts.plantillaPrincipal>