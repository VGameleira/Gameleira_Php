<!-- Criar um algoritmo em php que permita três tipos de conversão:
- Conversão de Real para Dólar
- Conversão de Real para Euro
- Conversão de Real para qualquer moeda que vocês escolherem
 
O usuário deverá informar o valor em real e escolher em qual moeda deseja ver a
conversão. Importante realizar todas as validações e impedir que erros ocorram.
 
Usar o conceito de function para validar as entradas, exibir as mensagens, e para
realizar a conversão.
 
DESAFIO EXTRA: Consumir uma API para atualizar o valor de cotação das moedas. 
 
Importante
- Entrega feita no GitHub
- O repositório deverá ter os seguintes commits
     - estruturação do html e estilização com css
     - criação da página php sem functions mas funcional
     - criação da função que valida entradas
     - criação da função que exibe a mensagem
     - criação da função que converte para dólar
     - criação da função que converte para euro
     - criação da função que converte para a moeda de sua escolha 
     - criação de uma função que consuma uma API para pegar o valor das moedas usadas na conversão -->

     <?php

     $valor = isset($_GET['valor']) ? $_GET['valor'] : 0;
     $moeda = isset($_GET['moeda']) ? $_GET['moeda'] : '';

     

