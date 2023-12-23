 
<x-layouts.plantillaPrincipal title="factura" meta-description=" esta es la descripcion de la factura">


    <main class="  flex items-center justify-center w-full" style="height:105vh;">
        
        <div class=" w-6/12 border border-solid border-black " style="height: auto; ">

            <div class="flex justify-between items-center bg-slate-200 pl-2 pr-2 h-12">
                <h1 class="text-2xl ">BiciMotos </h1>
                <h2 class="text-xl">Factura de venta</h2>
               
            </div>
            <div class="w-full h-96  flex flex-col gap-4  p-4 pt-7  " style="height: 93%;">
                <div class="flex justify-between border-solid  border-b-2 text-base border-b-slate-900">
                    <p>{{Auth::user()->nombreUsuario}}</p>
                    <div class="flex gap-3">
                        <p id="fecha">fecha : {{$fechaActual}}</p>
                    <script>
                        const today = new Date();
                        let date = today.getDate()+"-"+today.getMonth()+"-"+today.getFullYear();

                        // let pFecha = document.querySelector("#fecha");
                        // pFecha.innerHTML = "fecha :  "+date;
                        console.log("date : "+today); 
                    </script>
                        <p>home</p>
                    </div>
                    
                </div>
                <div class=" h-full">
                     <p class="text-xl">Productos</p>

                     @php
                         $subtotalBase = 0 ;
                     @endphp

                    <div class=" ScrollFactura w-full h-auto  text-xl flex flex-col items-center">
                        <table class=" w-full  p-4 rounded-md shadow-md">
                            <thead class="">
                                <th class="py-2 px-4 text-center">Nombre</th>
                                <th class="py-2 px-4 text-center">Cantidad</th>
                                <th class="py-2 px-4 text-center">Precio</th>
                                <th class="py-2 px-4 text-center">Subtotal</th>
                            </thead>
                            
                                <tbody >
                                @foreach ($informacionFactura as $laFactura)
                                    
                                <tr class="bg-slate-50  hover:bg-white ">
                                    <td class="py-2 px-4 text-center">{{$laFactura->nombreProducto}}</td>
                                    <td class="py-2 px-4 text-center">{{$laFactura->cantidadDetalle}}</td>
                                    <td class="py-2 px-4 text-center">{{$laFactura->precioProducto}}</td>
                                    <td class="py-2 px-4 text-center">{{$laFactura->subtotalDetalle}}</td>
                                </tr>

                                    @php
                                        $precio =  $laFactura->precioProducto;
                                        $cantidad = $laFactura->cantidadDetalle;
                                        $subtotalIndividual = $precio * $cantidad;
                                        $subtotalBase += $subtotalIndividual; 
                                        $total = $laFactura->totalFactura;
                                    @endphp
                                
                                @endforeach
                               
                              
                                
                            </tbody>
                        </table>
                        
                        
                    </div>
                    <div class=" flex items-start justify-center h-16  ">
                    
                        <div class="w-full h-16 pr-10">
                            <div class="w-full h-full   flex " >
                                <div class=" text-xl h-auto  flex justify-start items-center  pl-10" style=" width: 55%;">
                                    @php
                                        // total // 354192 es este ya que me genera de los producto comprados actuales y no de todos hacer logicas para solos del momento
                                        $iva = $subtotalBase * 0.19;
                                        $totalFinal = $iva+$subtotalBase; //369066.6
                                    @endphp
                                    <strong> Total : {{$total}}</strong>
                                </div>
                                <div class="  flex flex-col justify-end text-end " style="width: 45%">
                                    <div>
                                        <strong class="border-solid  border-b-2 border-b-slate-900  text-center">Subtotal base : {{$subtotalBase}}</strong>
                                    </div>
                                    <div class=" flex justify-end ">
                                        <p class="  border-solid border border-b-2 border-b-slate-900"> Iva-19% : {{$iva}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                    </div>
                    
                    <div class="flex justify-center text-lg items-end  h-12 ">
                        <strong>¡ Gracias por su compra !</strong>
                    </div>
                    

                </div>
                
               
                
            </div>
        </div>
    </main>




</x-layouts.plantillaPrincipal>