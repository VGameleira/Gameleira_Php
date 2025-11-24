<?php
class Cliente {
    public $id;
    public $nome;
    public $endereco;
    public $cidade;
    public $bairro;
    public $produto;

    public function __construct(array $data) {
        $this->nome = $data['nome'] ?? '';
        $this->endereco = $data['endereco'] ?? '';
        $this->cidade = $data['cidade'] ?? '';
        $this->bairro = $data['bairro'] ?? '';
        $this->produto = $data['produto'] ?? '';
    }

    public function toArray(): array {
        return [
            'nome' => $this->nome,
            'endereco' => $this->endereco,
            'cidade' => $this->cidade,
            'bairro' => $this->bairro,
            'produto' => $this->produto
        ];
    }
}
