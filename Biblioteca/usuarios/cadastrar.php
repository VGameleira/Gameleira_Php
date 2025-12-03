<?php
require_once '../config.php';
session_start();
require_admin();

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $tipo = $_POST['tipo'] ?? 'aluno';
    
    if (empty($nome) || empty($email) || empty($senha)) {
        $mensagem = show_message("Preencha todos os campos obrigatórios.", "erro");
    } elseif (strlen($senha) < 6) {
        $mensagem = show_message("Senha deve ter no mínimo 6 caracteres.", "erro");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagem = show_message("Email inválido.", "erro");
    } else {
        try {
            // Verificar se email já existe
            $sql = "SELECT id FROM usuarios WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':email' => $email]);
            
            if ($stmt->fetch()) {
                $mensagem = show_message("Email já cadastrado.", "erro");
            } else {
                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
                
                $sql = "INSERT INTO usuarios (nome, email, senha, tipo) 
                        VALUES (:nome, :email, :senha, :tipo)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':nome' => $nome,
                    ':email' => $email,
                    ':senha' => $senha_hash,
                    ':tipo' => $tipo
                ]);
                
                $mensagem = show_message("Usuário cadastrado com sucesso!", "success");
                $nome = $email = '';
            }
            
        } catch (Exception $e) {
            error_log("Erro ao cadastrar usuário: " . $e->getMessage());
            $mensagem = show_message($e->getMessage(), "erro");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário - Biblioteca</title>
    <link rel="stylesheet" href="..style.css">
</head>
<body>
    <nav class="menu">
        <div class="dropdown">
            <button class="dropbtn">👥 Usuários</button>
            <div class="dropdown-content">
                <a href="cadastrar.php">📝 Cadastrar Usuário</a>
                <a href="listar.php">📋 Listar Usuários</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">📚 Livros</button>
            <div class="dropdown-content">
                <a href="../livros/cadastrar.php">📝 Cadastrar Livro</a>
                <a href="../livros/listar.php">📋 Listar Livros</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">📖 Aluguéis</button>
            <div class="dropdown-content">
                <a href="../alugueis/cadastrar.php">📋 Alugar Livro</a>
                <a href="../alugueis/listar.php">📋 Listar Aluguéis</a>
            </div>
        </div>
        <a href="../logout.php" class="logout">🚪 Sair</a>
    </nav>

    <div class="container">
        <h1>👥 Cadastrar Novo Usuário</h1>
        
        <?= $mensagem ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="nome">👤 Nome Completo *</label>
                <input type="text" 
                       id="nome" 
                       name="nome" 
                       value="<?= isset($nome) ? sanitize_input($nome) : '' ?>"
                       placeholder="Digite o nome completo"
                       required>
            </div>
            
            <div class="form-group">
                <label for="email">📧 Email *</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="<?= isset($email) ? sanitize_input($email) : '' ?>"
                       placeholder="Digite o email"
                       required>
            </div>
            
            <div class="form-group">
                <label for="senha">🔒 Senha *</label>
                <input type="password" 
                       id="senha" 
                       name="senha" 
                       placeholder="Digite a senha (mínimo 6 caracteres)"
                       required>
                <small>Mínimo de 6 caracteres</small>
            </div>
            
            <div class="form-group">
                <label for="tipo">👑 Tipo de Usuário</label>
                <select id="tipo" name="tipo">
                    <option value="aluno">👨‍🎓 Aluno</option>
                    <option value="admin">👑 Administrador</option>
                </select>
            </div>
            
            <button type="submit" class="btn">✓ Cadastrar Usuário</button>
            <a href="listar.php" class="btn-voltar">← Ver Usuários</a>
        </form>
    </div>
</body>
</html>