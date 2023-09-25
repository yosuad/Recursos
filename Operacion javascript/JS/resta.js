var num1 = prompt ("ingresa el numero 1");
var num2 = prompt ("ingresa el numero 2");

var resta = num1 - num2;

if (resta>0){
    console.log("Es mayor a 0");
    /* Revisar si es par o impar
    si es par daria 0, si es impar daria 1 */
    let imparPar = resta % 2;
    if (imparPar==0){
        console.log("Es par");
    } else {
        console.log("Es impar");
    }

} else {
    console.log("Es menor o igual a 0");
}