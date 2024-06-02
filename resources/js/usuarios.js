let inputBuscar = document.getElementById("inputBuscar");
let selectBuscar = document.getElementById("selectBuscar");

selectBuscar.addEventListener("change",function(){

    let opcionSeleccionada = selectBuscar.value;

    if (opcionSeleccionada == "Identificacion"){
        inputBuscar.type ="number";  
    }else{
        inputBuscar.type="search"
    }
    
});

