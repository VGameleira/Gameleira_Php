<?php

/**

* Classe abstrata Pessoa - Classe base para Aluno e Professor

* Atributos protegidos: nome, idade

* Métodos: getters, construtor e método abstrato getDescricao()

*/

abstract class Pessoa {

protected $nome;

protected $idade;



// Construtor da classe Pessoa

 public function __construct($nome, $idade) {

$this->nome = $nome;

 $this->idade = $idade;

 }



// Método getter para nome

public function getNome() {

 return $this->nome;

 }



// Método getter para idade

 public function getIdade() {

 return $this->idade;

 }



// Método abstrato que deve ser implementado pelas classes filhas

 abstract public function getDescricao();

  

// Método abstrato para retornar o tipo de usuário

 abstract public function getTipo();

}

?>