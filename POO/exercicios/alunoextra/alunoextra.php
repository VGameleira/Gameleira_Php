<!-- Classe Aluno
Entidade: Aluno
Atributos:

Nome
Matrícula
Curso
Média Final (numérico)
Ação:
Crie a classe Aluno com os atributos acima.
Crie um método media, para verificar se o aluno está aprovado (média ≥ 7) ou reprovado (média < 7).
Crie um método mostrarInformacao, para mostrar o nome, matricula, curso e se está aprovado ou reprovado.

OBS: No formulário o usuário irá digitar a media do aluno direto.

 -->

 <?php

 class AlunoExtra {
     public $nome;
     public $matricula;
     public $curso;
     public $mediaFinal;

     public function __construct($nome, $matricula, $curso, $mediaFinal) {
         $this->nome = $nome;
         $this->matricula = $matricula;
         $this->curso = $curso;
         $this->mediaFinal = $mediaFinal;
     }

     public function verificarAprovacao() {
         return $this->mediaFinal >= 7 ? "Aprovado" : "Reprovado";
     }

     public function mostrarInformacoes() {
         echo "<h2>Informações do Aluno:</h2>";
         echo "Nome: " . htmlspecialchars($this->nome) . "<br>";
         echo "Matrícula: " . htmlspecialchars($this->matricula) . "<br>";
         echo "Curso: " . htmlspecialchars($this->curso) . "<br>";
         echo "Situação: " . $this->verificarAprovacao() . "<br>";
     }
 }

 