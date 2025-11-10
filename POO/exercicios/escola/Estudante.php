<?php

require_once 'Pessoa.php';



/**

* Classe Estudante que herda de Pessoa

* Atributos privados: curso, nota, matricula, senha

* Métodos específicos: getCurso, getNota, verificarAprovacao

*/

class Estudante extends Pessoa {

 private $curso;

 private $nota;

 private $matricula;

 private $senha;



 // Construtor da classe Estudante

 public function __construct($nome, $idade, $curso, $nota, $matricula, $senha = "123456") {

 parent::__construct($nome, $idade);

 $this->curso = $curso;

 $this->nota = $nota;

 $this->matricula = $matricula;

 $this->senha = $senha;

 }



 // Método getter para matricula

 public function getMatricula() {

 return $this->matricula;

 }



 // Método getter para senha

 public function getSenha() {

 return $this->senha;

 }



 // Método getter para curso

 public function getCurso() {

 return $this->curso;

 }



 // Método getter para nota

 public function getNota() {

 return $this->nota;

 }



 // Método para verificar se o aluno está aprovado

 public function verificarAprovacao() {

 return $this->nota >= 6 ? "Aprovado" : "Reprovado";

 }



 // Implementação do método abstrato getDescricao

 public function getDescricao() {

 $status = $this->verificarAprovacao();

 return "Estudante do curso de " . $this->curso . " com nota " . $this->nota . " (" . $status . ")";

 }



 // Implementação do método abstrato getTipo

 public function getTipo() {

 return "Estudante";

 }



 // Método específico para visualizar boletim

 public function visualizarBoletim() {

 return [

 'matricula' => $this->matricula,

 'nome' => $this->getNome(),

 'curso' => $this->curso,

 'nota' => $this->nota,

 'situacao' => $this->verificarAprovacao()

 ];

 }

}

?>