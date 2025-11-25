<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - Biblioteca</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="menu">
        <div class="dropdown">
            <button class="dropbtn">Usuários</button>
            <div class="dropdown-content">
                <a href="usuario/cadastrar.php">Cadastrar Usuário</a>
                <a href="usuario/listar.php">Listar Usuários</a>
            </div>
        </div>

        <div class="dropdown">
            <button class="dropbtn">Livros</button>
            <div class="dropdown-content">
                <a href="livros/cadastrar.php">Cadastrar Livro</a>
                <a href="livros/listar.php">Listar Livros</a>
            </div>
        </div>

        <div class="dropdown">
            <button class="dropbtn">Aluguéis</button>
            <div class="dropdown-content">
                <a href="aluguel/listar.php">Meus Aluguéis</a>
                <a href="aluguel/historico.php">Histórico</a>
            </div>
        </div>

        <a href="logout.php" class="logout">Sair</a>
    </nav>

    <div class="container">
        <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</h1>
        <p style="text-align: center; color: #666; margin-top: 20px;">
            Você está logado no sistema de biblioteca.
        </p>
    </div>

</body>

</html>