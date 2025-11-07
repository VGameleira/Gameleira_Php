<?php

require_once 'ContaBancaria.php';

class ContaCorrente extends ContaBancaria
{
    private $limite;

    public function __construct($limite = 500)
    {
        parent::__construct();
        $this->limite = isset($_SESSION['limite']) ? $_SESSION['limite'] : $limite;
    }

    public function getLimite()
    {
        return $this->limite;
    }

    public function setLimite($valor)
    {
        $this->limite = $valor;
        $_SESSION['limite'] = $this->limite;
    }

    // Polimorfismo: Sobrescrevendo o método sacar
    public function sacar($quantia)
    {
        $saldoDisponivel = $this->getSaldo() + $this->limite;

        if ($quantia > 0 && $quantia <= $saldoDisponivel) {
            if ($quantia > $this->getSaldo()) {
                $valorUsadoDoLimite = $quantia - $this->getSaldo();
                $this->setLimite($this->limite - $valorUsadoDoLimite);
                $this->setSaldo(0);
            } else {
                $this->setSaldo($this->getSaldo() - $quantia);
            }
            echo "Saque de R$ $quantia realizado com sucesso.<br>";
            return true;
        } else {
            echo "Saldo e limite insuficientes para o saque.<br>";
            return false;
        }
    }

    // Método para transferir dinheiro para outra conta corrente
    public function transferir($valor, ContaCorrente $contaDestino)
    {
        if ($valor > 0 && $valor <= ($this->getSaldo() + $this->limite)) {
            $this->sacar($valor);
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
// Inclui a classe ContaCorrente
include_once 'ContaCorrente.php';
 
// Cria uma instância de ContaCorrente
$contaCorrente = new ContaCorrente();
 
// Verifica se o usuário enviou um valor de depósito
if (isset($_POST['depositar'])) {
    $quantia = floatval($_POST['quantia']);
    $contaCorrente->depositar($quantia);
}
 
// Verifica se o usuário enviou um valor de saque
if (isset($_POST['sacar'])) {
    $quantia = floatval($_POST['quantia']);
    $contaCorrente->sacar($quantia);
}
?>
 
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conta Corrente</title>
    <link rel="stylesheet" href="css/estiloCC.css">
</head>
<body>
 
<header>
    <h1>Detalhes da Conta Corrente</h1>
</header>
 
<nav>
    <a href="index.php">Início</a>
    <a href="conta_poupanca.php">Poupança</a>
</nav>
 
<div class="container">
    <?php
    // Exibe o saldo atual
    echo "O saldo atual da conta é: R$" . number_format($contaCorrente->getSaldo(), 2, ',', '.') . "<br>";
    // Exibe o limite atual
    echo "O limite atual da conta é: R$" . number_format($contaCorrente->getLimite(), 2, ',', '.') . "<br>";
    ?>
 
    <!-- Formulário para depósito -->
    <form method="post">
        <label for="quantia">Depósito:</label>
        <input type="number" step="0.01" name="quantia" id="quantia" required>
        <input type="submit" name="depositar" value="Depositar">
    </form>
 
    <!-- Formulário para saque -->
    <form method="post">
        <label for="quantia">Saque:</label>
        <input type="number" step="0.01" name="quantia" id="quantia" required>
        <input type="submit" name="sacar" value="Sacar">
    </form>
   
</div>
 
</body>
</html>