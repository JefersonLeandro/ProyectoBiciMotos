let inputBuscar = document.getElementById("inputBuscar");
let selectBuscar = document.getElementById("selectBuscar");

if (selectBuscar.value=="Id"){
    inputBuscar.type="number";
 }

selectBuscar.addEventListener("change",function(){

    let opcionSeleccionada = selectBuscar.value;

    if (opcionSeleccionada == "Id"){
        inputBuscar.type ="number";  
    }else if(opcionSeleccionada=="Stock"){
        inputBuscar.type ="number";  
    }else{
        inputBuscar.type="search"
    }
    
});