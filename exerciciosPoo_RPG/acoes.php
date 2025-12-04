<?php
require_once 'personagem.php';
require_once 'raca.php';
require_once 'classe.php';


class AcoesCombate extends personagem{
    
    public function atacar(){
        // código para ações de combate
        echo "{$this->nome} ataca o inimigo!(ação comum) <br>";

    }

    public function ajudar(){
        // código para ações de suporte
        echo "{$this->nome} ajuda um aliado!(ação bônus) <br>";

    }

    public function disparada(){
        // código para ações de movimento
        echo "{$this->nome} se move rapidamente!(movimento) <br>";

    }

    public function esconder(){
        // código para ações de furtividade
        echo "{$this->nome} se esconde nas sombras!(ação especial) <br>";

    }

    public function esquivar(){
        // código para ações defensivas
        echo "{$this->nome} esquiva de um ataque!(ação defensiva) <br>";

    }

    public function preparar(){
        // código para ações de preparação
        echo "{$this->nome} se prepara para o próximo movimento!(ação preparatória) <br>";

    }

    public function procurar(){
        // código para ações de busca
        echo "{$this->nome} procura por pistas ou inimigos!(ação de busca) <br>";

    }



}