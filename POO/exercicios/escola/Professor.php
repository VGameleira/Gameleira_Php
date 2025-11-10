<?php

require_once 'Pessoa.php';



/**

* Classe Professor que herda de Pessoa

* Atributos privados: disciplina, salario, codigo, senha

* Métodos específicos: getDisciplina, getSalario, darAula

*/

class Professor extends Pessoa {

 private $disciplina;

 private $salario;

 private $codigo;

 private $senha;



 // Construtor da classe Professor

 public function __construct($nome, $idade, $disciplina, $salario, $codigo, $senha = "123456") {

 parent::__construct($nome, $idade);

 $this->disciplina = $disciplina;

 $this->salario = $salario;

 $this->codigo = $codigo;

 $this->senha = $senha;

 }



 // Métodos getters e setters

 public function getDisciplina() {

 return $this->disciplina;

 }



 public function setDisciplina($disciplina) {

 $this->disciplina = $disciplina;

 }



 public function getSalario() {

 return $this->salario;

 }



 public function setSalario($salario) {

 $this->salario = $salario;

 }



 public function getCodigo() {

 return $this->codigo;

 }



 public function getSenha() {

 return $this->senha;

 }



 // Método para apresentar o professor

 public function apresentar() {

 return "Olá, meu nome é " . $this->getNome() . ", tenho " . $this->getIdade() . " anos e sou professor de " . $this->disciplina . ".";

 }



 // Método para dar aula

 public function darAula() {

 return "O professor " . $this->getNome() . " está dando aula de " . $this->disciplina . ".";

 }



 // Implementação do método abstrato getDescricao

 public function getDescricao() {

 return "Professor de " . $this->disciplina . " com salário R$ " . number_format($this->salario, 2, ',', '.');

 }



 // Implementação do método abstrato getTipo

 public function getTipo() {

 return "Professor";

 }



 // Método específico para visualizar turmas

 public function visualizarTurmas() {

 return [

 'professor' => $this->getNome(),

 'disciplina' => $this->disciplina,

 'codigo' => $this->codigo,

 'salario' => 'R$ ' . number_format($this->salario, 2, ',', '.')

 ];

 }

}

?>