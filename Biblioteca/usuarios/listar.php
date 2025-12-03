<?php
require_once '../config.php';
session_start();
require_admin();

$mensagem = "";

// Processar busca
$busca = $_GET['busca'] ?? '';
$filtro_tipo = $_GET['tipo'] ?? '';

try {
    $sql = "SELECT id, nome, email, tipo, created_at FROM usuarios WHERE 1=1";
    $params = [];
    
    if (!empty($busca)) {
        $sql .= " AND (nome LIKE :busca OR email LIKE :busca)";
        $params[':busca'] = "%$busca%";
    }
    
    if (!empty($filtro_tipo)) {
        $sql .= " AND tipo = :tipo";
        $params[':tipo'] = $filtro_tipo;
    }
    
    $sql .= " ORDER BY id DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $usuarios = $stmt->fetchAll();
    
} catch (PDOException $e) {
    error_log("Erro ao listar usuários: " . $e->getMessage());
    $usuarios = [];
    $mensagem = show_message("Erro ao carregar usuários.", "erro");
}

// Mostrar mensagens de sessão
if (isset($_SESSION['sucesso_exclusao'])) {
    $mensagem = show_message($_SESSION['sucesso_exclusao'], "success");
    unset($_SESSION['sucesso_exclusao']);
}
if (isset($_SESSION['erro_exclusao'])) {
    $mensagem = show_message($_SESSION['erro_exclusao'], "erro");
    unset($_SESSION['erro_exclusao']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuários - Biblioteca</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav class="menu">
        <div class="dropdown">
            <button class="dropbtn">👥 Usuários</button>
            <div class="dropdown-content">
                <a href="cadastrar.php">Cadastrar Usuário</a>
                <a href="listar.php">Listar Usuários</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">📚 Livros</button>
            <div class="dropdown-content">
                <a href="../livros/cadastrar.php">Cadastrar Livro</a>
                <a href="../livros/listar.php">Listar Livros</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">📖 Aluguéis</button>
            <div class="dropdown-content">
                <a href="../alugueis/cadastrar.php">Alugar Livro</a>
                <a href="../alugueis/listar.php">Listar Aluguéis</a>
            </div>
        </div>
        <a href="../logout.php" class="logout">Sair</a>
    </nav>

    <div class="lista-container">
        <h1>👥 Lista de Usuários</h1>
        
        <?= $mensagem ?>
        
        <!-- Filtros e Busca -->
        <form method="GET" style="margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap;">
            <input type="text" 
                   name="busca" 
                   placeholder="🔍 Buscar por nome ou email..." 
                   value="<?= sanitize_input($busca) ?>"
                   style="flex: 1; min-width: 200px;">
            
            <select name="tipo" style="width: auto;">
                <option value="">Todos os tipos</option>
                <option value="admin" <?= $filtro_tipo == 'admin' ? 'selected' : '' ?>>Administrador</option>
                <option value="aluno" <?= $filtro_tipo == 'aluno' ? 'selected' : '' ?>>Aluno</option>
            </select>
            
            <button type="submit" class="btn" style="width: auto; padding: 10px 20px;">Filtrar</button>
            <?php if ($busca || $filtro_tipo): ?>
            <a href="listar.php" class="btn-voltar" style="width: auto; padding: 10px 20px; margin: 0;">Limpar</a>
            <?php endif; ?>
        </form>

        <div style="margin-bottom: 15px; color: #666;">
            <strong>Total:</strong> <?= count($usuarios) ?> usuário(s) encontrado(s)
        </div>

        <?php if (empty($usuarios)): ?>
            <div class="info-box" style="text-align: center;">
                <strong>Nenhum usuário encontrado</strong>
                <?php if ($busca || $filtro_tipo): ?>
                <p>Tente ajustar os filtros de busca</p>
                <?php else: ?>
                <p>Comece cadastrando alguns usuários</p>
                <?php endif; ?>
            </div>
        <?php else: ?>
        <table class="tabela-usuarios">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Cadastrado em</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= $usuario['id'] ?></td>
                    <td><?= sanitize_input($usuario['nome']) ?></td>
                    <td><?= sanitize_input($usuario['email']) ?></td>
                    <td>
                        <span style="padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: bold; 
                                     <?= $usuario['tipo'] == 'admin' ? 'background: #d1e7ff; color: #084298;' : 'background: #d1e7dd; color: #0f5132;' ?>">
                            <?= $usuario['tipo'] == 'admin' ? '⭐ Admin' : '📖 Aluno' ?>
                        </span>
                    </td>
                    <td><?= format_date($usuario['created_at'], 'd/m/Y H:i') ?></td>
                    <td>
                        <a href="editar.php?id=<?= $usuario['id'] ?>" class="btn-editar">✏️ Editar</a>
                        <?php if ($usuario['id'] != $_SESSION['usuario_id']): ?>
                        <a href="excluir.php?id=<?= $usuario['id'] ?>" 
                           class="btn-excluir" 
                           onclick="return confirm('Deseja realmente excluir este usuário?\n\nEsta ação não pode ser desfeita!')">
                           🗑️ Excluir
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
        
        <div style="margin-top: 20px; display: flex; gap: 10px;">
            <a href="cadastrar.php" class="btn">+ Cadastrar Novo Usuário</a>
            <a href="../painel.php" class="btn-voltar">← Voltar ao Painel</a>
        </div>
    </div>
</body>
</html>