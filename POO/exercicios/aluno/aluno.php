<!-- Desenvolva uma classe Aluno que contenha o Nome, Cidade, Bairro e Curso(Informática para Internet, Desenvolvimento para sistema, Front end e Back end). Depois mostrar essas informações na tela -->



<?php

    class Aluno {
        public $nome;
        public $cidade;
        public $bairro;
        public $curso;

        public function __construct($nome, $cidade, $bairro, $curso) {
            $this->nome = $nome;
            $this->cidade = $cidade;
            $this->bairro = $bairro;
            $this->curso = $curso;
        }

        public function mostrarInformacoes() {
            echo "<h2>Informações do Aluno:</h2>";
            echo "Nome: " . htmlspecialchars($this->nome) . "<br>";
            echo "Cidade: " . htmlspecialchars($this->cidade) . "<br>";
            echo "Bairro: " . htmlspecialchars($this->bairro) . "<br>";
            echo "Curso: " . htmlspecialchars( $this->curso) . "<br>";
        }
    }
    ?>