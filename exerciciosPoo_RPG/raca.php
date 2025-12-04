<?php


// site de rpg com o sistema dnd 5e atributos, niveis, experiencia, raça, classe, equipamento, pericias, magias, taletos, antecedentes.


class raca extends personagem{

    public $nomeRaca;
    public $descricaoRaca;
    public $habilidadesRaca;
    public $idiomasRaca;

    public function __construct($nomeRaca, $descricaoRaca){
        $this->nomeRaca = $nomeRaca;
        $this->descricaoRaca = $descricaoRaca;
        $this->habilidadesRaca = [];
        $this->idiomasRaca = [];
    }

    function exibirRaca(){
        return
        "Raça: $this->nomeRaca <br>
        Descrição: $this->descricaoRaca 
        habilidades: ".implode(", ", $this->habilidadesRaca)."<br>
        idiomas: ".implode(", ", $this->idiomasRaca)."<hr>";

    }
    function alteraRaca($nomeRaca, $descricaoRaca){
        $this->nomeRaca = $nomeRaca;
        $this->descricaoRaca = $descricaoRaca;
    }



    
}