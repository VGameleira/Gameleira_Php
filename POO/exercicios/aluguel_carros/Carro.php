<!-- Crie duas subclasses que herdem de Veiculo:

Carro → deve ter um atributo adicional portas;

Moto → deve ter um atributo adicional cilindradas;

Ambas devem implementar o método calcularCusto($dias), aplicando uma taxa diferente:

Carros: +10% de taxa sobre o total

Motos: +5% de taxa sobre o total -->

<?php
require_once 'Veiculo.php';
// Assinatura da classe Carro que herda de Veiculo
class Carro extends Veiculo {
    // Atributo específico da classe Carro
    private $portas;

    // Construtor da classe Carro
    public function __construct($marca, $modelo, $precoDiaria, $portas) {
        parent::__construct($marca, $modelo, $precoDiaria);
        $this->portas = $portas;
    }

    // Implementação do método calcularCusto com taxa de 10% para carros
    public function calcularCusto($dias) {
        $custoBase = $this->precoDiaria * $dias;
        $taxa = 0.10; // 10% de taxa para carros
        return $custoBase + ($custoBase * $taxa);
    }

    // Método para calcular o custo total do aluguel
    public function calcularCustoTotal($dias) {
        return $this->calcularCusto($dias);
    }
}