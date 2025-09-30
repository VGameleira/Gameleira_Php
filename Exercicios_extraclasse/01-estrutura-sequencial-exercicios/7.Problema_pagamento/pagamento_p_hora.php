<!-- Problema "pagamento" 
Fazer um programa para ler o nome de um(a) funcionário(a), o valor que ele(a) recebe por hora, e a quantidade de horas trabalhadas por ele(a). Ao final, mostrar o valor do pagamento do funcionário com uma mensagem explicativa, conforme exemplo. 

Exemplo 1: 
Nome: Joao Silva
Valor por hora: 50.00
Horas trabalhadas: 60
O pagamento para Joao Silva deve ser 3000.00 
Exemplo 2: 
Nome: Maria Dias
Valor por hora: 60.00
Horas trabalhadas: 100
O pagamento para Maria Dias deve ser 6000.00 

nome = prompt("Digite seu nome");
vHora = Number.parseFloat(prompt("Digite o valor por hora"));
trabalhadas = Number.parseInt(prompt("Digite quantidade de horas trabalhadas"));

total = vHora * trabalhadas
alert(`O pagamento para ${nome} deve ser ${total} `)  -->

<?php
$nome = $_POST["nome"];
$vHora = $_POST["vHora"];
$trabalhadas = $_POST["trabalhadas"];
$total = $vHora * $trabalhadas;
echo "O pagamento para " . $nome . " deve ser " . $total;