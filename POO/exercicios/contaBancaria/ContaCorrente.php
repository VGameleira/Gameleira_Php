<?php
// Inclui o arquivo da classe pai ContaBancaria
// require_once garante que o arquivo seja incluído apenas uma vez
require_once 'ContaBancaria.php';

/**
 * Classe ContaCorrente
 * 
 * Esta classe herda (extends) de ContaBancaria
 * Adiciona a funcionalidade de limite especial (cheque especial)
 * Também sobrescreve (polimorfismo) o método sacar para considerar o limite
 */
class ContaCorrente extends ContaBancaria {
    
    // Propriedade privada que armazena o limite disponível (cheque especial)
    private $limite;

    /**
     * Construtor da classe ContaCorrente
     * 
     * @param float $limite - Valor inicial do limite (padrão: 500)
     * 
     * Este método inicializa a conta corrente
     * Chama o construtor da classe pai e inicializa o limite
     */
    public function __construct($limite = 500) {
        // Chama o construtor da classe pai (ContaBancaria)
        // Isso inicializa o saldo
        parent::__construct();
        
        // Inicializa o limite: usa o valor da sessão se existir,
        // senão usa o valor padrão passado como parâmetro
        $this->limite = isset($_SESSION['limite']) ? $_SESSION['limite'] : $limite;
    }

    /**
     * Método para consultar o limite disponível
     * 
     * @return float - Retorna o valor do limite atual
     */
    public function getLimite() {
        return $this->limite;
    }

    /**
     * Método para definir/alterar o limite
     * 
     * @param float $valor - O novo valor do limite
     */
    public function setLimite($valor) {
        $this->limite = $valor;
        // Salva o limite na sessão
        $_SESSION['limite'] = $this->limite;
    }

    /**
     * Método sacar (POLIMORFISMO - Sobrescreve o método da classe pai)
     * 
     * @param float $quantia - Valor a ser sacado
     * @return bool - true se o saque foi bem-sucedido, false caso contrário
     * 
     * Esta versão do método sacar considera o limite especial
     * Permite sacar mesmo sem saldo suficiente, usando o limite
     */
    public function sacar($quantia) {
        // Calcula o saldo total disponível (saldo + limite)
        $saldoDisponivel = $this->getSaldo() + $this->limite;

        // Verifica se a quantia é válida e se há saldo/limite suficiente
        if ($quantia > 0 && $quantia <= $saldoDisponivel) {
            
            // Verifica se a quantia é maior que o saldo atual
            if ($quantia > $this->getSaldo()) {
                // Caso precise usar o limite:
                
                // Calcula quanto do limite será usado
                $valorUsadoDoLimite = $quantia - $this->getSaldo();
                
                // Reduz o limite disponível
                $this->setLimite($this->limite - $valorUsadoDoLimite);
                
                // Zera o saldo (foi todo usado)
                $this->setSaldo(0);
            } else {
                // Caso o saldo seja suficiente:
                // Apenas reduz do saldo, sem usar o limite
                $this->setSaldo($this->getSaldo() - $quantia);
            }
            
            // Mensagem de sucesso formatada com 2 casas decimais
            echo "Saque de R$ " . number_format($quantia, 2, ',', '.') . " realizado com sucesso.<br>";
            return true;
        } else {
            // Mensagem de erro quando não há saldo/limite suficiente
            echo "Saldo e limite insuficientes para o saque.<br>";
            return false;
        }
    }

    /**
     * Método para transferir dinheiro entre contas correntes
     * 
     * @param float $valor - Valor a ser transferido
     * @param ContaCorrente $contaDestino - Objeto da conta que receberá o dinheiro
     * @return bool - true se a transferência foi bem-sucedida
     * 
     * Este método realiza uma transferência entre duas contas
     * Saca da conta atual e deposita na conta de destino
     */
    public function transferir($valor, ContaCorrente $contaDestino) {
        // Verifica se o valor é válido e se há saldo/limite suficiente
        if ($valor > 0 && $valor <= ($this->getSaldo() + $this->limite)) {
            // Saca o valor desta conta (pode usar o limite)
            $this->sacar($valor);
            // Deposita o valor na conta de destino
            $contaDestino->depositar($valor);
            return true;
        } else {
            echo "Transferência não realizada. Saldo ou limite insuficiente.<br>";
            return false;
        }
    }
}
?>

<?php
// === PARTE DE PROCESSAMENTO DO FORMULÁRIO ===

// Inclui a classe ContaCorrente
include_once 'ContaCorrente.php';

// Cria uma instância (objeto) da classe ContaCorrente
// Este objeto representa a conta do usuário
$contaCorrente = new ContaCorrente();

// Verifica se o usuário clicou no botão "Depositar"
// isset() verifica se a variável existe
if (isset($_POST['depositar'])) {
    // Converte o valor do formulário para float (número decimal)
    $quantia = floatval($_POST['quantia']);
    
    // Chama o método depositar
    if ($contaCorrente->depositar($quantia)) {
        echo "<p style='color: green;'>Depósito de R$ " . number_format($quantia, 2, ',', '.') . " realizado com sucesso!</p>";
    } else {
        echo "<p style='color: red;'>Erro: valor inválido para depósito.</p>";
    }
}

// Verifica se o usuário clicou no botão "Sacar"
if (isset($_POST['sacar'])) {
    $quantia = floatval($_POST['quantia']);
    // O método sacar já exibe as mensagens, então só chamamos ele
    $contaCorrente->sacar($quantia);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conta Corrente</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Cabeçalho da página -->
<header>
    <h1>Detalhes da Conta Corrente</h1>
</header>

<!-- Menu de navegação -->
<nav>
    <a href="index.php">Início</a>
    <a href="ContaPoupanca.php">Poupança</a>
</nav>

<!-- Container principal com o conteúdo -->
<div class="container">
    <?php
    // Exibe o saldo atual formatado com 2 casas decimais
    // number_format formata o número: (valor, casas decimais, separador decimal, separador de milhar)
    echo "<p><strong>Saldo atual:</strong> R$ " . number_format($contaCorrente->getSaldo(), 2, ',', '.') . "</p>";
    
    // Exibe o limite disponível formatado
    echo "<p><strong>Limite disponível:</strong> R$ " . number_format($contaCorrente->getLimite(), 2, ',', '.') . "</p>";
    
    // Calcula e exibe o total disponível (saldo + limite)
    $totalDisponivel = $contaCorrente->getSaldo() + $contaCorrente->getLimite();
    echo "<p><strong>Total disponível:</strong> R$ " . number_format($totalDisponivel, 2, ',', '.') . "</p>";
    ?>

    <!-- Formulário para depósito -->
    <!-- method="post" significa que os dados serão enviados de forma segura -->
    <form method="post">
        <label for="quantia_deposito">Valor do Depósito:</label>
        <!-- step="0.01" permite valores com centavos -->
        <!-- required torna o campo obrigatório -->
        <input type="number" step="0.01" name="quantia" id="quantia_deposito" required>
        <input type="submit" name="depositar" value="Depositar">
    </form>

    <!-- Formulário para saque -->
    <form method="post">
        <label for="quantia_saque">Valor do Saque:</label>
        <input type="number" step="0.01" name="quantia" id="quantia_saque" required>
        <input type="submit" name="sacar" value="Sacar">
    </form>
</div>

</body>
</html>