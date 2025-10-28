
<?php
include 'aluno.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $curso = $_POST['curso'];

    if ($curso == "Informatica para Internet" || $curso == "Desenvolvimento para sistema" || $curso == "Front end" || $curso == "Back end") {
        $resultado = new Aluno($nome, $cidade, $bairro, $curso);
        $resultado->mostrarInformacoes();
    } else {
        echo "Curso inválido. Por favor, escolha um curso válido.";
    }   
}



// $aluno = new Aluno($nome, $cidade, $bairro, $curso);
// $aluno->mostrarInformacoes();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Cadastro de Aluno</h1>
    <form action="" method="post">
    <label for="">Digite seu nome</label>
    <input type="text" name="nome">
    <br>
    <label for="">Digite sua cidade</label>
    <input type="text" name="cidade">
    <br>
    <label for="">Digite seu bairro</label>
    <input type="text" name="bairro">
    <br>
    <label for="">Digite seu curso</label>
    <input type="text" name="curso">
    <br>

    <button type="submit">Enviar</button>
    </form>


</body>
</html>

