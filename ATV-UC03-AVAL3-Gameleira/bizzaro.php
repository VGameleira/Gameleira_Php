<?php
// 1. Crie um array com os números de 1 a 10 e faça o seguinte:
// a-Exiba todos os números do array.
// b-Calcule e exiba a soma de todos os números.
// c-Inverta a ordem dos elementos no array usando arsort() e exiba o resultado.

// $numeros = $_POST['numeros'] ?? [];

$numeros = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
// a) Exiba todos os números do array
echo "<h2>Números do array:</h2>";
echo implode(", ", $numeros) . "<br>";

// b) Calcule e exiba a soma de todos os números
echo "<h2>Soma dos números:</h2>";
$soma = array_sum($numeros);
echo "Soma dos números: " . $soma . "<br>";

// c) Inverta a ordem dos numeros 
echo "<h2>Números em ordem decrescente:</h2>";
arsort($numeros);
echo implode(", ", $numeros) . "<br>";
?>



<?php
// 2. Crie um array associativo para armazenar informações de um produto:

//     a-Nome do produto, preço, quantidade em estoque.
//     b-Adicione 05 produtos e exiba as informações formatadas da seguinte forma:
//         Produto: TV
//         Preço: R$ 5.600,00
//         Qtd: 08
//     c-Atualize o preço de todos os produto e exiba todos eles novamente, simulando um desconto de 10% em todos os produtos.



$estoque = [
    ["nome" => "TV", "preco" => 5600.00, "quantidade" => 8],
    ["nome" => "Geladeira", "preco" => 3200.00, "quantidade" => 5],
    ["nome" => "Microondas", "preco" => 450.00, "quantidade" => 15],
    ["nome" => "Notebook", "preco" => 2500.00, "quantidade" => 10],
    ["nome" => "Smartphone", "preco" => 1500.00, "quantidade" => 20],
];

// Exiba as informações dos produtos
echo "<h2>Informações dos Produtos:</h2>";

foreach ($estoque as $produto) {
    echo "<br><br>Produto: " . $produto['nome'] . "<br>";
    echo "Preço: R$ " . number_format($produto['preco'], 2, ',', '.') . "<br>";
    echo "Qtd: " . $produto['quantidade'] . "<br><br>";
}

// Atualize o preço com desconto de 10%
echo "<h2>Produtos com Desconto de 10%:</h2>";
foreach ($estoque as $produto) {
    $produto['preco'] *= 0.10; // Aplica desconto de 10%
    echo "<br>Produto: " . $produto['nome'] . "<br>";
    echo "Preço com desconto: R$ " . number_format($produto['preco'], 2, ',', '.') . '<br>';
}

?>

<?php
// 3. Crie um array associativo com informações de 3 alunos (nome, idade e notaFinal). Depois:

//     a-Adicione 10 alunos e exiba as informações de cada aluno da seguinte forma:
//        nome: Juca
//        idade: 27 anos
//        notaFinal: 8.5
//     b-Calcule e exiba a média das notas de todos os alunos.


$alunos = [
    ["nome" => "Juca", "idade" => 27, "notaFinal" => 8.5],
    ["nome" => "Ana", "idade" => 22, "notaFinal" => 9.0],
    ["nome" => "Pedro", "idade" => 24, "notaFinal" => 7.5],
    ["nome" => "Maria", "idade" => 23, "notaFinal" => 8.0],
    ["nome" => "Lucas", "idade" => 26, "notaFinal" => 6.5],
    ["nome" => "Carla", "idade" => 21, "notaFinal" => 9.5],
    ["nome" => "Rafael", "idade" => 25, "notaFinal" => 7.0],
    ["nome" => "Beatriz", "idade" => 22, "notaFinal" => 8.8],
    ["nome" => "Gustavo", "idade" => 24, "notaFinal" => 6.8],
    ["nome" => "Fernanda", "idade" => 23, "notaFinal" => 9.2],
];



// Calcule a média das notas
echo "<h2>Informações dos Alunos:</h2>";
// $notaSoma = $alunos['0']['notaFinal'] + $alunos['1']['notaFinal'] + $alunos['2']['notaFinal'] + $alunos['3']['notaFinal'] + $alunos['4']['notaFinal'] + $alunos['5']['notaFinal'] + $alunos['6']['notaFinal'] + $alunos['7']['notaFinal'] + $alunos['8']['notaFinal'] + $alunos['9']['notaFinal'];
// $media = $notaSoma / count($alunos);

for ($i = 0; $i < count($alunos); $i++) {

    echo "Nome: " . $alunos[$i]["nome"] . "<br> Nota: " . $alunos[$i]["notaFinal"] . "<br>";
}

$media = array_sum(array_column($alunos, 'notaFinal')) / count($alunos);


echo "<br>Média das notas: " . number_format($media, 1, ',', '.') . "<br>";


?>
