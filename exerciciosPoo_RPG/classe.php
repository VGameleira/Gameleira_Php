<?php
// site de rpg com o sistema dnd 5e atributos, niveis, experiencia, raça, classe, equipamento, pericias, magias, taletos, antecedentes.


class Classe extends personagem{

    public $nomeClasse;
    public $descricaoClasse;
    public $habilidadesClasse;
    public $equipamentosClasse;

    public function __construct($nomeClasse, $descricaoClasse){
        $this->nomeClasse = $nomeClasse;
        $this->descricaoClasse = $descricaoClasse;
        $this->habilidadesClasse = [];
        $this->equipamentosClasse = [];
    }

    function exibirClasse(){
        return
        "Classe: $this->nomeClasse <br>
        Descrição: $this->descricaoClasse 
        habilidades: ".implode(", ", $this->habilidadesClasse)."<br>
        equipamentos: ".implode(", ", $this->equipamentosClasse)."<hr>";

    }
    function alteraClasse($nomeClasse, $descricaoClasse){
        $this->nomeClasse = $nomeClasse;
        $this->descricaoClasse = $descricaoClasse;
        $this->habilidadesClasse = [];
        
    }

    class Artificie extends classe{
        // public function criarObjetoMagico(){
        //     echo "{$this->nomeClasse} cria um objeto mágico!(ação especial) <br>";

        // public function infundirMagia(){
        //     echo "{$this->nomeClasse} infunde magia em um objeto!(ação bônus) <br>";
    
        // }

        public $forca = 8;
        public $destreza = 13;
        public $constituicao = 14;
        public $sabedoria = 12;
        public $inteligencia = 15;
        public $carisma = 10;

        public $descricaoClasse = "O Artífice é um mestre da invenção e da magia aplicada. Eles combinam habilidades técnicas com poderes mágicos para criar dispositivos incríveis, armas encantadas e outras maravilhas tecnológicas que auxiliam em suas aventuras.";
        

    }

    class Barbaro extends classe{
        // public function fúria(){
        //     echo "{$this->nomeClasse} entra em fúria!(ação especial) <br>";

        // public function ataqueImprudente(){
        //     echo "{$this->nomeClasse} faz um ataque imprudente!(ação bônus) <br>";
    
        // }

        public $forca = 15;
        public $destreza = 13;
        public $constituicao = 14;
        public $sabedoria = 12;
        public $inteligencia = 8;
        public $carisma = 10;
        
        public $descricaoClasse = "Bárbaro é um guerreiro feroz que canaliza sua raiva em combate. Eles são conhecidos por sua força bruta e resistência, capazes de suportar grandes danos enquanto desferem ataques devastadores contra seus inimigos.";

    }

    class Bardo extends classe{
        // public function inspirarCoragem(){
        //     echo "{$this->nomeClasse} inspira coragem aos aliados!(ação bônus) <br>";

        // public function magiaMusical(){
        //     echo "{$this->nomeClasse} lança uma magia através da música!(ação especial) <br>";
    
        // }

        public $forca = 10;
        public $destreza = 14;
        public $constituicao = 12;
        public $sabedoria = 13;
        public $inteligencia = 12;
        public $carisma = 15;

        public $descricaoClasse = "O Bardo é um mestre das artes performáticas e da magia. Eles usam sua música, poesia e habilidades de atuação para inspirar aliados, confundir inimigos e lançar feitiços poderosos.";

    }

    class BloodHunter extends classe{
        // public function marcaSangrenta(){
        //     echo "{$this->nomeClasse} marca um inimigo com uma marca sangrenta!(ação especial) <br>";

        // public function caçarMonstros(){
        //     echo "{$this->nomeClasse} caça monstros com habilidades especiais!(ação bônus) <br>";
    
        // }

        public $forca = 14;
        public $destreza = 15;
        public $constituicao = 13;
        public $sabedoria = 12;
        public $inteligencia = 10;
        public $carisma = 8;

        public $descricaoClasse = "O Caçador de Sangue é um guerreiro especializado em caçar criaturas sobrenaturais. Eles utilizam rituais sombrios e habilidades de combate para enfrentar monstros e proteger os inocentes.";


    }

    class Bruxo extends classe{
        // public function pacto(){
        //     echo "{$this->nomeClasse} faz um pacto com uma entidade poderosa!(ação especial) <br>";

        // public function invocarFamiliar(){
        //     echo "{$this->nomeClasse} invoca um familiar mágico!(ação bônus) <br>";
    
        // }

        public $forca = 8;
        public $destreza = 14;
        public $constituicao = 12;
        public $sabedoria = 13;
        public $inteligencia = 15;
        public $carisma = 10;

        public $descricaoClasse = "O Bruxo é um conjurador que obtém seus poderes através de pactos com entidades sobrenaturais. Eles possuem habilidades mágicas únicas e podem invocar criaturas para auxiliá-los em batalha.";

    }

    class Clérigo extends classe{
        // public function canalizarDivindade(){
        //     echo "{$this->nomeClasse} canaliza o poder de sua divindade!(ação especial) <br>";

        // public function cura(){
        //     echo "{$this->nomeClasse} cura ferimentos de aliados!(ação bônus) <br>";
    
        // }

        public $forca = 13;
        public $destreza = 10;
        public $constituicao = 14;
        public $sabedoria = 15;
        public $inteligencia = 12;
        public $carisma = 8;

        public $descricaoClasse = "O Clérigo é um servo devoto de uma divindade, canalizando seu poder para curar ferimentos, proteger aliados e combater o mal. Eles são versáteis, capazes de lutar tanto com armas quanto com magia divina.";

    }





}



