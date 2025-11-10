<?php
// Inicia a sessão para manter os dados do usuário entre as páginas
// A sessão permite armazenar informações (como saldo) que persistem durante a navegação
session_start();

/**
 * Classe ContaBancaria
 * 
 * Esta é a classe base (pai) que representa uma conta bancária genérica
 * Ela será herdada pelas classes ContaCorrente e ContaPoupanca
 * Possui as funcionalidades básicas de qualquer conta: consultar saldo, depositar e sacar
 */
class ContaBancaria {
    
    // Propriedade privada que armazena o saldo da conta
    // Private significa que só pode ser acessada dentro desta classe
    private $saldo;

    /**
     * Construtor da classe
     * 
     * Este método é executado automaticamente quando criamos um novo objeto ContaBancaria
     * Ele inicializa o saldo da conta, recuperando o valor da sessão se existir,
     * ou iniciando com 0 se for a primeira vez
     */
    public function __construct() {
        // Operador ternário: se existe saldo na sessão, usa ele, senão usa 0
        $this->saldo = isset($_SESSION['saldo']) ? $_SESSION['saldo'] : 0;
    }

    /**
     * Método para definir/alterar o saldo
     * 
     * @param float $valor - O novo valor do saldo
     * 
     * Este método permite alterar o saldo diretamente
     * Também atualiza o valor na sessão para manter a persistência
     */
    public function setSaldo($valor) {
        // Define o saldo do objeto
        $this->saldo = $valor;
        // Salva o saldo na sessão para não perder quando mudar de página
        $_SESSION['saldo'] = $this->saldo;
    }

    /**
     * Método para consultar o saldo atual
     * 
     * @return float - Retorna o valor do saldo atual da conta
     * 
     * Este método permite que outras partes do código consultem o saldo
     * sem poder modificá-lo diretamente (encapsulamento)
     */
    public function getSaldo() {
        return $this->saldo;
    }

    /**
     * Método para realizar depósitos na conta
     * 
     * @param float $valor - O valor a ser depositado
     * @return bool - Retorna true se o depósito foi bem-sucedido, false caso contrário
     * 
     * Este método adiciona dinheiro à conta
     * Valida se o valor é positivo antes de realizar o depósito
     */
    public function depositar($valor) {
        // Verifica se o valor é maior que zero (não aceita valores negativos ou zero)
        if ($valor > 0) {
            // Adiciona o valor ao saldo atual usando o operador +=
            $this->saldo += $valor;
            // Atualiza o saldo na sessão
            $_SESSION['saldo'] = $this->saldo;
            // Retorna true indicando que o depósito foi bem-sucedido
            return true;
        } else {
            // Retorna false indicando que o depósito falhou (valor inválido)
            return false;
        }
    }

    /**
     * Método para realizar saques da conta
     * 
     * @param float $valor - O valor a ser sacado
     * @return bool - Retorna true se o saque foi bem-sucedido, false caso contrário
     * 
     * Este método remove dinheiro da conta
     * Valida se o valor é positivo E se há saldo suficiente
     */
    public function sacar($valor) {
        // Verifica duas condições:
        // 1. O valor deve ser maior que zero
        // 2. O valor não pode ser maior que o saldo disponível
        if ($valor > 0 && $valor <= $this->saldo) {
            // Subtrai o valor do saldo atual usando o operador -=
            $this->saldo -= $valor;
            // Atualiza o saldo na sessão
            $_SESSION['saldo'] = $this->saldo;
            // Retorna true indicando que o saque foi bem-sucedido
            return true;
        } else {
            // Retorna false indicando que o saque falhou
            // Motivos possíveis: valor inválido ou saldo insuficiente
            return false;
        }
    }
}
?>