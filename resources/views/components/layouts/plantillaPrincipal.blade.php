<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="descripcion" content="{{$metaDespcripcion ?? 'descripcion por defecto'}}" >
    <title>{{$title ?? ''}}</title>
    @vite(['resources/css/styles.css','resources/js/app.js'])
   
    
</head>
<body>
    
  
    @if (session("estado"))
    
    <div class="bg-white border-t border-b border-black px-4 py-3" role="alert">
        <strong class="font-clear cleartext-black-500">{{session('estado')}}</strong>
        <p class="text-sm text-black-400 ">accion realizada correctamente</p>
    </div>
    
    @endif
   

    {{$slot}}

    
    {{-- @if (session("alerta"))
    <div>
        <script>
            window.alert('{{ session('alerta') }}');
        </script>
    </div>
    @endif --}}
</body>

</html>