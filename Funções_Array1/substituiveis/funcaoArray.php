<?php
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Resultado</title>
</head>
<body>
    <div class="container">
        <header>
            <h1>Resultado da Operação</h1>
            <p>Veja abaixo o que foi processado e entenda como funciona.</p>
        </header>
        <?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Acesse via formulário.";
    exit;
}

$acao = $_POST['acao'] ?? '';

function output_pre($v) {
    if (is_string($v)) {
        echo "<pre>" . htmlspecialchars($v) . "</pre>";
    } else {
        echo "<pre>";
        print_r($v);
        echo "</pre>";
    }
}

switch ($acao) {
    case 'inserir_itens':
        $array = array_filter(array_map('trim', explode(',', $_POST['array_base'] ?? '')), 'strlen');
        $itens = array_filter(array_map('trim', explode(',', $_POST['itens_adicionar'] ?? '')), 'strlen');
        $metodo = $_POST['metodo_insercao'] ?? 'colchetes';
        switch ($metodo) {
            case 'colchetes':
                foreach ($itens as $it) $array[] = $it;
                break;
            case 'push':
                array_push($array, ...$itens);
                break;
            case 'splice':
                $idx = isset($_POST['inserir_index']) ? intval($_POST['inserir_index']) : 1;
                array_splice($array, $idx, 0, $itens);
                break;
            case 'merge':
                $array = array_merge($array, $itens);
                break;
            case 'spread':
                $array = [...$array, ...$itens];
                break;
        }
        output_pre($array);
        break;

    case 'remover_itens':
        $array = array_values(array_filter(array_map('trim', explode(',', $_POST['array_remover'] ?? '')), 'strlen'));
        $metodo = $_POST['metodo_remocao'] ?? 'unset';
        $index = isset($_POST['remover_index']) ? intval($_POST['remover_index']) : 0;
        $length = isset($_POST['remover_length']) ? intval($_POST['remover_length']) : 1;
        if (count($array) === 0) {
            output_pre("Atenção: o array está vazio - nada a remover.");
            exit;
        }
        switch ($metodo) {
            case 'unset':
                if (array_key_exists($index, $array)) {
                    unset($array[$index]);
                    $array = array_values($array);
                } else {
                    output_pre("Índice {$index} não existe.");
                    exit;
                }
                break;
            case 'pop':
                array_pop($array);
                break;
            case 'shift':
                array_shift($array);
                break;
            case 'splice':
                array_splice($array, $index, $length);
                break;
            case 'diff':
                $toRemove = array_filter(array_map('trim', explode(',', $_POST['remover_diff_values'] ?? '')), 'strlen');
                $array = array_values(array_diff($array, $toRemove));
                break;
        }
        output_pre($array);
        break;

    case 'organizar_array':
        $array = array_values(array_filter(array_map('trim', explode(',', $_POST['array_organizar'] ?? '')), 'strlen'));
        $metodo = $_POST['metodo_organizacao'] ?? 'sort';
        switch ($metodo) {
            case 'sort': sort($array); break;
            case 'rsort': rsort($array); break;
            case 'asort': asort($array); break;
            case 'ksort': ksort($array); break;
            case 'shuffle': shuffle($array); break;
            case 'array_reverse': $array = array_reverse($array); break;
        }
        output_pre($array);
        break;

    case 'testar_funcoes':
        $array = array_values(array_filter(array_map('trim', explode(',', $_POST['array_teste'] ?? '')), 'strlen'));
        $funcao = $_POST['funcao_array'] ?? '';
        switch ($funcao) {
            case 'array_unique':
                output_pre(array_unique($array));
                break;
            case 'array_values':
                output_pre(array_values($array));
                break;
            case 'array_search':
                $val = $_POST['valor_busca'] ?? 'Banana';
                $pos = array_search($val, $array);
                output_pre($pos !== false ? $pos : 'Não encontrado');
                break;
            case 'array_keys':
                output_pre(array_keys($array));
                break;
            case 'array_map':
                output_pre(array_map('strtoupper', $array));
                break;
            case 'array_filter':
                output_pre(array_values(array_filter($array, function($v){ return mb_strlen($v) > 4; })));
                break;
            case 'array_reduce':
                output_pre(array_reduce($array, function($c,$i){ return $c.$i.'-'; }, ''));
                break;
            case 'count':
                output_pre(count($array));
                break;
            case 'in_array':
                $val = $_POST['valor_busca'] ?? 'Uva';
                output_pre(in_array($val, $array) ? 'Sim' : 'Não');
                break;
            case 'implode':
                output_pre(implode(', ', $array));
                break;
            case 'explode':
                $string = 'Maçã,Banana,Laranja';
                output_pre(explode(',', $string));
                break;
            case 'strtolower':
                output_pre(strtolower(implode(', ', $array)));
                break;
            case 'strtoupper':
                output_pre(strtoupper(implode(', ', $array)));
                break;
            case 'ucwords':
                output_pre(ucwords(strtolower(implode(' ', $array))));
                break;
            case 'ucfirst':
                output_pre(ucfirst(strtolower(implode(' ', $array))));
                break;
            case 'preg_match':
                $regex = '/Banana/';
                $txt = implode(',', $array);
                output_pre(preg_match($regex, $txt) ? 'Encontrado' : 'Não encontrado');
                break;
            case 'asort':
                asort($array);
                output_pre($array);
                break;
            case 'arsort':
                arsort($array);
                output_pre($array);
                break;
            case 'isset':
                output_pre(isset($array[0]) ? 'Sim' : 'Não');
                break;
            case 'array_sum':
                output_pre(array_sum([1,2,3,4]));
                break;
            case 'array_merge_recursive':
                output_pre(array_merge_recursive($array, ["Banana","Kiwi"]));
                break;
            case 'array_intersect':
                output_pre(array_intersect($array, ["Banana","Kiwi"]));
                break;
            case 'array_diff_assoc':
                output_pre(array_diff_assoc($array, ["Banana","Kiwi"]));
                break;
            case 'array_chunk':
                output_pre(array_chunk($array,2));
                break;
            case 'array_pad':
                output_pre(array_pad($array,8,"Morango"));
                break;
            case 'array_fill':
                output_pre(array_fill(0,5,"Morango"));
                break;
            case 'array_walk':
                array_walk($array,function(&$v){$v=strtoupper($v);});
                output_pre($array);
                break;
            case 'array_flip':
                output_pre(array_flip($array));
                break;
            case 'array_change_key_case':
                output_pre(array_change_key_case(["A"=>1,"B"=>2],CASE_LOWER));
                break;
            case 'array_rand':
                output_pre(array_rand($array));
                break;
            case 'array_multisort':
                array_multisort($array);
                output_pre($array);
                break;
            case 'array_replace':
                output_pre(array_replace($array,["Banana"=>"Kiwi"]));
                break;
            case 'array_replace_recursive':
                output_pre(array_replace_recursive($array,["Banana"=>"Kiwi"]));
                break;
            case 'array_product':
                output_pre(array_product([1,2,3,4]));
                break;
            case 'array_count_values':
                output_pre(array_count_values($array));
                break;
            case 'array_key_exists':
                output_pre(array_key_exists("Banana",$array) ? 'Sim' : 'Não');
                break;
            case 'array_combine':
                output_pre(array_combine(["A","B"],[1,2]));
                break;
            default:
                output_pre("Função não reconhecida.");
        }
        break;

    default:
        echo "Ação desconhecida.";
        break;
}
?>
        <a href="index.html">Voltar</a>