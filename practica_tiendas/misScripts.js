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