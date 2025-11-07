
<?php
include 'calculadora.php';

$valor1 = $valor2 = $operacao = $resultado = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero1 = $_POST['valor1'];
    $numero2 = $_POST['valor2'];
    $operacao = $_POST['operacao'];

    $calculadora = new Calculadora($numero1, $numero2);

    switch ($operacao) {
        case 'adicao':
            $resultado = $calculadora->adicao();
            break;
        case 'subtracao':
            $resultado = $calculadora->subtracao();
            break;
        case 'multiplicacao':
            $resultado = $calculadora->multiplicacao();
            break;
        case 'divisao':
            $resultado = $calculadora->divisao();
            break;
        default:
            $resultado = "Operação inválida.";
            break;
    }
    

}






?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Calculadora</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <h1>Calculadora</h1>
    <form action="" method="post">

        <label for="valor1">Digite o 1º número</label>
        <input type="text" name="valor1" id="valor1"  required>
        <!-- value = "<? // php echo $valor1 ?>"   -->

        <label for="valor2">Digite o 2º número</label>
        <input type="text" name="valor2" id="valor2" required>
        <!-- value = "<?php // echo $valor2 
                        ?>"   -->

        <label for="operacao">Selecione a operação</label>
        <select name="operacao" id="operacao" selected>
            <option value="adicao">Somar</option>
            <!-- value = "<?php // echo (operacao == 'adicao') ? 'selected' : ''
                            ?>"   -->


            <option value="subtracao" selected>Subtrair</option>
            <!-- value = "<?php // echo (operacao == 'subtracao') ? 'selected' : ''
                            ?>"   -->

            <option value="multiplicacao" selected>Multiplicar</option>
            <!-- value = "<?php // echo (operacao == 'multiplicacao') ? 'selected' : ''
                            ?>"   -->

            <option value="divisao" selected>Dividir</option>
            <!-- value = "<?php // echo (operacao == 'divisao') ? 'selected' : ''
                            ?>"   -->

        </select>

        <button type="submit">Calcular</button>
    </form>
</body>
<?php

if ($resultado !== "" || $resultado !== "") {
    echo "<h2>Resultado: $resultado</h2>";
}
?>
</html>





