<?php

class personagem{

    public $nome;
    public $raca;
    public $classe;

    public $alinhamento;

    public $nivel;

    public $habilidades;
    public $experiencia;
    public $forca;
    public $destreza;
    public $constituicao;
    public $inteligencia;
    public $sabedoria;
    public $carisma;

    function exibirAtributos(){
        return
        "Nome: $this->nome <br>
        Força: $this->forca <br>
        Destreza: $this->destreza <br>
        Constituição: $this->constituicao <br>
        Inteligência: $this->inteligencia <br>
        Sabedoria: $this->sabedoria <br>
        Carisma: $this->carisma <hr>";

    }

    function alteraAtributos($nome, $forca, $destreza,$constituicao, $inteligencia,$sabedoria,$carisma){
        $this->nome = $nome;
        $this->forca = $forca;
        $this->destreza = $destreza;
        $this->constituicao = $constituicao;
        $this->inteligencia = $inteligencia;
        $this->sabedoria = $sabedoria;
        $this->carisma = $carisma;
    }


    switch ($classe) {
        case 'barbaro':
            
            
            break;
        
        default:
            # code...
            break;
    }


    // function ganharExperiencia($xp){
    //     $this->experiencia += $xp;
    //     if($this->experiencia >= 1000){
    //         $this->nivel += 1;
    //         $this->experiencia -= 1000;
    //         echo "Parabéns! $this->nome subiu para o nível $this->nivel!<br>";
    //     }
    // }

}