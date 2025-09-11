<!-- Problema "crescente" (adaptado de URI 1113) 
Leia uma quantidade indeterminada de duplas de valores inteiros X e Y. Escreva para cada X e Y uma 
mensagem que indique se estes valores foram digitados em ordem crescente ou decrescente. O 
programa deve finalizar quando forem digitados dois valores iguais. 
Exemplo: 
Digite dois numeros: 
5 
4 
DECRESCENTE! 
Digite outros dois numeros: 
3 
8 
CRESCENTE! 
Digite outros dois numeros: 
2 
2


do {
 n1 = Number.parseInt(prompt("Digite a 1º valor"));
 n2 = Number.parseInt(prompt("Digite a 2º valor"));

    alert(`${n1}, ${n2}`)
    if (n1 < n2) {
        alert("Crescente")


    } else if (n1 > n2) {
        alert("Decrescente")


    } else {
        alert("Os valores são iguais, programa finalizado")
    }

} while (n1 != n2) -->

<?php

$n1 = $_POST["n1"];
$n2 = $_POST["n2"];

if ($n1 == $n2) {
    echo "Os valores são iguais, programa finalizado";
} else if ($n1 < $n2) {
    echo "Crescente";
} else {
    echo "Decrescente";
}

