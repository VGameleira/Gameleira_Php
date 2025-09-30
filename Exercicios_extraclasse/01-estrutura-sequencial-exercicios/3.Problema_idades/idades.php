<!-- Problema "idades" 
Fazer um programa para ler o nome e idade de duas pessoas. Ao final mostrar uma mensagem com os nomes e a idade média entre essas pessoas, com uma casa decimal, conforme exemplo. 

Exemplo: 
Dados da primeira pessoa: 
Nome: Maria Silva
Idade: 19
Dados da segunda pessoa: 
Nome: Joao Melo
Idade 20
A idade média de Maria Silva e Joao Melo é de 19.5 anos  -->

<?php
$nome1 = $_POST["nome1"];
$nome2 = $_POST["nome2"];
$nome3 = $_POST["nome3"];
$idade1 = $_POST["idade1"];
$idade2 = $_POST["idade2"];
$idade3 = $_POST["idade3"];

echo "<h2> Dados da primeira pessoa: </h2>";
echo "Nome: " . $nome1;
echo "Idade: ". $idade1;

echo "<h2> Dados da segunda pessoa: </h2>";
echo "Nome: ". $nome2;
echo "Idade: ". $idade2;

echo "<h2> Dados da terceira pessoa: </h2>";
echo "Nome: ". $nome3;
echo "Idade: ". $idade3;


echo "A idade média de " . $nome1 .",". $nome2 . " e " . $nome3 . "é de " . number_format((($idade1 + $idade2 + $idade3) / 3), 1) . " anos";