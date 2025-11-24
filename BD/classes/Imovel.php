<?php
class Imovel {
    public $tipo;
    public $finalidade;
    public $localizacao;
    public $preco;
    public $area_cons;
    public $area_terreno;
    public $qtd_quarto;
    public $qtd_banheiro;
    public $qtd_vaga;
    public $descricao;

    public function __construct(array $data) {
        $this->tipo = $data['tipo'] ?? '';
        $this->finalidade = $data['finalidade'] ?? '';
        $this->localizacao = $data['localizacao'] ?? '';
        $this->preco = $data['preco'] ?? 0;
        $this->area_cons = $data['area_cons'] ?? '';
        $this->area_terreno = $data['area_terreno'] ?? '';
        $this->qtd_quarto = $data['qtd_quarto'] ?? 0;
        $this->qtd_banheiro = $data['qtd_banheiro'] ?? 0;
        $this->qtd_vaga = $data['qtd_vaga'] ?? 0;
        $this->descricao = $data['descricao'] ?? '';
    }

    public function toArray(): array {
        return [
            'tipo' => $this->tipo,
            'finalidade' => $this->finalidade,
            'localizacao' => $this->localizacao,
            'preco' => $this->preco,
            'area_cons' => $this->area_cons,
            'area_terreno' => $this->area_terreno,
            'qtd_quarto' => $this->qtd_quarto,
            'qtd_banheiro' => $this->qtd_banheiro,
            'qtd_vaga' => $this->qtd_vaga,
            'descricao' => $this->descricao
        ];
    }
}
