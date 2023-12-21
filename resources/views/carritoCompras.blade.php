<x-layouts.plantillaPrincipal title="carrito" meta-description=" esta es la descripcion del carrito">
  
    @php
        $subtotalFinal = 0 ;
    @endphp

    <main class="w-full  " style="height: 100vh">
        <div class="flex flex-col justify-center items-center ">
            <header class="w-11/12  h-20 flex gap-40 border-black border ">
                <div class=" w-56 h-full flex items-center justify-center">
                    <h1>CARRITO COMPRAS</h1>

                </div>
                <div class="w-52 flex items-center justify-start">
                    @auth
                        <span id="cantidadCarrito">Cantidad({{ $acumuladorCantidad }})</span>
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
                    @php
                         $subtotalFinal = 0;
                        
                    @endphp
                        @forelse ($informacionCarrito as $carrito)

                            @php
                                $idCarrito = $carrito->idCarritoCompra;
                                $cantidad = $carrito->cantidadCarrito;
                                $idProducto = $carrito->idProducto;
                                $stockProducto = $carrito->stockProducto;
                                $precioProducto = $carrito->precioProducto;
                                
                                //subtotal base de cada producto 
                                $subtotalIndividual = $cantidad * $precioProducto; 
                                //subtotal base para todos los productos
                                $subtotalFinal +=  $subtotalIndividual; 
                                
                            @endphp
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
                                        @if ($stockProducto <=15)
                                            <div class="flex items-center">
                                                <strong class="text-red-500">stock en linea :({{ $stockProducto}})</strong>
                                            </div>
                                        @endif
                                            
                                        <div class="flex items-center w-44">
                                            <div class="flex gap-3">
                                                @if ($cantidad >= 10)
                                                    <input type="text" value="{{ $cantidad }}" maxlength="3"
                                                        autocomplete="off" onclick="mostrarBoton(this)"
                                                        class=" inputcantidadd border border-black w-12 p-1 box-border h-6" >
                                                @else
                                                    <select name="cantidad" class="miSelect border border-black w-14 "
                                                        onchange='ocultarYMotrar()' data-asociado="inputCantidad">
                                                       
                                                        @for ($i = 1; $i < 10; $i++)
                                                            @if ($cantidad == $i)
                                                                <option value="{{ $i.",".$stockProducto.",".$idCarrito.",".$idProducto }}" selected>
                                                                    {{ $i }}</option>
                                                            @else
                                                                <option value="{{ $i.",".$stockProducto.",".$idCarrito.",".$idProducto }}">{{ $i }}
                                                                </option>
                                                            @endif
                                                        @endfor
                                                        <option value="+10">+10</option>
                                                    </select>
                                                    <input type="hidden" autofocus value="{{ $cantidad }}"
                                                        maxlength="3" autocomplete="off"
                                                        class="inputCantidadd border border-black w-12 p-1 box-border h-6" >
                                                @endif
                                                
                                                <button value="{{$idCarrito.','.$idProducto.','.$stockProducto}}"  class="btnActualizar border border-black">Actualizar</button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-1/5  ">
                                    <div class=" h-14 p-3 flex items-center justify-center text-lg">
                                        <strong class="subtotalIndividual">{{ $precioProducto }}</strong>
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
                        <div class=" w-8/12 flex flex-col items-center">
                            @if (isset($productosAgotados))
                             <div class="border border-solid border-black p-3 h-auto w-80">
                                <p class="text-red-400 text-lg">Productos agotados</p>
                                <ul class="cursor-pointer">
                                 
                                    @foreach ($productosAgotados as $productoAgotado) 
                                        <li class=" text-slate-600 hover:text-slate-950" >-{{ $productoAgotado['nombreProducto'] . " " . $productoAgotado['precioProducto'] }}</li>

                                    @endforeach
                                </ul>
                                </div>
                            @endif 
                            <div class="p-6 flex flex-col gap-5 w-auto" style="height:20%">
                                <div class="border border-black h-14 flex items-center w-56 pl-2 rounded text-lg gap-2">
                                    <strong >Subtotal:</strong>
                                    <p id="totalFinal" >{{$subtotalFinal}}</p>
                                </div>
                            </div>
                            <div class=" flex items-center  flex-col gap-3" style="height: 20%">
                                @if ($subtotalFinal>0)
                                    
                                <a class=" flex  items-center justify-center border border-black w-32 h-10 " href="{{route("factura")}}"  >Generar factura</a>
                                @endif
                                <a href="{{ route('index') }}" class="underline">Continuar comprando</p>

                            </div>
                        </div>
                    @endauth
                </section>
            </div>
        </div>

        <script>
          

            function mostrarBoton(input) {

                // Encuentra el botón hermano del input actual
                let btnActualizar = input.nextElementSibling;

                // Verifica si se encontró un botón antes de intentar cambiar su estilo
                if (btnActualizar && btnActualizar.classList.contains("btnActualizar")) {
                    btnActualizar.style.display = "block";
                } else {
                    console.error("No se encontró el botón asociado al input");
                }
            }

            function verificarCantidad(cantidadAsociada,stockProducto) {

                let resultado = (function(cantidadAsociada,stockProducto) {//función IIFE para encapsular

                    // Expresión regular que coincide con cualquier cosa que no sea un número
                    var expresionRegular = /[^0-9]/;

                    // Verificar si la cadena contiene caracteres que no son números
                    let test =  expresionRegular.test(cantidadAsociada); // true a2b4ca, false 123123 

                    let bandera = false;

                    if(!(test)){//false

                        var cantidad = parseInt(cantidadAsociada, 10);
                        if(stockProducto > 0){

                            if (cantidad <= stockProducto) {

                                if (!isNaN(cantidad) && cantidad > 0) {
                                    bandera = true;
                                }

                            }else{

                                bandera = null;
                            }
                        }else{
                            window.location.reload();
                        }
                    }

                    return bandera;

                })(cantidadAsociada,stockProducto);

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

                    //funcion para borrar los espacios que venga
                    //verificar variables cuando son vacias 
                   
                    
                    if (idCarrito !== null && idProducto !== null &&stockProducto !== null && cantidadAsociada !== undefined && cantidadAsociada.trim() !== '') { // Verifica que no sea una cadena vacía después de eliminar espacios en blanco

                        
                        let bandera =  verificarCantidad(cantidadAsociada,stockProducto);
                        
                        console.log("bandera : "+bandera);
                       
                        if(bandera){
                            
                            actualizarDatos(cantidadAsociada,idCarrito,idProducto,inputAsociado,true);
                        
                        }else if(bandera === false){
                            inputAsociado.value = 1;
                        }else{
                            
                            alert("stock disponible : "+stockProducto);
                            inputAsociado.value = stockProducto;
                        
                        } 

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
                    let hasClicked = false; // Variable para rastrear si ya se hizo clic en el select

                    select.addEventListener("click", function(event) {
                        event.stopPropagation();
                   
                        let opcionSeleccionada = select.options[select.selectedIndex].value;
                       
                        if (!hasClicked) {
                            
                            cargarSelect(select, opcionSeleccionada, inputs, selects,index);
                            hasClicked = true; // Marcar que ya se hizo click para evitar repiticiones
                            
                        }
                    });
                });   
                }

                function cargarSelect(select,opcionSeleccionada,inputs,selects,index){

                    if (opcionSeleccionada == "+10") {
                        select.style.display = "none";

                        // Obtén el input asociado al select clikeado
                        let inputAsociado = inputs[index];
                        inputAsociado.type = "text";

                        let btnActualizar = inputAsociado.nextElementSibling;
                        btnActualizar.style.display = "block";

                      
                    }else{

                        let valores = opcionSeleccionada.split(',');// array de valores la coma es el delimitador de uno y otro valor
                        
                        let opcionSelect = valores[0];
                        let stockProducto = valores[1];
                        let idCarrito = valores[2];
                        let idProducto = valores[3];



                        if (idCarrito !== null && idProducto !== null &&stockProducto !== null && opcionSelect !== undefined && opcionSelect.trim() !== '') {
                            

                            let bandera =  verificarCantidad(opcionSelect,stockProducto);
                            
                            if(bandera){
                                
                                actualizarDatos(opcionSelect,idCarrito,idProducto,0,false);
                            
                            }else if(bandera === false){

                                opcionSeleccionada.value = 1;

                            }else{
                                
                                alert("stock disponible : "+stockProducto);
                                actualizarDatos(stockProducto,idCarrito,idProducto,0,false);
                                //Recorre las opciones y selecciona la que coincide con el nuevo valor
                                for (var i = 0; i < select.options.length; i++) {
                                    
                                    let valores = select.options[i].value.split(',');// array de valores la coma es el delimitador de uno y otro valor      
                                    let opcion = valores[0];

                                    if (opcion == stockProducto) {
                                        
                                        select.options[i].selected = true;
                                        break;
                                    }
                                }

                            } 

                        }

                    }

                }


            function actualizarDatos(cantidad, idCarrito,idProducto,inputAsociado,decision) {

                // xhr.setRequestHeader("X-CSRF-TOKEN", '' + {{ csrf_token() }} + ''); para post , get no lo pide

                if(decision){
                    inputAsociado.nextElementSibling.disabled = true;
                }
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/actualizarCarrito?cantidad=' + cantidad.toString() + "&idCarrito=" +idCarrito+ "&idProducto=" +idProducto, true);
                xhr.setRequestHeader('Content-Type', 'application/json');

                xhr.onreadystatechange = function() {
                    
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        
                        var respuesta = JSON.parse(xhr.responseText);
                        if(decision){

                            inputAsociado.nextElementSibling.disabled = false;
                        }
                                               
                        var respuestaString = JSON.stringify(respuesta);;

                        console.log("respuesta: "+respuestaString);

                        if(respuesta["stock  disponible"] != null){

                            let valor = respuesta["stock  disponible"];

                            console.log("stock en linea : "+valor);
                            if(decision){
                                inputAsociado.value = valor;
                            }
                        }

                        if(respuesta["total"] != null){

                            console.log("total actualizado es : "+respuesta["total"]);
                           
                            let totalYcantidad = respuesta["total"];
                            
                            let valores = totalYcantidad.split(',');// array de valores la coma es el delimitador de uno y otro valor
                        
                           
                            let total = valores[0];
                            let cantidadCarrito = valores[1];

                            let TotalFinal = document.getElementById("totalFinal").innerHTML = total; 
                            let spanCantidad = document.getElementById("cantidadCarrito").innerHTML = "cantidad("+cantidadCarrito+")"; 
                            
                         
                        }
                        
                        
                    }
                };

                // Solo enviar el número directamente
                xhr.send();
               
            }
        </script>



    </main>


</x-layouts.plantillaPrincipal>
