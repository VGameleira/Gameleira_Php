<?php 
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];

    require_once '../config/conexao.php';

    // Buscar os dados atuais do usuário
    $sql = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        echo "Usuário não encontrado.";
        exit();
    }

    // Processar o formulário de edição
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $nova_senha = $_POST['nova_senha'];
        $tipo = $_POST['tipo'];

        // Atualizar a senha somente se uma nova senha for fornecida
        if (!empty($nova_senha)) {
            $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, tipo = :tipo WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':senha', $senha_hash, PDO::PARAM_STR);
        } else {
            $sql = "UPDATE usuarios SET nome = :nome, email = :email, tipo = :tipo WHERE id = :id";
            $stmt = $conexao->prepare($sql);
        }

        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Usuário atualizado com sucesso.";
            // Recarregar os dados atualizados
            header("Location: listar.php");
            exit();
        } else {
            echo "Erro ao atualizar o usuário.";
        }
    }
} else {
    echo "ID do usuário não fornecido.";
    exit();
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="card-editar">
        <h1>Editar Usuário</h1>
        <form action="" method="Post">
            <div class="input-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
                        </div>

            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
            </div>
            <div class="input-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" value="" placeholder="Deixe em branco para manter a senha atual">
                <label for="">Nova Senha</label>
                <input type="password" id="nova_senha" name="nova_senha" value="">
            </div>
            <div class="input-group">
                <label for="tipo">Tipo:</label>
                <select id="tipo" name="tipo" required>
                    <option value="admin" <?= $usuario['tipo'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="usuario" <?= $usuario['tipo'] === 'usuario' ? 'selected' : '' ?>>Usuário</option>
                </select>

                <button type="submit" class="btn">Salvar as Alterações</button>
                <a href="listar.php" class="btn-voltar">Voltar</a>
        </form>
    </div>
</body>
</html>