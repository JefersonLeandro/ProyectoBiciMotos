Eloquent es el ORM (Object-Relational Mapping) en Laravel, un popular framework de PHP. Con Eloquent, puedes realizar búsquedas en la base de datos de manera sencilla y expresiva. Aquí hay algunos ejemplos de cómo hacer búsquedas utilizando Eloquent:

Búsqueda por ID:

<?php




php
Copy code
$usuario = Usuario::find(1);
Esto buscará un usuario con el ID igual a 1.

Búsqueda por columna:

php
Copy code
$usuarios = Usuario::where('nombre', 'John')->get();
Esto buscará todos los usuarios cuyo nombre sea 'John'.

Búsqueda con múltiples condiciones:

php
Copy code
$usuarios = Usuario::where('nombre', 'John')->where('edad', '>', 18)->get();
Esto buscará usuarios con nombre 'John' y edad mayor de 18.

Búsqueda por campo específico:

php
Copy code
$usuarios = Usuario::where('edad', '>', 21)->get(['nombre', 'email']);
Esto buscará usuarios mayores de 21 años y solo recuperará los campos 'nombre' y 'email'.

Búsqueda con relaciones:

php
Copy code
$posts = Usuario::find(1)->posts;
Esto recuperará todos los posts del usuario con ID 1 si hay una relación definida entre Usuario y Post.

Búsqueda utilizando "like":

php
Copy code
$usuarios = Usuario::where('nombre', 'like', '%John%')->get();
Esto buscará usuarios cuyo nombre contenga la cadena 'John'.

Estos son solo algunos ejemplos básicos. Puedes combinar condiciones, utilizar cláusulas "or", ordenar los resultados y más. La documentación oficial de Laravel es una excelente fuente de información para aprender más sobre Eloquent y sus capacidades: Eloquent: Getting Started.






?>

