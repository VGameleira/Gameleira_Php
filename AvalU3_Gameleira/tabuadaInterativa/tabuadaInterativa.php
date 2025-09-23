<!-- B) Criar um algoritmo que receba um número qualquer e faça uma das operações que o usuário escolher com este número (Adição, Subtração ou multiplicação ou divisão). Esta operação deve ser realizada com os números de 1 a 10 e o resultado mostrado na tela.
 
Exemplo: Usuário escolheu o 6 e Adição.
 
Saída:
6 + 1 = 7    | 
6 + 2 = 8    |
6 + 3 = 9    |
6 + 4 = 10   |
6 + 5 = 11   |
6 + 6 = 12   |
6 + 7 = 13   |
6 + 8 = 14   |
6 + 9 = 15   |
6 + 10 = 16  |
-->

<?php

$operacao = $_POST['operacao'];
$num1 = $_POST['num1'];

if ($operacao == 'adicao') {
    for ($i = 1; $i <= 10; $i++) {
        $valorFinalAdicao = $num1 + $i;
        echo "$num1 + $i = $valorFinalAdicao <br>";
    }
} elseif ($operacao == 'subtracao') {
    for ($i = 1; $i <= 10; $i++) {
        $valorFinalSubtracao = $num1 - $i;
        echo "$num1 - $i = $valorFinalSubtracao <br>";
    }
} elseif ($operacao == 'multiplicacao') {
    for ($i = 1; $i <= 10; $i++) {
        $valorFinalMultiplicacao = $num1 * $i;
        echo "$num1 x $i = $valorFinalMultiplicacao <br>";
    }
} elseif ($operacao == 'divisao') {
    for ($i = 1; $i <= 10; $i++) {
        $valorFinalDivisao = $num1 / $i;
        echo "$num1 / $i = $valorFinalDivisao <br>";
    } }
    elseif ($operacao == 'todos') {
    for ($i = 1; $i <= 10; $i++) {
        $valorFinalAdicao = $num1 + $i;
        $valorFinalSubtracao = $num1 - $i;
        $valorFinalMultiplicacao = $num1 * $i;
        $valorFinalDivisao = $num1 / $i;
        echo "$num1 + $i = $valorFinalAdicao | ";
        echo "$num1 - $i = $valorFinalSubtracao | ";
        echo "$num1 x $i = $valorFinalMultiplicacao | ";
        echo "$num1 / $i = $valorFinalDivisao <br>";
    }
}
 else {
    echo "Operação inválida.";
}
