
<?php
include_once 'alunoextra.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome']) && isset($_POST['matricula']) && isset($_POST['curso']) && isset($_POST['media'])) {

    
    
 

    $nome = $_POST['nome'];
    $matricula = $_POST['matricula'];
    $curso = $_POST['curso'];
    $media = floatval($_POST['media']);



    $aluno = new AlunoExtra($nome, $matricula, $curso, $media);
    $aluno->verificarAprovacao();
    $aluno->mostrarInformacoes();

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Valida Média</h1>
    <form action="" method="post">
    <label for="">Digite seu nome</label>
    <input type="text" name="nome">
    <br>
    <label for="">Digite seu numero de matricula</label>
    <input type="text" name="matricula">
    <br>
    <label for="">Digite seu curso</label>
    <input type="text" name="curso">
    <br>
    <label for="">Digite sua média</label>
    <input type="text" name="media">
    <br>

    <button type="submit">Enviar</button>
    </form>


</body>
</html>

