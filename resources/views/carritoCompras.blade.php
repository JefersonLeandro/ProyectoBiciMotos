<x-layouts.plantillaPrincipal title="carrito" meta-description=" esta es la descripcion del carrito">
    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}


    <main class="w-full  " style="height: 100vh">
        <div class="flex flex-col justify-center items-center ">
            <header class="w-11/12  h-20 flex gap-40 border-black border ">
                <div class=" w-56 h-full flex items-center justify-center">
                    <h1>CARRITO COMPRAS</h1>

                </div>
                <div class="w-52 flex items-center justify-start">
                    @auth
                        <span>Cantidad({{ $tamanoCarrito }}),cambiar, sumar es la cantidad de todo</span>
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
            <nav class=" w-full flex justify-end h-10">
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

            <div class="w-11/12  h-full flex pt-5">

                <section class=" w-3/5 p-5 flex flex-col gap-4 ">
                    @auth
                        @forelse ($informacionCarrito as $carrito)
                            <div class="p-3 h-36 rounded flex border-solid border-black border">
                                <div class=" w-1/5  ">
                                    <img src="{{ asset('imagenes/vino.jpg') }}"
                                        alt="Tall slender porcelain bottle with natural clay textured body and cork stopper."
                                        class="h-full w-full object-cover object-center group-hover:opacity-75">
                                </div>
                                <div class=" w-3/5 pl-3 pr-3">
                                    <div class="w-full h-3/5 ">

                                        <p>{{ $carrito->nombreProducto }}</p>
                                    </div>
                                    <div class="w-full h-2/5  flex justify-between pr-9">
                                        <strong>stock en linea :({{ $carrito->stockProducto }})</strong>
                                        {{-- <p>id : {{$carrito->idCarritoCompra}}</p> --}}
                                        
                                        <div class="flex items-center w-44">

                                            @php
                                                $idCarrito = $carrito->idCarritoCompra;
                                                $cantidad = $carrito->cantidadCarrito;
                                                $idProducto = $carrito->idProducto;
                                                $stockProducto = $carrito->stockProducto;
                                            @endphp
                                            {{-- si la cantidad es mayor a 10 poner un input de con la cantidad en vez de mostrar el select --}}
                                            <div class="flex gap-3">
                                                @if ($cantidad >= 10)
                                                    <input type="text" value="{{ $cantidad }}" maxlength="3"
                                                        autocomplete="off" onclick="mostrarBoton(this)"
                                                        class=" inputcantidadd border border-black w-12 p-1 box-border h-6">
                                                @else
                                                    <select name="cantidad" class="miSelect border border-black w-14 "
                                                        onchange='ocultarYMotrar()' data-asociado="inputCantidad">
                                                        <option value="0">0 -Eliminar</option>
                                                        @for ($i = 1; $i < 10; $i++)
                                                            @if ($cantidad == $i)
                                                                <option value="{{ $i }}" selected>
                                                                    {{ $i }}</option>
                                                            @else
                                                                <option value="{{ $i }}">{{ $i }}
                                                                </option>
                                                            @endif
                                                        @endfor
                                                        <option value="+10">+10</option>
                                                    </select>

                                                    <input type="hidden" autofocus value="{{ $cantidad }}"
                                                        maxlength="3" autocomplete="off"
                                                        class="inputCantidadd border border-black w-12 p-1 box-border h-6">
                                                @endif
                                                
                                                <button value="{{$idCarrito.','.$idProducto.','.$stockProducto}}" class="btnActualizar border border-black">Actualizar</button>
                                                
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="w-1/5  ">
                                    <div class=" h-14 p-3 flex items-center justify-center text-lg">
                                        <strong>${{ $carrito->precioProducto }}$</strong>
                                    </div>
                                    <form action="{{ route('eliminarCarrito', $carrito->idCarritoCompra) }} "
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="idCarritoCompra"
                                            value="{{ $carrito->idCarritoCompra }}">
                                        <button
                                            class=" bg-neutral-300 w-full h-14 p-3 flex items-center justify-center text-lg">Eliminar</button>
                                    </form>
                                </div>
                            </div>

                        @empty
                            <p class="text-xl">Tu carrito esta vacio agrega un producto para verlos aqui</p>
                        @endforelse
                    @else
                        <strong class="text-xl">¡Carrito vacio!</strong>
                        <p class="text-lg">Para agregar un producto primero debes iniciar sesion <a
                                href="{{ route('login') }}" class="underline">aqui</a></p>

                    @endauth

                </section>



                <section class=" w-2/5 flex justify-center">
                    @auth
                        <div class=" w-8/12">
                            <div class="p-6 flex flex-col gap-5" style="height:50%">
                                <div class="border border-black h-14 flex items-center pl-2 rounded text-lg gap-2">
                                    <strong>Subtotal:</strong>
                                    <p>400.000</p>
                                </div>
                                <div class="border border-black h-14 flex items-center pl-2 rounded text-lg gap-2">
                                    <strong>Iva - 19% :</strong>
                                    <p>76.000</p>
                                </div>
                                <div class="border border-black h-14 flex items-center pl-2 rounded text-lg gap-2">
                                    <strong> Total :</strong>
                                    476.000
                                </div>
                                <div>
                                    <input type="text" maxlength="3" class=" cuadroT border border-solid border-black">
                                    <button onclick="verificarCantidad()">actulizar</button>
                                </div>
                            </div>
                            <div class=" flex items-center flex-col gap-3" style="height: 20%">
                                <button class="border border-black w-32 h-10 ">Generar factura</button>
                                <a href="{{ route('index') }}" class="underline">Continuar comprando</p>

                            </div>
                        </div>
                    @endauth
                </section>
            </div>
        </div>
        {{-- 
            -hacer la verificacion del stock de manera local
            -hacer la verificacion para datos nulos en la vista del index
            -varificar como se estan menejando ajax con los return 
            -hacer lo de eliminar cuando sea menor a cero 
            -validar las opciones del select con ajax
            
            --}}

        

        <script>
            

            function mostrarBoton(input) {
                console.log("Click sobre mostrar botón");

                // Encuentra el botón hermano del input actual
                let btnActualizar = input.nextElementSibling;

                // Verifica si se encontró un botón antes de intentar cambiar su estilo
                if (btnActualizar && btnActualizar.classList.contains("btnActualizar")) {
                    btnActualizar.style.display = "block";
                } else {
                    console.error("No se encontró el botón asociado al input");
                }
            }

            function verificarCantidad(cantidadAsociada) {

                let resultado = (function(cantidadAsociada) {//función IIFE para encapsular

                    // Expresión regular que coincide con cualquier cosa que no sea un número
                    var expresionRegular = /[^0-9]/;

                    // Verificar si la cadena contiene caracteres que no son números
                    let test =  expresionRegular.test(cantidadAsociada); // true a2b4ca, false 123123 

                    let bandera = false;

                    if(!(test)){//false

                        var cantidad = parseInt(cantidadAsociada, 10);

                        if (!isNaN(cantidad) && cantidad > 0) {
                            console.error("Cantidad válida mayor a cero");
                            bandera = true;
                        } else {
                            console.error("Cantidad no válida o menor/igual a cero");
                            
                        }
                    }
                    
                    console.log("Valor convertido: " + cantidad);

                    return bandera;

                })(cantidadAsociada);

                return resultado;
            }




            //eventos

            var botones = document.querySelectorAll('button.btnActualizar');

            botones.forEach(function(boton) {
                boton.addEventListener("click", function(event) {
                    event.stopPropagation();
                    
                    let inputAsociado = event.target.previousElementSibling;
                    let cantidadAsociada = inputAsociado.value;
                    
                    var valores = boton.value.split(',');// array de valores la coma es el delimitador de uno y otro valor
                    
                    var idCarrito = valores[0];
                    var idProducto = valores[1];
                    var stockProducto = valores[2];
                    
                    console.log(" producto id :"+idProducto);
                    console.log(" carrito id :"+idCarrito);
                    console.log(" stock Producto: "+stockProducto);
                 
                    let bandera =  verificarCantidad(cantidadAsociada);
                    console.log("bandera : "+bandera);

                    if(bandera){
                        actualizarDatos(cantidadAsociada,idCarrito,idProducto,inputAsociado);
                    }else{
                        inputAsociado.value = 1;
                    }
                });
            });




            // Función para ocultar y mostrar elementos
            function ocultarYMotrar() {
                let selects = document.querySelectorAll("select.miSelect");
                let inputs = document.querySelectorAll("input.inputCantidadd");

                selects.forEach(function(select, index) {
                    select.addEventListener("click", function(event) {
                        let opcionSeleccionada = select.options[select.selectedIndex].value;

                        if (opcionSeleccionada == "+10") {
                            console.log("Se hizo clic en un elemento select " + opcionSeleccionada);
                            select.style.display = "none";

                            // Obtén el input asociado al select clicado
                            let inputAsociado = inputs[index];
                            inputAsociado.type = "text";

                            let btnActualizar = inputAsociado.nextElementSibling;
                            btnActualizar.style.display = "block";

                            // Elimina todos los manejadores de eventos anteriores
                            // $(btnActualizar).off('click');

                        }
                    });
                });
            }





            function actualizarDatos(cantidad, idCarrito,idProducto,inputAsociado) {

                // xhr.setRequestHeader("X-CSRF-TOKEN", '' + {{ csrf_token() }} + '');

                console.log("cantidad p " + cantidad + "  id=" + idCarrito+" idProducto : "+idProducto);

                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/actualizarCarrito?cantidad=' + cantidad.toString() + "&idCarrito=" +idCarrito+ "&idProducto=" +idProducto, true);
                xhr.setRequestHeader('Content-Type', 'application/json');

                xhr.onreadystatechange = function() {
                    
                    if (xhr.readyState === 4 && xhr.status === 200) {

                        var respuesta = JSON.parse(xhr.responseText);

                        console.log("respuesta aaa  : "+respuesta);                        
                        var respuestaString = JSON.stringify(respuesta);;

                        console.log("respuesta:"+respuestaString);

                        if(respuesta["stock  disponible"] != null){

                            let valor = respuesta["stock  disponible"];
                            inputAsociado.value = valor;
                        }
                      
                    }
                };

                // Solo enviar el número directamente
                xhr.send();
                console.log("cantidad f " + cantidad.toString());
            }
        </script>



    </main>


</x-layouts.plantillaPrincipal>
