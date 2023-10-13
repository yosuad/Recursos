function mostrarResultado(resultado){
    document.getElementById("resultado").value = resultado;
}

function suma(){
    let numero1 = +document.getElementById("campo1").value;
    let numero2 = +document.getElementById("campo2").value;
    mostrarResultado(numero1 + numero2);
}

function resta(){
    let numero1 = +document.getElementById("campo1").value;
    let numero2 = +document.getElementById("campo2").value;
    mostrarResultado(numero1 - numero2);
}

function multiplicacion(){
    let numero1 = +document.getElementById("campo1").value;
    let numero2 = +document.getElementById("campo2").value;
    mostrarResultado(numero1 * numero2);
}

function division(){
    let numero1 = +document.getElementById("campo1").value;
    let numero2 = +document.getElementById("campo2").value;
    mostrarResultado(numero1 / numero2);
}

function raiz(){    
    let numero = +document.getElementById("campo2").value;
    mostrarResultado(Math.sqrt(numero));
}

function potencia(){
    let numero1 = +document.getElementById("campo1").value;
    let numero2 = +document.getElementById("campo2").value;
    mostrarResultado(Math.pow(numero1, numero2));
}

function absoluto(){
    let numero = +document.getElementById("campo2").value;    
    mostrarResultado(Math.abs(numero));
}

function aleatorio(){
    let minimo  = +document.getElementById("campo1").value;
    let maximo = +document.getElementById("campo2").value;
    maximo++;
    mostrarResultado(Math.floor(Math.random() * (maximo - minimo) + minimo));
}


function redondeo() {
    let resultado = +document.getElementById("resultado").value;
    mostrarResultado(Math.round(resultado));
}

function piso() {
    let resultado = +document.getElementById("resultado").value;
    mostrarResultado(Math.floor(resultado));
}

function techo() {
    let resultado = +document.getElementById("resultado").value;
    mostrarResultado(Math.ceil(resultado));
}