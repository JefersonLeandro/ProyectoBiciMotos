<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="descripcion" content="{{$metaDespcripcion ?? 'descripcion por defecto'}}" >
    <title>{{$title ?? ''}}</title>
    @vite(['resources/css/styles.css','resources/js/script.js'])
</head>
<body>


    
    {{$slot}}
    
</body>
</html>