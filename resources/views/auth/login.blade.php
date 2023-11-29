<x-layouts.plantillaPrincipal

title="login"
meta-description="Esta es la descripcion de login"
>

<main class="flex justify-center items-center " style="height: 70vh">
    
    <div class="bg-zinc-100  w-1/3  rounded  " id="boxShadow" style="height: 55vh;">
        <div class=" pl-10 h-16 w-auto flex items-center  mt-3 ">
            <h1 class=" text-black-600 text-3xl" >Login</h1>
        
        </div>
        <form action="{{route("auth.Usuario")}}" method="POST">
            
            @csrf
            <div class="flex w-full  justify-center h-auto ">
                <div class="flex flex-col w-96 gap-3 pt-3  h-auto ">
                 
                    <div class="flex flex-col h-20">
                        <label for="" class="font-semibold ">Email</label>
                        <input type="email" class="rounded h-12 border border-gray-400 p-2" name="email" placeholder="Su email... " value="{{old("email")}}">
                        <small class="text-red-500">el campo debe conterner al menos 4 carateres</small>
                        @error('email')
                            <small class="text-red-500">{{$message}}</small>
       
                         @enderror
                         
                    </div>
                    <div class="flex flex-col h-20">
                        <label for="" class="font-semibold ">Contraseña</label>
                        <input type="password" class="rounded h-12 border border-gray-400 p-2"  name="password" placeholder="Su contrasena.. " >
                        <small class="text-red-500">el campo debe conterner al menos 4 carateres</small> 
                        @error('password')

                            <small class="text-red-500">{{$message}}</small>
       
                        @enderror
                        
                    </div>
                   
                </div>

            </div>
            
           
            <div class="h-20 flex flex-col items-center justify-center ">

                <span class="cursor-pointer hover:underline">¿Olvido su contrasena?</span>
                <a class="cursor-pointer hover:underline" href="{{route("registro")}}">Crear una cuenta</a>
            </div>
            

            <div class="flex justify-center h-14 items-center " >
                <div class="  w-5/6 h-12 flex  justify-between  gap-5  flex items-center">
                    
                    <a href="{{route("index")}}" class="text-lg hover:underline w-20 text-center">
                        Regresar
                    </a>
                    <div class= " h-auto w-32 rounded flex items-center justify-center text-lg   ">
                        
                        
                        <button class="bg-white   text-black-600  py-2 px-4 border border-gray-800 rounded shadow hover:shadow-black">
                            
                            <strong>Enviar</strong>
                        </button>
                       
                    </div>
    
                </div>
            </div>
        </form>

    </div>





</main>

</x-layouts.plantillaPrincipal>