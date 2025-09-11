
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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? null;

    switch ($acao) {
        /* ========================
           CRIAÇÃO DE ARRAYS
        ========================= */
        case 'criar_arrays':
            $indexados = array_map('trim', explode(',', $_POST['itens_indexados'] ?? ''));
            $assoc_raw = explode(',', $_POST['itens_associativos'] ?? '');
            $associativos = [];
            foreach ($assoc_raw as $item) {
                [$chave, $valor] = array_pad(explode(':', $item, 2), 2, null);
                $associativos[trim($chave)] = trim($valor);
            }
            $linhas = intval($_POST['linhas_multidimensionais'] ?? 1);
            $multi = [];
            for ($i = 0; $i < $linhas; $i++) {
                $multi[] = ["linha" => $i + 1, "valor" => "Exemplo " . ($i + 1)];
            }

            echo "<pre><strong>Array Indexado:</strong>\n";
            print_r($indexados);
            echo "\n<strong>Array Associativo:</strong>\n";
            print_r($associativos);
            echo "\n<strong>Array Multidimensional:</strong>\n";
            print_r($multi);
            echo "</pre>";
            break;

        /* ========================
           INSERÇÃO DE ITENS
        ========================= */
        case 'inserir_itens':
            $array = array_map('trim', explode(',', $_POST['array_base'] ?? ''));
            $itens = array_map('trim', explode(',', $_POST['itens_adicionar'] ?? ''));
            $metodo = $_POST['metodo_insercao'] ?? 'colchetes';

            switch ($metodo) {
                case 'colchetes':
                    foreach ($itens as $item) {
                        $array[] = $item;
                    }
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
                    $array = [...$array, ...$itens]; // PHP 7.4+
                    break;
            }
            echo "<pre>"; print_r($array); echo "</pre>";
            break;

        /* ========================
           REMOÇÃO DE ITENS
        ========================= */
        case 'remover_itens':
            $array = array_map('trim', explode(',', $_POST['array_remover'] ?? ''));
            $metodo = $_POST['metodo_remocao'] ?? 'unset';

            switch ($metodo) {
                case 'unset':
                    unset($array[1]); // remove índice 1 (exemplo)
                    break;
                case 'pop':
                    array_pop($array);
                    break;
                case 'shift':
                    array_shift($array);
                    break;
                case 'splice':
                    array_splice($array, 1, 2); // remove dois itens a partir do índice 1
                    break;
                case 'diff':
                    $array = array_diff($array, ["Banana"]); // remove todas as "Banana"
                    break;
            }
            echo "<pre>"; print_r($array); echo "</pre>";
            break;

        /* ========================
           ORGANIZAÇÃO DE ARRAYS
        ========================= */
        case 'organizar_array':
            $array = array_map('trim', explode(',', $_POST['array_organizar'] ?? ''));
            $metodo = $_POST['metodo_organizacao'] ?? 'sort';

            switch ($metodo) {
                case 'sort': sort($array); break;
                case 'rsort': rsort($array); break;
                case 'asort': asort($array); break;
                case 'ksort': ksort($array); break;
                case 'shuffle': shuffle($array); break;
                case 'array_reverse': $array = array_reverse($array); break;
            }
            echo "<pre>"; print_r($array); echo "</pre>";
            break;

        /* ========================
           FUNÇÕES DE ARRAY
        ========================= */
        case 'testar_funcoes':
            $array = array_map('trim', explode(',', $_POST['array_teste'] ?? ''));
            $funcao = $_POST['funcao_array'] ?? '';

            switch ($funcao) {
                case 'array_unique':
                    $array = array_unique($array);
                    break;
                case 'array_values':
                    $array = array_values($array);
                    break;
                case 'array_search':
                    $resultado = array_search("Banana", $array);
                    echo "<pre>Posição de 'Banana': " . ($resultado !== false ? $resultado : 'Não encontrado') . "</pre>";
                    exit;
                case 'array_keys':
                    echo "<pre>"; print_r(array_keys($array)); echo "</pre>";
                    exit;
                case 'array_map':
                    $array = array_map('strtoupper', $array);
                    break;
                case 'array_filter':
                    $array = array_filter($array, fn($v) => strlen($v) > 4);
                    break;
                case 'array_reduce':
                    $resultado = array_reduce($array, fn($carry, $item) => $carry . $item . "-", "");
                    echo "<pre>Resultado do reduce: $resultado</pre>";
                    exit;
                case 'count':
                    echo "<pre>Total de itens: " . count($array) . "</pre>";
                    exit;
                case 'in_array':
                    echo "<pre>Existe 'Uva'? " . (in_array("Uva", $array) ? "Sim" : "Não") . "</pre>";
                    exit;
                case 'implode':
                    echo "<pre>" . implode(" | ", $array) . "</pre>";
                    exit;
                case 'explode':
                    $string = "Maçã|Banana|Laranja|Uva";
                    echo "<pre>"; print_r(explode('|', $string)); echo "</pre>";
                    exit;
            }

            echo "<pre>"; print_r($array); echo "</pre>";
            break;
    }
}
?>
        <a href="index.html">Voltar</a>