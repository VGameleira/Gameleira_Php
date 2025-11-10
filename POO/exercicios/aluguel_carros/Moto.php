<!-- Crie duas subclasses que herdem de Veiculo:

Carro → deve ter um atributo adicional portas;

Moto → deve ter um atributo adicional cilindradas;

Ambas devem implementar o método calcularCusto($dias), aplicando uma taxa diferente:

Carros: +10% de taxa sobre o total

Motos: +5% de taxa sobre o total -->


<?php
require_once 'Veiculo.php';

// Assinatura da classe Moto que herda de Veiculo
class Moto extends Veiculo {
    // Atributo específico da classe Moto
    private $cilindradas;

    // Construtor da classe Moto
    public function __construct($marca, $modelo, $precoDiaria, $cilindradas) {
        parent::__construct($marca, $modelo, $precoDiaria);
        $this->cilindradas = $cilindradas;
    }

    // Implementação do método calcularCusto com taxa de 5% para motos
    public function calcularCusto($dias) {
        $custoBase = $this->precoDiaria * $dias;
        $taxa = 0.05; // 5% de taxa para motos
        return $custoBase + ($custoBase * $taxa);
    }

    // Método para calcular o custo total do aluguel
    public function calcularCustoTotal($dias) {
        return $this->calcularCusto($dias);
    }
}
