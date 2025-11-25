<?php
// criar um projeto sobre a criação de uma biblioteca. Segue o banco de dados.
// CREATE DATABASE IF NOT EXISTS biblioteca;

// USE biblioteca;

// CREATE TABLE IF NOT EXISTS usuarios (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     nome VARCHAR(255) NOT NULL,
//     email VARCHAR(255) NOT NULL UNIQUE,
//     senha VARCHAR(255) NOT NULL,
//     tipo ENUM('admin', 'aluno') NOT NULL
// );

// CREATE TABLE IF NOT EXISTS livros (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     titulo VARCHAR(255) NOT NULL,
//     autor VARCHAR(255) NOT NULL,
//     disponivel BOOLEAN DEFAULT TRUE,
//     imagem VARCHAR(255) DEFAULT NULL
// );

// CREATE TABLE IF NOT EXISTS alugueis (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     id_usuario INT,
//     id_livro INT,
//     data_aluguel DATE,
//     data_devolucao DATE,
//     devolvido BOOLEAN DEFAULT FALSE,
//     FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
//     FOREIGN KEY (id_livro) REFERENCES livros(id)
// );
// Inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';

session_start();

// Se usuário já está logado, redireciona para painel
if (isset($_SESSION['id_usuario'])) {
    header("Location: painel.php");
    exit();
}

$mensagem = "";
$tipo_mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['acao'])) {
        if ($_POST['acao'] == 'cadastro') {
            // CADASTRO
            $nome = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $senha = $_POST['senha'] ?? '';

            if (empty($nome) || empty($email) || empty($senha)) {
                $mensagem = "Erro: Preencha todos os campos!";
                $tipo_mensagem = "erro";
            } elseif (strlen($senha) < 6) {
                $mensagem = "Erro: Senha deve ter no mínimo 6 caracteres!";
                $tipo_mensagem = "erro";
            } else {
                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

                try {
                    $sql = "SELECT id FROM usuarios WHERE email = :email";
                    $stmt = $conexao->prepare($sql);
                    $stmt->execute([':email' => $email]);
                    $usuarios = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if ($usuarios) {
                        $mensagem = "Erro: Email já cadastrado!";
                        $tipo_mensagem = "erro";
                    } else {
                        $stmt = $conexao->prepare("INSERT INTO usuarios (nome, email, senha, tipo) VALUES (:nome, :email, :senha, 'aluno')");
                        $stmt->bindParam(':nome', $nome);
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':senha', $senha_hash);
                        
                        if ($stmt->execute()) {
                            $mensagem = "✓ Cadastro realizado com sucesso! Faça login.";
                            $tipo_mensagem = "sucesso";
                        }
                    }
                } catch (PDOException $e) {
                    $mensagem = "Erro ao registrar usuário!";
                    $tipo_mensagem = "erro";
                }
            }
        } elseif ($_POST['acao'] == 'login') {
            // LOGIN
            $email = trim($_POST['email'] ?? '');
            $senha = $_POST['senha'] ?? '';

            if (empty($email) || empty($senha)) {
                $mensagem = "Erro: Preencha email e senha!";
                $tipo_mensagem = "erro";
            } else {
                try {
                    $sql = "SELECT id, nome, tipo, senha FROM usuarios WHERE email = :email";
                    $stmt = $conexao->prepare($sql);
                    $stmt->execute([':email' => $email]);
                    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if ($usuario && password_verify($senha, $usuario['senha'])) {
                        // Autenticação bem-sucedida
                        $_SESSION['id_usuario'] = $usuario['id'];
                        $_SESSION['nome'] = $usuario['nome'];
                        $_SESSION['tipo'] = $usuario['tipo'];
                        header("Location: painel.php");
                        exit();
                    } else {
                        $mensagem = "Erro: Email ou senha incorretos!";
                        $tipo_mensagem = "erro";
                    }
                } catch (PDOException $e) {
                    $mensagem = "Erro ao fazer login!";
                    $tipo_mensagem = "erro";
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Biblioteca</title>
</head>

<body>
    <div class="container">
        <h1>Bem-vindo à Biblioteca</h1>
        <?php if (!empty($mensagem)) : ?>
            <p class="<?php echo $tipo_mensagem; ?>"><?php echo htmlspecialchars($mensagem); ?></p>
        <?php endif; ?>

        <form action="" method="post">
            <input type="hidden" name="acao" value="cadastro">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
            <br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br><br>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            <br><br>

            <input type="submit" value="Cadastrar">
        </form>

        <br>
        <form action="" method="post">
            <input type="hidden" name="acao" value="login">
            <label for="email_login">Email:</label>
            <input type="email" id="email_login" name="email" required>
            <br><br>
            <label for="senha_login">Senha:</label>
            <input type="password" id="senha_login" name="senha" required>
            <br><br>

            <input type="submit" value="Login">
        </form>
    </div>
</body>

</html>