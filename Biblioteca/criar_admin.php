<?php
/**
 * Script para criar usuário administrador
 * Acesse: http://localhost/Biblioteca/criar_admin.php
 *DELETE ESTE ARQUIVO após criar o admin!
 */

require_once 'config.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    
    try {
        // Verificar se já existe
        $sql = "SELECT id FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        
        if ($stmt->fetch()) {
            $mensagem = "<p class='erro'>Este email já está cadastrado!</p>";
        } else {
            // Criar hash da senha
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            
            // Inserir admin
            $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES (:nome, :email, :senha, 'admin')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nome' => $nome,
                ':email' => $email,
                ':senha' => $senha_hash
            ]);
            
            $mensagem = "<p class='sucesso'>✓ Admin criado com sucesso!<br>Email: $email<br>Senha: $senha<br><br><strong>ANOTE ESSAS CREDENCIAIS!</strong><br><a href='index.php'>Ir para Login</a></p>";
        }
    } catch (PDOException $e) {
        $mensagem = "<p class='erro'>Erro: " . $e->getMessage() . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Admin</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <h1>🔐 Criar Usuário Admin</h1>
        
        <?= $mensagem ?>
        
        <form method="POST">
            <div class="form-group">
                <label>Nome Completo</label>
                <input type="text" name="nome" placeholder="Seu nome" required>
            </div>
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="admin@biblioteca.com" required>
            </div>
            
            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="senha" placeholder="Mínimo 6 caracteres" required>
            </div>
            
            <button type="submit" class="btn">Criar Admin</button>
        </form>
        
        <div style="margin-top: 20px; padding: 15px; background: #fff3cd; border-radius: 10px; color: #856404;">
            <strong>⚠️ IMPORTANTE:</strong> Delete este arquivo após criar o admin!
        </div>
    </div>
</body>
</html>