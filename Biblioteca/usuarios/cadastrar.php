<?php
require '../conexao.php';
session_start();

// Verifica se está logado
if(!isset($_SESSION['usuario'])){
    header("location:../index.php");
    exit;
}

// Verifica se é admin
if($_SESSION['tipo'] !== 'admin'){
    header("location:../painel.php");
    exit;
}

$mensagem = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $titulo = trim($_POST['titulo']);
    $autor = trim($_POST['autor']);
    $disponivel = isset($_POST['disponivel']) ? 1 : 0;
    
    // Processar upload da imagem
    $imagem = null;
    if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0){
        $pasta_destino = '../uploads/';
        
        // Criar pasta se não existir
        if(!is_dir($pasta_destino)){
            mkdir($pasta_destino, 0777, true);
        }
        
        $nome_arquivo = time() . '_' . basename($_FILES['imagem']['name']);
        $caminho_completo = $pasta_destino . $nome_arquivo;
        
        // Verificar tipo de arquivo
        $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
        if(in_array($_FILES['imagem']['type'], $tipos_permitidos)){
            if(move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_completo)){
                $imagem = 'uploads/' . $nome_arquivo;
            }
        }
    }
    
    try{
        $sql = "INSERT INTO livros(titulo, autor, disponivel, imagem) VALUES(:titulo, :autor, :disponivel, :imagem)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':titulo' => $titulo,
            ':autor' => $autor,
            ':disponivel' => $disponivel,
            ':imagem' => $imagem
        ]);
        
        $mensagem = "<p class='sucesso'>Livro cadastrado com sucesso!</p>";
    }catch(PDOException $e){
        $mensagem = "<p class='erro'>Erro ao cadastrar: " . $e->getMessage() . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Livro</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Cadastrar Livro</h1>
        <?php echo $mensagem; ?>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="titulo" placeholder="Título" required>
            <input type="text" name="autor" placeholder="Autor" required>
            <label style="display: block; margin: 10px 0;">
                <input type="checkbox" name="disponivel" checked style="width: auto; display: inline-block;"> Disponível
            </label>
            <input type="file" name="imagem" accept="image/*">
            <button type="submit">Cadastrar</button>
            <a href="../painel.php" class="btn-voltar" style="display: block; text-align: center; margin-top: 10px;">Voltar ao Painel</a>
        </form>
    </div>
</body>
</html>