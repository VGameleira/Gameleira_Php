<?php
require_once 'Carro.php';
require_once 'Moto.php';
require_once 'Cliente.php';

session_start();

// Encerrar sessão e forçar login novamente
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

// Verificar se o cliente está cadastrado
if (!isset($_SESSION['cliente'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'], $_POST['cpf'])) {
        $nome = trim($_POST['nome']);
        $cpf = trim($_POST['cpf']);

        if (!empty($nome) && !empty($cpf)) {
            $_SESSION['cliente'] = new Cliente($nome, $cpf);
        }
    }


    // Exibir formulário de cadastro se o cliente não estiver cadastrado
    if (!isset($_SESSION['cliente'])) {
        echo '<!DOCTYPE html>';
        echo '<html lang="pt-BR">';
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<title>Cadastro de Cliente</title>';
        echo '<link rel="stylesheet" href="style.css">';
        echo '</head>';
        echo '<body>';
        echo '<h1>Cadastro de Cliente</h1>';
        echo '<form method="post">';
        echo '<label for="nome">Nome:</label><br>';
        echo '<input type="text" id="nome" name="nome" required><br><br>';
        echo '<label for="cpf">CPF:</label><br>';
        echo '<input type="text" id="cpf" name="cpf" required><br><br>';
        echo '<button type="submit">Cadastrar</button>';
        echo '</form>';
        echo '</body>';
        echo '</html>';
        exit;
    }
}

// Criando objetos de Carro e Moto
if (!isset($_SESSION['veiculos'])) {
    $carro1 = new Carro("Toyota", "Corolla", 150, 4);
    $carro2 = new Carro("Honda", "Civic", 160, 4);
    $carro3 = new Carro("Ford", "Focus", 140, 4);

    $moto1 = new Moto("Yamaha", "YZF-R3", 100, 321);
    $moto2 = new Moto("Kawasaki", "Ninja 400", 110, 399);
    $moto3 = new Moto("Honda", "CBR 500R", 120, 471);

    $_SESSION['veiculos'] = [$carro1, $carro2, $carro3, $moto1, $moto2, $moto3];
}

$veiculos = $_SESSION['veiculos'];

// Processar ações de aluguel ou devolução
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? null;
    $indice = $_POST['indice'] ?? null;

    // Garantir que o índice é válido
    if ($acao && $indice !== null) {
        if ($acao === 'alugar' && $veiculos[$indice]->isDisponivel()) {
            $veiculos[$indice]->alugar();
        } elseif ($acao === 'devolver' && !$veiculos[$indice]->isDisponivel()) {
            $veiculos[$indice]->devolver();
        }

        $_SESSION['veiculos'] = $veiculos;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluguel de Veículos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Bem-vindo, <?= $_SESSION['cliente']->getNome(); ?>!</h1>
    <form method="post" style="text-align: right;">
        <button type="submit" name="logout">Sair</button>
    </form>
    <h2>Aluguel de Carros e Motos</h2>

    <!-- // Tabela de veículos disponíveis para aluguel -->
    <table border="1">
        <tr>
            <th>Tipo</th>
            <th>Descrição</th>
            <th>Preço da Diária</th>
            <th>Status</th>
            <th>Ação</th>
        </tr>
        <!-- // Formulario para listar veículos -->
        <?php foreach ($veiculos as $indice => $veiculo): ?>
            <tr>
                <td><?= ($veiculo instanceof Carro) ? "Carro" : "Moto"; ?></td>
                <td><?= $veiculo->getDescricao(); ?></td>
                <td>R$ <?= $veiculo->getPrecoDiaria(); ?></td>
                <td><?= $veiculo->isDisponivel() ? "Disponível" : "Alugado"; ?></td>
                <td>
                    <!-- // Formulário para alugar ou devolver -->
                    <?php if ($veiculo->isDisponivel()): ?>
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="indice" value="<?= $indice; ?>">
                            <input type="hidden" name="acao" value="alugar">
                            <label for="dias">Dias:</label>
                            <input type="number" name="dias" min="1" id="dias" required>
                            <button type="submit">Alugar</button>
                        </form>
                        <!-- // Formulário para calcular custo total -->
                    <?php else: ?>
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="indice" value="<?= $indice; ?>">
                            <input type="hidden" name="acao" value="devolver">
                            <button type="submit">Devolver</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php
    // Calcular e exibir o custo total do aluguel se o formulário for enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dias'], $_POST['indice'])) {
        $dias = (int)$_POST['dias'];
        $indice = (int)$_POST['indice'];

        // Garantir que o índice e os dias são válidos
        if ($dias > 0 && isset($veiculos[$indice])) {
            $custoTotal = $veiculos[$indice]->calcularCustoTotal($dias);
            echo "<p>Custo total para $dias dia(s): R$ " . number_format($custoTotal, 2, ',', '.') . "</p>";
        }
    }
    ?>
</body>
</html>