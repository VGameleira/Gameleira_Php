<!-- C) Criar um algoritmo que receba três números e que informe ao final os números digitados e quantos deles são ímpares e pares.
 
Exemplo: Usuário digitou 5,7,8
 
Saída:
 
Números digitados: 5,7 e 8
Números pares: 1
Números ímpares: 2 -->

<?php
$num1 = $_POST['num1'];
$num2 = $_POST['num2'];
$num3 = $_POST['num3'];


$pares = 0;
$impares = 0;

if ($num1 % 2 == 0) {
    $pares++;
} else {
    $impares++;
}

if ($num2 % 2 == 0) {
    $pares++;
} else {
    $impares++;
}

if ($num3 % 2 == 0) {
    $pares++;
} else {
    $impares++;
}


if ($num1 == $num2) {
    if ($num1 == $num3) {
        echo "Números digitados: $num1, $num2 e $num3 <br>";
        echo "Os três números são iguais.<br>";
    } else {
        echo "Números digitados: $num1, $num2 e $num3 <br>";
        echo "Os números 1 e 2 são iguais.<br>";
    }
} elseif ($num1 == $num3) {
    echo "Números digitados: $num1, $num2 e $num3 <br>";
    echo "Os números 1 e 3 são iguais.";
} elseif ($num2 == $num3) {
    echo "Números digitados: $num1, $num2 e $num3 <br>";
    echo "Os números 2 e 3 são iguais.<br>";
} else {
    echo "Números digitados: $num1, $num2 e $num3 <br>";
}

echo "Números pares: $pares <br>";
echo "Números ímpares: $impares <br>";
