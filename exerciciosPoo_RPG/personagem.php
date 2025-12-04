<?php

// site de rpg com o sistema dnd 5e atributos, niveis, experiencia, raça, classe, equipamento, pericias, magias, taletos, antecedentes.


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

    public $pontosVida;
    public $pontosMana;

 

    public function __construct($nome, $raca, $classe){
        $this->nome = $nome;
        $this->raca = $raca;
        $this->classe = $classe;
        $this->nivel = 1;
        $this->experiencia = 0;
    }

    public function __destruct(){
        // código para liberar recursos, se necessário
    }


    

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


    function ganharExperiencia($xp) {
        // Tabela de XP total exigido para cada nível
        $xpNivel = [
            1 => 0,
            2 => 300,
            3 => 900,
            4 => 2700,
            5 => 6500,
            6 => 14000,
            7 => 23000,
            8 => 34000,
            9 => 48000,
            10 => 64000,
            11 => 85000,
            12 => 100000,
            13 => 120000,
            14 => 140000,
            15 => 165000,
            16 => 195000,
            17 => 225000,
            18 => 265000,
            19 => 305000,
            20 => 355000
        ];
    
        // Adiciona XP
        $this->experiencia += $xp;
    
        // Verifica se subiu de nível
        while ($this->nivel < 20 && $this->experiencia >= $xpNivel[$this->nivel + 1]) {
            $this->nivel++;
            echo "Parabéns! {$this->nome} subiu para o nível {$this->nivel}!<br>";
        }

    }


}
    // switch ($classe) {
    //     case 'barbaro':
            
            
    //         break;
        
    //     default:
    //         # code...
    //         break;
    // }

