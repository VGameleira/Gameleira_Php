<!-- Crie uma classe Cliente com atributos nome e cpf. -->

<?php
// Definição da classe Cliente
class Cliente {
    // Atributos da classe Cliente
    private $nome;
    private $cpf;

    // Construtor da classe Cliente
    public function __construct($nome, $cpf) {
        $this->nome = $nome;
        $this->cpf = $cpf;
    }

    // Métodos getters para os atributos
    public function getNome() {
        return $this->nome;
    }

    // Método getter para cpf
    public function getCpf() {
        return $this->cpf;
    }
}
