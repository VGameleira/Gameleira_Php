<?php
// Inclui o arquivo da classe pai ContaBancaria
include_once 'ContaBancaria.php';

/**
 * Classe ContaPoupanca
 * 
 * Esta classe herda de ContaBancaria
 * Adiciona a funcionalidade de rendimentos (juros) sobre o saldo
 * Típico de contas poupança que rendem um percentual por período
 */
class ContaPoupanca extends ContaBancaria {
    
    // Propriedade privada que armazena a taxa de rendimentos
    // Por exemplo: 0.0005 = 0.05% de rendimento
    private $taxaRendimentos;

    /**
     * Construtor da classe ContaPoupanca
     * 
     * @param float $taxaRendimentos - Taxa de rendimento (padrão: 0.0005 = 0.05%)
     * 
     * Inicializa a conta poupança com uma taxa de rendimento
     */
    public function __construct($taxaRendimentos = 0.0005) {
        // Chama o construtor da classe pai para inicializar o saldo
        parent::__construct();
        
        // Inicializa a taxa de rendimentos da sessão ou usa o valor padrão
        $this->taxaRendimentos = isset($_SESSION['taxaRendimentos']) 
            ? $_SESSION['taxaRendimentos'] 
            : $taxaRendimentos;
    }

    /**
     * Método para aplicar rendimentos ao saldo
     * 
     * Este método calcula os juros sobre o saldo atual
     * e adiciona esse valor à conta
     * 
     * Exemplo: Se o saldo é R$ 1000 e a taxa é 0.0005 (0.05%),
     * o rendimento será R$ 0,50
     */
    public function aplicarRendimentos() {
        // Calcula o valor dos rendimentos: saldo * taxa
        $rendimentos = $this->getSaldo() * $this->taxaRendimentos;
        
        // Arredonda o valor para 2 casas decimais (centavos)
        // round() evita problemas com valores muito pequenos
        $rendimentoArredondado = round($rendimentos, 2);
        
        // Deposita o valor dos rendimentos na conta
        // Usa o método depositar da classe pai
        $this->depositar($rendimentoArredondado);
        
        // Exibe mensagem de sucesso com o valor formatado
        echo "<p style='color: green;'>Rendimentos de R$ " 
            . number_format($rendimentos, 2, ',', '.') 
            . " aplicados com sucesso!</p>";
    }

    /**
     * Métodos comentados - podem ser úteis no futuro
     * 
     * Estes métodos permitiriam consultar e alterar a taxa de rendimentos
     * Estão comentados porque não estão sendo usados no momento
     */
    
    // public function getTaxaRendimentos() {
    //     return $this->taxaRendimentos;
    // }
    
    // public function setTaxaRendimentos($valor) {
    //     $this->taxaRendimentos = $valor;
    //     $_SESSION['taxaRendimentos'] = $this->taxaRendimentos;
    // }
}
?>

<?php
// === PARTE DE PROCESSAMENTO DO FORMULÁRIO ===

// Inclui a classe ContaPoupanca
include_once 'ContaPoupanca.php';

// Cria uma instância da classe ContaPoupanca
$contaPoupanca = new ContaPoupanca();

// Verifica se o usuário clicou no botão "Depositar"
if (isset($_POST['depositar'])) {
    // Converte o valor do formulário para float
    $quantia = floatval($_POST['quantia']);
    
    // Tenta realizar o depósito e exibe mensagem apropriada
    if ($contaPoupanca->depositar($quantia)) {
        echo "<p style='color: green;'>Depósito de R$ " 
            . number_format($quantia, 2, ',', '.') 
            . " realizado com sucesso!</p>";
    } else {
        echo "<p style='color: red;'>Erro: valor inválido para depósito.</p>";
    }
}

// Verifica se o usuário clicou no botão "Sacar"
if (isset($_POST['sacar'])) {
    $quantia = floatval($_POST['quantia']);
    
    // Tenta realizar o saque e exibe mensagem apropriada
    if ($contaPoupanca->sacar($quantia)) {
        echo "<p style='color: green;'>Saque de R$ " 
            . number_format($quantia, 2, ',', '.') 
            . " realizado com sucesso!</p>";
    } else {
        echo "<p style='color: red;'>Erro: saldo insuficiente ou valor inválido.</p>";
    }
}

// CORREÇÃO DO BUG: Agora o nome do botão está correto
// Antes estava 'aplicarJuros' no HTML mas verificava 'aplicarRendimentos' aqui
if (isset($_POST['aplicarRendimentos'])) {
    // Chama o método que aplica os rendimentos
    $contaPoupanca->aplicarRendimentos();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conta Poupança</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Cabeçalho da página -->
<header>
    <h1>Detalhes da Conta Poupança</h1>
</header>

<!-- Menu de navegação -->
<nav>
    <a href="index.php">Início</a>
    <a href="ContaCorrente.php">Conta Corrente</a>
</nav>

<!-- Container principal com o conteúdo -->
<div class="container">
    <?php
    // Exibe o saldo atual formatado
    echo "<p><strong>Saldo atual:</strong> R$ " 
        . number_format($contaPoupanca->getSaldo(), 2, ',', '.') 
        . "</p>";
    ?>

    <!-- Formulário para depósito -->
    <form method="post">
        <label for="quantia_deposito">Valor do Depósito:</label>
        <input type="number" step="0.01" name="quantia" id="quantia_deposito" required>
        <input type="submit" name="depositar" value="Depositar">
    </form>

    <!-- NOVO: Formulário para saque (estava faltando) -->
    <form method="post">
        <label for="quantia_saque">Valor do Saque:</label>
        <input type="number" step="0.01" name="quantia" id="quantia_saque" required>
        <input type="submit" name="sacar" value="Sacar">
    </form>

    <!-- Formulário para aplicar rendimentos -->
    <!-- CORREÇÃO: Agora o name está correto: "aplicarRendimentos" -->
    <form method="post">
        <input type="submit" name="aplicarRendimentos" value="Aplicar Rendimentos">
    </form>
    
    <p style="font-size: 12px; color: #666;">
        <em>Dica: Os rendimentos são calculados com base na taxa de 0.05% sobre o saldo atual.</em>
    </p>
</div>

</body>
</html>