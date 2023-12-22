 
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
                    <script>
                        // Date date =new Date();
                        // console.log(date);
                    </script>
                    <div class="flex gap-3">
                        <p>fecha : 19/12/2023 </p>
                        <p>home</p>
                    </div>
                    
                </div>
                <div class=" h-full">
                     <p class="text-xl">Productos</p>

                    <div class=" ScrollFactura w-full h-auto  text-xl flex flex-col items-center">
                        <table class=" w-full  p-4 rounded-md shadow-md">
                            <thead class="">
                                <th class="py-2 px-4 text-center">Nombre</th>
                                <th class="py-2 px-4 text-center">Cantidad</th>
                                <th class="py-2 px-4 text-center">Precio</th>
                                <th class="py-2 px-4 text-center">Subtotal</th>
                            </thead>
                            
                                <tbody  >
                                  
                                <tr class="bg-slate-50  hover:bg-white ">
                                    <td class="py-2 px-4 text-center">Mouse</td>
                                    <td class="py-2 px-4 text-center">x 4</td>
                                    <td class="py-2 px-4 text-center">35.000</td>
                                    <td class="py-2 px-4 text-center">140.000</td>
                                </tr>
                                <tr class="bg-slate-50 hover:bg-white ">
                                    <td class="py-2 px-4 text-center">Mouse</td>
                                    <td class="py-2 px-4 text-center">x 4</td>
                                    <td class="py-2 px-4 text-center">35.000</td>
                                    <td class="py-2 px-4 text-center">140.000</td>
                                </tr>
                                <tr class="bg-slate-50 hover:bg-white ">
                                    <td class="py-2 px-4 text-center">Mouse </td>
                                    <td class="py-2 px-4 text-center">x 4</td>
                                    <td class="py-2 px-4 text-center">35.000</td>
                                    <td class="py-2 px-4 text-center">140.000</td>
                                </tr>
                                <tr class="bg-slate-50 hover:bg-white ">
                                    <td class="py-2 px-4 text-center">Mouse</td>
                                    <td class="py-2 px-4 text-center">x 4</td>
                                    <td class="py-2 px-4 text-center">35.000</td>
                                    <td class="py-2 px-4 text-center">140.000</td>
                                </tr>
                                <tr class="bg-slate-50 hover:bg-white ">
                                    <td class="py-2 px-4 text-center">Mouse</td>
                                    <td class="py-2 px-4 text-center">x 4</td>
                                    <td class="py-2 px-4 text-center">35.000</td>
                                    <td class="py-2 px-4 text-center">140.000</td>
                                </tr>
                                <tr class="bg-slate-50">
                                    <td class="py-2 px-4 text-center">Mouse</td>
                                    <td class="py-2 px-4 text-center">x 4</td>
                                    <td class="py-2 px-4 text-center">35.000</td>
                                    <td class="py-2 px-4 text-center">140.000</td>
                                </tr>
                                <tr class="bg-slate-50">
                                    <td class="py-2 px-4 text-center">Mouse</td>
                                    <td class="py-2 px-4 text-center">x 4</td>
                                    <td class="py-2 px-4 text-center">35.000</td>
                                    <td class="py-2 px-4 text-center">140.000</td>
                                </tr>
                                <tr class="bg-slate-50">
                                    <td class="py-2 px-4 text-center">Mouse</td>
                                    <td class="py-2 px-4 text-center">x 4</td>
                                    <td class="py-2 px-4 text-center">35.000</td>
                                    <td class="py-2 px-4 text-center">140.000</td>
                                </tr>
                                <tr class="bg-slate-50">
                                    <td class="py-2 px-4 text-center">Mouse</td>
                                    <td class="py-2 px-4 text-center">x 4</td>
                                    <td class="py-2 px-4 text-center">35.000</td>
                                    <td class="py-2 px-4 text-center">140.000</td>
                                </tr>
                                <tr class="bg-slate-50">
                                    <td class="py-2 px-4 text-center">Mouse</td>
                                    <td class="py-2 px-4 text-center">x 4</td>
                                    <td class="py-2 px-4 text-center">35.000</td>
                                    <td class="py-2 px-4 text-center">140.000</td>
                                </tr>
                                <tr class="bg-slate-50">
                                    <td class="py-2 px-4 text-center">Mouse</td>
                                    <td class="py-2 px-4 text-center">x 4</td>
                                    <td class="py-2 px-4 text-center">35.000</td>
                                    <td class="py-2 px-4 text-center">140.000</td>
                                </tr>
                                <tr class="bg-slate-50">
                                    <td class="py-2 px-4 text-center">Mouse</td>
                                    <td class="py-2 px-4 text-center">x 4</td>
                                    <td class="py-2 px-4 text-center">35.000</td>
                                    <td class="py-2 px-4 text-center">140.000</td>
                                </tr>
                               
                              
                                
                            </tbody>
                        </table>
                        
                        
                    </div>
                    <div class=" flex items-start justify-center h-16  ">
                    
                        <div class="w-full h-16 pr-10">
                            <div class="w-full h-full   flex " >
                                <div class=" text-lg h-auto  flex justify-start items-center  pl-10" style=" width: 55%;">
                                    <strong> Total : 499.800</strong>
                                </div>
                                <div class="  flex flex-col justify-end text-end " style="width: 45%">
                                    <div>
                                        <strong class="border-solid  border-b-2 border-b-slate-900  text-center">Subtotal base :  420.000</strong>
                                    </div>
                                    <div class=" flex justify-end ">
                                        <p class="  border-solid border border-b-2 border-b-slate-900"> Iva-19% : 79.800</p>
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