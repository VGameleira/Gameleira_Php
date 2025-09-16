
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
    case 'criar_arrays':
        // (mantido se necessário)
        $indexados = array_map('trim', explode(',', $_POST['itens_indexados'] ?? ''));
        $assoc_raw = explode(',', $_POST['itens_associativos'] ?? '');
        $associativos = [];
        foreach ($assoc_raw as $item) {
            [$chave, $valor] = array_pad(explode(':', $item, 2), 2, null);
            if (trim($chave) !== '') $associativos[trim($chave)] = trim($valor);
        }
        $linhas = intval($_POST['linhas_multidimensionais'] ?? 1);
        $multi = [];
        for ($i = 0; $i < $linhas; $i++) $multi[] = ["linha"=>$i+1, "valor"=>"Exemplo ".($i+1)];

        echo "<strong>Indexado:</strong>\n"; output_pre($indexados);
        echo "<strong>Associativo:</strong>\n"; output_pre($associativos);
        echo "<strong>Multidimensional:</strong>\n"; output_pre($multi);
        break;

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
                array_splice($array, 1, 0, $itens);
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
                    // reindex
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
                $res = array_unique($array);
                output_pre($res);
                break;
            case 'array_values':
                output_pre(array_values($array));
                break;
            case 'array_search':
                $pos = array_search("Banana", $array);
                output_pre($pos !== false ? $pos : 'Não encontrado');
                break;
            case 'array_keys':
                output_pre(array_keys($array));
                break;
            case 'array_map':
                $res = array_map('strtoupper', $array);
                output_pre($res);
                break;
            case 'array_filter':
                $res = array_filter($array, function($v){ return mb_strlen($v) > 4; });
                output_pre(array_values($res));
                break;
            case 'array_reduce':
                $res = array_reduce($array, function($c,$i){ return $c.$i.'-'; }, '');
                output_pre($res);
                break;
            case 'count':
                output_pre(count($array));
                break;
            case 'in_array':
                output_pre(in_array('Uva', $array) ? 'Sim' : 'Não');
                break;
            case 'implode':
                output_pre(implode(' | ', $array));
                break;
            case 'explode':
                $string = 'Maçã|Banana|Laranja|Uva';
                output_pre(explode('|', $string));
                break;
            default:
                output_pre("Função não reconhecida.");
        }
        break;

    case 'create_assoc':
        // Recebe assoc_keys[] e assoc_values[] e monta o array associativo
        $keys = $_POST['assoc_keys'] ?? [];
        $values = $_POST['assoc_values'] ?? [];
        $assoc = [];
        for ($i=0;$i<count($keys);$i++) {
            $k = trim($keys[$i] ?? '');
            if ($k === '') continue;
            $assoc[$k] = $values[$i] ?? null;
        }
        // mostra o código PHP gerado e o resultado (print_r)
        $code = "<?php\n\$arr = [\n";
        foreach ($assoc as $k=>$v) {
            $code .= "    ".var_export($k, true)." => ".var_export($v, true).",\n";
        }
        $code .= "];\nprint_r(\$arr);\n";
        echo "<strong>Código PHP gerado:</strong>\n<pre>".htmlspecialchars($code)."</pre>";
        echo "<strong>Resultado (print_r):</strong>\n";
        output_pre($assoc);
        break;

    case 'compare_methods':
        // compara dois métodos: recebe base, other, methodA, methodB
        $base = array_values(array_filter(array_map('trim', explode(',', $_POST['base'] ?? '')), 'strlen'));
        $other = array_values(array_filter(array_map('trim', explode(',', $_POST['other'] ?? '')), 'strlen'));
        $a = $_POST['methodA'] ?? 'array_merge';
        $b = $_POST['methodB'] ?? 'plus';

        $do = function($method, $base, $other) {
            $res = null;
            switch($method) {
                case 'array_merge':
                    $res = array_merge($base, $other);
                    break;
                case 'plus': // operador +
                    // Recria comportamento: + mantém chaves numéricas com reindex? Em php, o + preserva chaves do primeiro array (mantém valores do primeiro para chaves iguais)
                    // Para fins didáticos assumimos arrays indexados e aplicamos $base + $other
                    $res = $base + $other;
                    break;
                default:
                    $res = "Método não implementado.";
            }
            return $res;
        };

        $resA = $do($a, $base, $other);
        $resB = $do($b, $base, $other);

        echo "<table style='width:100%;'><tr><th>Método A ({$a})</th><th>Método B ({$b})</th></tr>";
        echo "<tr><td><pre>"; print_r($resA); echo "</pre></td>";
        echo "<td><pre>"; print_r($resB); echo "</pre></td></tr></table>";
        break;

    case 'try_code':
        // Executa o código fornecido pelo usuário (para testes locais).
        // ----- AVISO: Isto executa código arbitrário. Use apenas em ambiente local/teste. -----
        $user_code = $_POST['user_code'] ?? '';
        // remove tags PHP se houver
        $user_code = preg_replace('/^\s*<\?(php)?/i', '', $user_code);
        $user_code = preg_replace('/\?>\s*$/', '', $user_code);

        // captura saída e erros
        ob_start();
        set_error_handler(function($errno, $errstr, $errfile, $errline){
            throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
        });
        try {
            // executa
            eval($user_code);
        } catch (Throwable $e) {
            echo "Erro na execução: " . $e->getMessage();
        }
        $out = ob_get_clean();
        restore_error_handler();
        echo "<pre>" . htmlspecialchars($out) . "</pre>";
        break;

    default:
        echo "Ação desconhecida.";
        break;
}
?>
        <a href="index.html">Voltar</a>