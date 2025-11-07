<?php
include_once 'livro.php';


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['titulo']) && isset($_GET['autor']) && isset($_GET['isbn']) && isset($_GET['genero'])) {
    require_once 'livro.php';

    $titulo = $_GET['titulo'];
    $autor = $_GET['autor'];
    $isbn = $_GET['isbn'];
    $genero = $_GET['genero'];

    $livro = new livro($titulo, $autor, $isbn, $genero);
    $livro->mostrarInformacoes();
}








?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Livro</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <h1>Informações Livro</h1>
    <form action="" method="get">
        <label for="">Qual titulo da obra</label>
        <input type="text" name="titulo">
        <br>
        <label for="">Quem é o autor</label>
        <input type="text" name="autor">
        <br>
        <label for="">Qual o ISBN</label>
        <input type="text" name="isbn">
        <br>
        <label for="">Qual o gênero</label>
        <input type="text" name="genero">
        <br>





        <button type="submit">Enviar</button>
    </form>


</body>

</html>