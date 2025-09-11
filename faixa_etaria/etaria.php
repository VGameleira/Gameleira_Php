<!-- 
Criar um programa que receba o nome do usuário e a idade do mesmo. 
Ao final deve informar o nome do usuário, sua idade e em qual faixa etária ele se
encontra. Também deve dizer se ele pode ingressar no sistema ou não. Se puder, 
deverá ser mostrado, bem vindo e o nome do usuário. Se não puder, mostrará Acesso
Negado! Apenas maior de 18 pode ingressar!
 
 
Critérios para a mensagem de faixa etária:
 
Menor que 12     -> Criança
De 12 a 18       -> Adolescente
18 a 25          -> Jovem
26 a 60          -> Adulto
Mais de 60 anos  -> Melhor idade 
-->

<?php
$nome = $_POST['nome'];
$idade = $_POST['idade'];

$faixaEtaria = "";

if ($idade < 12) {
    $faixaEtaria = "Criança";
    echo "Acesso Negado! Apenas maior de 18 pode ingressar!";
    echo "<br> Você é " . $faixaEtaria;
} elseif ($idade >= 12 && $idade < 18) {
    $faixaEtaria = "Adolescente";
    echo "Acesso Negado! Apenas maior de 18 pode ingressar!";
    echo "<br> Você é " . $faixaEtaria;
} elseif ($idade >= 18 && $idade <= 25) {
    $faixaEtaria = "Jovem";
    echo "Bem vindo, " . $nome;
    echo "<br> Você é " . $faixaEtaria;
} elseif ($idade > 25 && $idade <= 60) {
    $faixaEtaria = "Adulto";
    echo "Bem vindo, " . $nome;
    echo "<br> Você é " . $faixaEtaria;
} else {
    $faixaEtaria = "Melhor idade";
    echo "Bem vindo, " . $nome;
    echo "<br> Você é " . $faixaEtaria;
}
