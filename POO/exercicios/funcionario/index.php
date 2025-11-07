<?php
include_once 'funcionario.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nome']) && isset($_GET['departamento']) && isset($_GET['cargo']) && isset($_GET['salario'])) {
    require_once 'funcionario.php';

    $nome = $_GET['nome'];
    $departamento = $_GET['departamento'];
    $cargo = $_GET['cargo'];
    $salario = floatval($_GET['salario']);

    $funcionario1 = new Funcionario($nome, $departamento, $cargo, $salario);
    $funcionario1->mostrarInformacoes();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionário</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <h1></h1>
    <form action="" method="get">
        <h1>Cadastro de Funcionário</h1>

        <label for="">Digite seu nome</label>
        <input type="text" name="nome">
        <br>
        <label for="">Digite seu departamento</label>
        <input type="text" name="departamento">
        <br>
        <label for="">Digite seu cargo</label>
        <input type="text" name="cargo">
        <br>
        <label for="">Digite seu salário</label>
        <input type="text" name="salario">
        <br>

        <button type="submit">Enviar</button>
    </form>


</body>

</html>