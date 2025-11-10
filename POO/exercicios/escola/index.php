<?php

require_once 'SistemaLogin.php';



session_start();



// Inicializar sistema de login

if (!isset($_SESSION['sistema_login'])) {

 $_SESSION['sistema_login'] = new SistemaLogin();

}



$sistema = $_SESSION['sistema_login'];



// Processar login

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {

 $codigo = $_POST['codigo'];

 $senha = $_POST['senha'];

  

 if ($sistema->autenticar($codigo, $senha)) {

 $_SESSION['usuario_logado'] = true;

 } else {

 $erro_login = "Código ou senha inválidos!";

 }

}



// Processar logout

if (isset($_GET['logout'])) {

 $sistema->logout();

 session_destroy();

 header("Location: index.php");

 exit();

}



$usuario = $sistema->getUsuarioLogado();

?>



<!DOCTYPE html>

<html lang="pt-BR">

<head>

 <meta charset="UTF-8">

 <meta name="viewport" content="width=device-width, initial-scale=1.0">

 <title>Sistema Escolar - Login</title>

 <link rel="stylesheet" href="style.css">

</head>

<body>

 <?php if (!$sistema->estaLogado()): ?>

 <!-- Tela de Login -->

 <div class="login-container">

 <h1>🏫 Sistema Escolar</h1>

 <h2>Login</h2>

  

 <?php if (isset($erro_login)): ?>

 <div class="error"><?= $erro_login ?></div>

 <?php endif; ?>

  

 <form method="POST">

 <div class="form-group">

 <label for="codigo">Código (Matrícula/Professor):</label>

 <input type="text" id="codigo" name="codigo" required>

 </div>

  

 <div class="form-group">

 <label for="senha">Senha:</label>

 <input type="password" id="senha" name="senha" required>

 </div>

  

 <button type="submit" name="login">Entrar</button>

 </form>

  

 <footer>

 <p>Use: Estudantes (2024001-2024004) | Professores (PROF001-PROF004)</p>

 <p>Senha padrão: nome123 (ex: maria123, joao123)</p>

 </footer>

 </div>

  

 <?php else: ?>

 <!-- Conteúdo após login -->

 <div class="container">

 <div class="user-info">

 <h3>Bem-vindo, <?= $usuario->getNome() ?>!</h3>

 <p>Tipo: <?= $usuario->getTipo() ?> |

 <?= $usuario->getTipo() === 'Estudante' ? 'Matrícula' : 'Código' ?>:

 <?= $usuario->getTipo() === 'Estudante' ? $usuario->getMatricula() : $usuario->getCodigo() ?></p>

 <a href="?logout=true" class="logout-btn">Sair</a>

 </div>

  

 <h1>🏫 Sistema Escolar</h1>

  

 <?php if ($usuario->getTipo() === 'Estudante'): ?>

 <!-- Painel do Estudante -->

 <div class="info-card">

 <h3>📊 Meu Boletim</h3>

 <?php $boletim = $usuario->visualizarBoletim(); ?>

 <p><strong>Matrícula:</strong> <?= $boletim['matricula'] ?></p>

 <p><strong>Curso:</strong> <?= $boletim['curso'] ?></p>

 <p><strong>Nota:</strong> <?= $boletim['nota'] ?></p>

 <p><strong>Situação:</strong> <?= $boletim['situacao'] ?></p>

 </div>

  

 <?php else: ?>

 <!-- Painel do Professor -->

 <div class="info-card">

 <h3>👨‍🏫 Minhas Informações</h3>

 <?php $turmas = $usuario->visualizarTurmas(); ?>

 <p><strong>Código:</strong> <?= $turmas['codigo'] ?></p>

 <p><strong>Disciplina:</strong> <?= $turmas['disciplina'] ?></p>

 <p><strong>Salário:</strong> <?= $turmas['salario'] ?></p>

 <p><strong>Ação:</strong> <?= $usuario->darAula() ?></p>

 </div>

 <?php endif; ?>

  

 <!-- Tabela de todas as pessoas (apenas para demonstração) -->

 <h3>👥 Comunidade Escolar</h3>

 <table>

 <thead>

 <tr>

 <th>Tipo</th>

 <th>Nome</th>

 <th>Idade</th>

 <th>Descrição</th>

 </tr>

 </thead>

 <tbody>

 <?php

 $todasPessoas = [

 new Estudante("Maria Silva", 20, "Matemática", 9.5, "2024001"),

 new Estudante("Carlos Oliveira", 22, "História", 8.0, "2024002"),

 new Estudante("João Silva", 17, "Informática", 8.5, "2024003"),

 new Estudante("Ana Souza", 16, "Administração", 5.8, "2024004"),

 new Professor("João Santos", 45, "Física", 3500.00, "PROF001"),

 new Professor("Carlos Pereira", 42, "Matemática", 4200.00, "PROF002"),

 new Professor("Ana Lima", 35, "Português", 3900.00, "PROF003"),

 new Professor("Mariana Costa", 38, "Química", 4000.00, "PROF004")

 ];

  

 foreach ($todasPessoas as $pessoa): ?>

 <tr>

 <td><?= $pessoa->getTipo(); ?></td>

 <td><?= htmlspecialchars($pessoa->getNome()); ?></td>

 <td><?= $pessoa->getIdade(); ?></td>

 <td><?= htmlspecialchars($pessoa->getDescricao()); ?></td>

 </tr>

 <?php endforeach; ?>

 </tbody>

 </table>

  

 <footer>

 <p>Desenvolvido em PHP Orientado a Objeto - Sistema com Login e Painéis Diferenciados</p>

 </footer>

 </div>

 <?php endif; ?>

</body>

</html>