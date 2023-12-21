<x-layouts.plantillaPrincipal title="factura" meta-description=" esta es la descripcion de la factura">


    <main class=" border border-solid border-black flex items-center justify-center bg-sky-300 w-full" style="height:105vh;">
        
        <div class=" w-6/12 bg-amber-400 " style="height: 90vh; ">

            <div class="flex  justify-between items-center bg-slate-200 pl-2 pr-2 h-12">
                <h1 class="text-2xl ">BiciMotos </h1>
                <h2 class="text-xl">Factura de venta</h2>
               
            </div>
            <div class="w-full h-  flex flex-col gap-4 bg-green-400 p-4 pt-7  " style="height: 85%;">
                <div class="flex justify-between">
                    <p>Camilo Suarez Martinez</p>
                    <script>
                        // Date date =new Date();
                        // console.log(date);
                    </script>

                    <p>fecha : 19/12/2023 fija</p>
                </div>
                <div class="bg-red-400 h-3/4">
                     <p class="text-xl">Productos</p>

                    <div class="w-full bg-slate-100 text-xl flex flex-col items-center">
                        <table class="w-full bg-purple-500 p-4 rounded-md shadow-md">
                            <thead class="text-white">
                                <th class="py-2 px-4 text-center">Producto</th>
                                <th class="py-2 px-4 text-center">Cantidad</th>
                                <th class="py-2 px-4 text-center">Precio</th>
                                <th class="py-2 px-4 text-center">Subtotales</th>
                            </thead>
                            <tbody>
                                <tr class="bg-amber-200">
                                    <td class="py-2 px-4 text-center">Mouse</td>
                                    <td class="py-2 px-4 text-center">x 4</td>
                                    <td class="py-2 px-4 text-center">35.000</td>
                                    <td class="py-2 px-4 text-center">140.000</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-4 text-center">Mouse</td>
                                    <td class="py-2 px-4 text-center">x 4</td>
                                    <td class="py-2 px-4 text-center">35.000</td>
                                    <td class="py-2 px-4 text-center">140.000</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-4 text-center">Mouse</td>
                                    <td class="py-2 px-4 text-center">x 4</td>
                                    <td class="py-2 px-4 text-center">35.000</td>
                                    <td class="py-2 px-4 text-center">140.000</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="bg-sky-400 py-2 px-4 text-center">
                                        <strong class="bg-sky-200 border-solid border border-t-4 border-t-slate-900 py-2 px-4">420.000</strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        
                        
                        <div class="w-full h-20">
                            <div class="w-full h-1/2 pl-4 pr-8 flex justify-end items-end bg-sky-400">
                                <p> Iva-19% : 79.800</p>
                            </div>
                            <div class="w-full  h-1/2 pl-4 pr-8 flex justify-end bg-sky-400">
                                <strong> Total : 499.800</strong>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="bg-amber-500 flex justify-center ">
                    <strong>!Gracias por su compra</strong>
                </div>
                
            </div>
        </div>
    </main>




</x-layouts.plantillaPrincipal>