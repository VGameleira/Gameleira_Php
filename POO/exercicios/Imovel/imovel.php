<!-- 
Classe Imovel
 
Entidade: Imovel
Atributos:
Tipo (Ex: Apartamento, Casa, Terreno)
Endereco
AreaMetrosQuadrados (Use um tipo numérico)
NumeroQuartos (Use um tipo numérico inteiro)
Ação: Desenvolver a classe. Crie um objeto Imovel e exiba na tela o tipo de imóvel, seu endereço e o número de quartos. -->

<?php

class Imovel
{
    public $tipo;
    public $endereco;
    public $areaM2;
    public $qtdQuartos;

    public function __construct($tipo, $endereco, $areaM2, $qtdQuartos)
    {
        $this->tipo = $tipo;
        $this->endereco = $endereco;
        $this->areaM2 = $areaM2;
        $this->qtdQuartos = $qtdQuartos;
    }

    public function mostrarInformacoes()
    {
        echo "<h2>Informações do Imóvel:</h2>";
        echo "Tipo: " . $this->tipo . "<br>";
        echo "Endereço: " . $this->endereco . "<br>";
        echo "Área (m²): " . $this->areaM2 . "<br>";
        echo "Quantidade de Quartos: " . $this->qtdQuartos . "<br>";
    }
}
?>