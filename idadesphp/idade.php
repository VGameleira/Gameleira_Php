<!-- Criar um programa que receba o nome do usuário e  o ano de nascimento do mesmo.  Ao final deve informar o nome do usuário, sua idade e se ele é maior ou menor de idade.
 
Entradas - 
nome - Texto
anoNascimento - Inteiro
Processamento
Calcular a idade
Analisar se é maior de idade
 
Saída  
Nome, Idade, Se é maior ou menor ou menor de idade -->
<?php

$nome = $_POST["nome"];
$anoNascimento = $_POST["anoNascimento"];
$anoAtual = $_POST["anoAtual"];

$idadeAtual = $anoAtual - $anoNascimento;

if ($idadeAtual >= 18) {

    echo "Olá " . $nome . ", você tem $idadeAtual anos e é maior de idade.";
} else {
    echo "Olá " . $nome . ", você tem $idadeAtual anos e é menor de idade.";


}


