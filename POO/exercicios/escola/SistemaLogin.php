<?php

require_once 'Estudante.php';

require_once 'Professor.php';



/**

* Classe SistemaLogin - Gerencia autenticação de usuários

* Métodos: autenticar, getUsuarioLogado, logout

*/

class SistemaLogin{

 private $usuarios;

 private $usuarioLogado;



 public function __construct() {

 // Cadastro de usuários do sistema

 $this->usuarios = [

 // Estudantes

 '2024001' => new Estudante("Maria Silva", 20, "Matemática", 9.5, "2024001", "maria123"),

 '2024002' => new Estudante("Carlos Oliveira", 22, "História", 8.0, "2024002", "carlos123"),

 '2024003' => new Estudante("João Silva", 17, "Informática", 8.5, "2024003", "joao123"),

 '2024004' => new Estudante("Ana Souza", 16, "Administração", 5.8, "2024004", "ana123"),

  

 // Professores

 'PROF001' => new Professor("João Santos", 45, "Física", 3500.00, "PROF001", "joao123"),

 'PROF002' => new Professor("Carlos Pereira", 42, "Matemática", 4200.00, "PROF002", "carlos123"),

 'PROF003' => new Professor("Ana Lima", 35, "Português", 3900.00, "PROF003", "ana123"),

 'PROF004' => new Professor("Mariana Costa", 38, "Química", 4000.00, "PROF004", "mariana123")

 ];

 }



 // Método para autenticar usuário

 public function autenticar($codigo, $senha) {

if (isset($this->usuarios[$codigo]) {

 $usuario = $this->usuarios[$codigo];

 if ($usuario->getSenha() === $senha) {

 $this->usuarioLogado = $usuario;

 return true;

 }

 }

 return false;

 }



 // Método para obter usuário logado

 public function getUsuarioLogado() {

 return $this->usuarioLogado;

 }



 // Método para logout

 public function logout() {

 $this->usuarioLogado = null;

 }



 // Método para verificar se há usuário logado

 public function estaLogado() {

 return $this->usuarioLogado !== null;

 }

}

?>