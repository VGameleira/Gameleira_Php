<?php
require_once '../conexao.php';
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

$mensagem = "";
$tipo_mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $tipo = $_POST['tipo'] ?? 'aluno';

    if (empty($nome) || empty($email) || empty($senha)) {
        $mensagem = "Erro: Preencha todos os campos!";
        $tipo_mensagem = "erro";
    } elseif (strlen($senha) < 6) {
        $mensagem = "Erro: Senha deve ter no mínimo 6 caracteres!";
        $tipo_mensagem = "erro";
    } else {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        try {
            // Verifica se email já existe
            $sql = "SELECT id FROM usuarios WHERE email = :email";
            $stmt = $conexao->prepare($sql);
            $stmt->execute([':email' => $email]);
            $usuario_existe = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($usuario_existe) {
                $mensagem = "Erro: Email já cadastrado!";
                $tipo_mensagem = "erro";
            } else {
                $stmt = $conexao->prepare("INSERT INTO usuarios (nome, email, senha, tipo) VALUES (:nome, :email, :senha, :tipo)");
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':senha', $senha_hash);
                $stmt->bindParam(':tipo', $tipo);
                
                if ($stmt->execute()) {
                    $mensagem = "✓ Usuário cadastrado com sucesso!";
                    $tipo_mensagem = "sucesso";
                }
            }
        } catch (PDOException $e) {
            $mensagem = "Erro ao cadastrar usuário!";
            $tipo_mensagem = "erro";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Cadastrar Usuário - Biblioteca</title>
</head>
<body>
    <nav class="menu">
        <div class="dropdown">
            <button class="dropbtn">Usuários</button>
            <div class="dropdown-content">
                <a href="cadastrar.php">Cadastrar Usuário</a>
                <a href="listar.php">Listar Usuários</a>
            </div>
        </div>

        <div class="dropdown">
            <button class="dropbtn">Livros</button>
            <div class="dropdown-content">
                <a href="../livros/cadastrar.php">Cadastrar Livro</a>
                <a href="../livros/listar.php">Listar Livros</a>
            </div>
        </div>

        <div class="dropdown">
            <button class="dropbtn">Aluguéis</button>
            <div class="dropdown-content">
                <a href="../aluguel/listar.php">Meus Aluguéis</a>
                <a href="../aluguel/historico.php">Histórico</a>
            </div>
        </div>

        <a href="../logout.php" class="logout">Sair</a>
    </nav>

    <div class="container">
        <h1>Cadastrar Usuário</h1>
        
        <?php if (!empty($mensagem)) : ?>
            <p class="<?php echo $tipo_mensagem; ?>"><?php echo htmlspecialchars($mensagem); ?></p>
        <?php endif; ?>

        <form action="" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <label for="tipo">Tipo de Usuário:</label>
            <select name="tipo" id="tipo" required>
                <option value="aluno">Aluno</option>
                <option value="admin">Administrador</option>
            </select>

            <button type="submit">Cadastrar</button>
        </form>

        <a href="../painel.php" class="btn-voltar">Voltar ao Painel</a>
    </div>
</body>
</html>