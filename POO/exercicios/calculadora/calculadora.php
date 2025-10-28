<?php
// crie uma calculadora simples em PHP que receba dois valores e uma operação (soma, subtração, multiplicação, divisão) com orientação a objetos e retorne o resultado da operação.

class Calculadora {
    public $valor1;
    public $valor2;

    public function __construct($valor1, $valor2) {
        $this->valor1 = $valor1;
        $this->valor2 = $valor2;
    }

    public function adicao() {
        return $this->valor1 + $this->valor2;
    }

    public function subtracao() {
        return $this->valor1 - $this->valor2;
    }
    public function multiplicacao() {
        return $this->valor1 * $this->valor2;
    }
    public function divisao() {
        if ($this->valor2 == 0) {
            return "Erro: Divisão por zero não é permitida.";
        }
        return $this->valor1 / $this->valor2;
    }

}

?>





