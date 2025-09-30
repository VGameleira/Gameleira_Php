<!-- Problema "aumento" (adaptado de URI 1048) 
Uma empresa vai conceder um aumento percentual de 
salário aos seus funcionários dependendo de quanto 
cada pessoa ganha, conforme tabela ao lado. Fazer um 
programa para ler o salário de uma pessoa, daí mostrar 
qual o novo salário desta pessoa depois do aumento, 
quanto foi o aumento e qual foi a porcentagem de 
aumento. 


Salário atual                      | Aumento 
Até R$ 1000.00                     | 20% 
Acima de R$ 1000.00 até R$ 3000.00 | 15% 
Acima de R$ 3000.00 até R$ 8000.00 | 10% 
Acima de R$ 8000.00                | 5%  

Exemplo 1: 
Digite o salario da pessoa: 2500.00 
Novo salario = R$ 2875.00 
Aumento = R$ 375.00 
Porcentagem = 15 % 
Exemplo 2: 
Digite o salario da pessoa: 8000.00 
Novo salario = R$ 8800.00 
Aumento = R$ 800.00 
Porcentagem = 10 % -->

<?php
$salario = $_POST["salario"];

$novoSalario = "";

if ($salario <= "0") {
    echo "Salário inválido";
} elseif ($salario <= "1000") {
    $novoSalario = $salario * 0.20;
    $aumento = $novoSalario - $salario;
} elseif ($salario > "1000" && $salario <= "3000") {
    $novoSalario = $salario * 0.15;
    $aumento = $novoSalario - $salario;
} elseif ($salario > "3000" && $salario <= "8000") {
    $novoSalario = $salario * 0.10;
    $aumento = $novoSalario - $salario;
} else {
    $novoSalario = $salario * 0.5;
    $aumento = $novoSalario - $salario;
}

echo "Salario atual = R$ " . $salario;
echo "Novo salário = R$ " . number_format($novoSalario, 2, '.', '') . "<br>";
echo "Aumento = R$ " . number_format($aumento, 2, '.') . '<br>';
