<?php

$lado1 = $_POST['lado1'];
$lado2 = $_POST['lado2'];   
$lado3 = $_POST['lado3'];
$perimetro = $lado1 + $lado2 + $lado3;


echo "O perímetro do triângulo é: " . $perimetro . PHP_EOL;