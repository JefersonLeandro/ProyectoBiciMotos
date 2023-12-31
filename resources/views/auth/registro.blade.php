<x-layouts.plantillaPrincipal>




    <main class="bg-gray-400-500 w-full h-screen">
        <div class="flex items-center w-full justify-center pt-6">
            <form action="{{route("auth.Registrar")}}" method="POST" class="flex flex-col w-96">
                <h3 for="">Registro</h3>

                @csrf


                <label for="">Nombre</label>
                <input type="text" class=" border-4  border-solid " name="nombreUsuario" value="{{old('nombreUsuario')}}">
                
                    @error('nombreUsuario')
                        <small style="color: red;  ">{{$message}}</small>
            
                    @enderror

                <label for="">apellido</label>
                <input type="text" class=" border-4  border-solid " name="apellidoUsuario" value="{{old('apellidoUsuario')}}">

                    @error('apellidoUsuario')
                    <small style="color: red;  ">{{$message}}</small>
            
                    @enderror
                
                <label for="">Numero de identificacion</label>
                <input type="number" class=" border-4  border-solid " name="identificacionUsuario" value="{{old('identificacionUsuario')}}">

                    @error('identificacionUsuario')
                        <small style="color: red;  ">{{$message}}</small>
            
                    @enderror
                
                <label for="">email</label>
                <input type="email" name="email" class=" border-4  border-solid " value="{{old('email')}}">

                    @error('email')
                        <small style="color: red;  ">{{$message}}</small>
            
                    @enderror

                <label for="">Contraseña</label>
                <input type="password" class=" border-4  border-solid " name="password" value="{{old('password')}}">
                    @error('password')
                    <small style="color: red;  ">{{$message}}</small>
            
                    @enderror

                <label for="">Confirme la contraseña</label>
                <input type="password" class=" border-4  border-solid " name="password_confirmation" value="{{old('password_confirmation')}}">

                <input type="hidden" name="idRol" value="1">

                <button type="submit" class=" w-11 h-12 min-w-[8rem] rounded-lg border-2 border-gray-600 bg-gray-500 text-emerald-50 shadow-lg hover:bg-gray-600 focus:outline-none focus:ring focus:ring-gray-600">
                    Registrar
                </button>
                
            </form>
        </div>
    </main>


</x-layouts.plantillaPrincipal>