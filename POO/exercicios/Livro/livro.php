<!-- 
 Classe livro

Entidade: Livro
Atributos:
Titulo
Autor
ISBN (Número de identificação do livro)
Genero (Ex: Ficção Científica, Romance, Técnico, Biografia)
Ação: Desenvolver a classe e criar um "catálogo" de livros (uma lista ou array de objetos Livro). Depois, exibir na tela o Título e o Autor de cada livro. -->

<?php

class livro{
    public $titulo;
    public $autor;
    public $isbn;
    public $genero;

    public function __construct($titulo, $autor, $isbn, $genero) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->isbn = $isbn;
        $this->genero = $genero;
    }

    public function mostrarInformacoes() {
        echo "<h2>Informações do Livro:</h2>";
        echo "Título: " . $this->titulo . "<br>";
        echo "Autor: " . $this->autor . "<br>";
        echo "ISBN: " . $this->isbn . "<br>";
        echo "Gênero: " . $this->genero . "<br>";
    }
}