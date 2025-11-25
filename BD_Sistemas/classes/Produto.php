<?php
class Produto {
    public $nome;
    public $preco;
    public $quantidade;
    public $descricao;

    public function __construct(array $data) {
        $this->nome = $data['nome'] ?? '';
        $this->preco = $data['preco'] ?? 0;
        $this->quantidade = $data['quantidade'] ?? 0;
        $this->descricao = $data['descricao'] ?? '';
    }

    public function toArray(): array {
        return [
            'nome' => $this->nome,
            'preco' => $this->preco,
            'quantidade' => $this->quantidade,
            'descricao' => $this->descricao
        ];
    }
}
