// Crear Tiendas
function crearTiendas(idContenedor, min, cantidadTiendas){
    //Encontrar contenedor por su id
    let elementoContenedor = document.getElementById(idContenedor);
    //loop para crear tiendas
    for(let conteoTiendas = 1; conteoTiendas <= cantidadTiendas; conteoTiendas++){
        // crear el texto de label para poder llamar a la funcion
        let textoEtiqueta = "Tienda " + conteoTiendas;
        // Crear tiendas con la funcion crear parrafo tiendas
        let parrafoTienda = crearParrafotienda(textoEtiqueta, min);
        // Agregar el parrafo al contenedor
        elementoContenedor.appendChild(parrafoTienda);
    }
}



/*Generar tiendas  */ 
function crearParrafotienda(textoLabel, valorMin){
    // Crear las etiquetas parrafo y label
    let elementoParrafo = document.createElement("p");
    let elementoEtiqueta = document.createElement("label");
    elementoEtiqueta.innerText = textoLabel + "   ";

    // Agregar etiqueta a label para conectar con el input
    elementoEtiqueta.setAttribute("for", textoLabel);
    
    // Crear input
    let elementoInput = document.createElement("input");
    //establecer attributos input
    elementoInput.setAttribute("type", "number");
    elementoInput.setAttribute("id", textoLabel);
    elementoInput.setAttribute("min", valorMin);
    elementoInput.setAttribute("value", 0);

    // Agregar laber e input al parrafo
    elementoParrafo.appendChild(elementoEtiqueta);
    elementoParrafo.appendChild(elementoInput);

    // Devolver parrafo completo
    return elementoParrafo;
}




// Capturar numeros y sacar resultado mayor venta y menor

function extraerNumeroDesdeElemento(elemento){
    let miElemento = document.getElementById(elemento);
    let miTexto = miElemento.value;
    let miNumero = Number(miTexto);
    return miNumero;
}

function calcular(){
    let ventas = [];

    ventas[0] = extraerNumeroDesdeElemento("ventasTienda1");
    ventas[1] = extraerNumeroDesdeElemento("ventasTienda2");
    ventas[2] = extraerNumeroDesdeElemento("ventasTienda3");
    ventas[3] = extraerNumeroDesdeElemento("ventasTienda4");
    ventas[4] = extraerNumeroDesdeElemento("ventasTienda5");
    ventas[5] = extraerNumeroDesdeElemento("ventasTienda6");
 
    let totalVentas = sumarTotal(ventas);
    let ventaMayor = calcularMayor(ventas);
    let ventaMenor = calcularMinimo(ventas);

    let mensajeSalida = "Total Ventas: " + totalVentas + "/ Venta Mayor: " + ventaMayor + "/ Venta Menor: " + ventaMenor;
    let elementoSalida = document.getElementById("ParrafoSalida");
    elementoSalida.textContent = mensajeSalida;
}

function sumarTotal(array){
    let total = 0;

    for(let venta of array){
        total = total + venta;
    }
    return total;
}

function calcularMayor(array){
    let maximo = array[0];

    for(let venta of array){
        if (venta > maximo){
            maximo = venta;
        }
    }
    return maximo;    
}

function calcularMinimo(array){
    let minimo = array[0];

    for(let venta of array){
        if (venta < minimo){
            minimo = venta;
        }
    }
    return minimo;    
}