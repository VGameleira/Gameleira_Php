<!--


Classe Funcionário
 
Entidade: Funcionario
Atributos:
Nome
Departamento (Ex: Vendas, RH, TI, Financeiro)
Cargo (Ex: Analista, Gerente, Estagiário, Coordenador)
Salario (Use um tipo numérico para valores monetários)
Ação: Desenvolver a classe e instanciar alguns objetos, depois mostre as informações do funcionário na tela.
-->

<?php
class funcionario {
    public $nome;
    public $departamento;
    public $cargo;
    public $salario;

    public function __construct($nome, $departamento, $cargo, $salario) {
        $this->nome = $nome;
        $this->departamento = $departamento;
        $this->cargo = $cargo;
        $this->salario = $salario;
    }

    public function mostrarInformacoes() {
        echo "<h2>Informações do Funcionário:</h2>";
        echo "Nome: " . $this->nome . "<br>";
        echo "Departamento: " . $this->departamento . "<br>";
        echo "Cargo: " . $this->cargo . "<br>";
        echo "Salário: R$ " . number_format($this->salario, 2, ',', '.') . "<br>";
    }


}


