<!-- Crie uma classe abstrata Veiculo com os seguintes atributos e métodos:

Atributos:

marca

modelo

precoDiaria

disponivel (booleano)

Métodos:

__construct() para inicializar os dados;

getDescricao() para retornar marca e modelo juntos;

alugar() e devolver() para alterar o status do veículo;

Um método abstrato calcularCusto($dias) que deve ser implementado pelas subclasses. -->

<?php

// Definição da classe abstrata Veiculo
abstract class Veiculo {
    // Atributos da classe Veiculo
    protected $marca;
    protected $modelo;
    protected $precoDiaria;
    protected $disponivel;

    // Construtor da classe Veiculo
    public function __construct($marca, $modelo, $precoDiaria) {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->precoDiaria = $precoDiaria;
        $this->disponivel = true; // Inicialmente disponível
    }

    // Método para retornar a descrição do veículo
    public function getDescricao() {
        return $this->marca . ' ' . $this->modelo;
    }

    // Métodos para alugar e devolver o veículo
    public function alugar() {
        if ($this->disponivel) {
            $this->disponivel = false;
            return true;
        }
        return false;
    }

    // Método para devolver o veículo
    public function devolver() {
        $this->disponivel = true;
    }

    // Getters para os atributos
    public function getPrecoDiaria() {
        return $this->precoDiaria;
    }

    //  Método para verificar disponibilidade
    public function isDisponivel() {
        return $this->disponivel;
    }

    // Método abstrato para calcular o custo do aluguel
    abstract public function calcularCusto($dias);

    // Método para calcular o custo total do aluguel
    public function calcularCustoTotal($dias) {
        return $this->calcularCusto($dias);
    }
}
