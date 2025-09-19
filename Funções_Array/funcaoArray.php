
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
        // Verifica se o formulário foi enviado via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $acao = $_POST['acao'] ?? '';

            // Criação de arrays (indexado, associativo e multidimensional)
            if ($acao === 'criar_arrays') {
                // Cria array indexado a partir dos itens informados
                $indexados = array_map('trim', explode(',', $_POST['itens_indexados']));

                // Cria array associativo a partir dos itens informados no formato chave:valor
                $associativos = [];
                foreach (explode(',', $_POST['itens_associativos']) as $item) {
                    if (strpos($item, ':') !== false) {
                        [$chave, $valor] = explode(':', $item);
                        $associativos[trim($chave)] = trim($valor);
                    }
                }

                // Cria array multidimensional com o número de linhas informado
                $linhas = max(1, intval($_POST['linhas_multidimensionais']));
                $multi = [];
                for ($i = 0; $i < $linhas; $i++) {
                    $multi[] = ["linha" => $i + 1, "valor" => "Item $i"];
                }

                // Exibe os arrays criados
                echo "<div class='secao-resultado'>";
                echo "<h2>Criação de Arrays</h2>";
                echo "<p>Você criou três tipos de arrays: indexado, associativo e multidimensional. Cada um é exibido abaixo:</p>";
                echo "<pre class='exibicao-array'><strong>Array Indexado:</strong>\n";
                print_r($indexados);
                echo "\n<strong>Array Associativo:</strong>\n";
                print_r($associativos);
                echo "\n<strong>Array Multidimensional:</strong>\n";
                print_r($multi);
                echo "</pre></div>";
            }

            // Inserção de itens em arrays usando diferentes métodos
            if ($acao === 'inserir_itens') {
                // Cria array base e array de itens a adicionar
                $arrayBase = array_map('trim', explode(',', $_POST['array_base']));
                $itens = array_map('trim', explode(',', $_POST['itens_adicionar']));
                $metodo = $_POST['metodo_insercao'];

                // Aplica o método de inserção escolhido
                switch ($metodo) {
                    case 'colchetes':
                        // Adiciona cada item ao final do array usando colchetes
                        foreach ($itens as $item) $arrayBase[] = $item;
                        $explicacao = "Com colchetes [], cada item é adicionado no final do array.";
                        break;
                    case 'push':
                        // Adiciona todos os itens ao final do array usando array_push
                        array_push($arrayBase, ...$itens);
                        $explicacao = "Com array_push(), você pode adicionar múltiplos elementos de uma vez.";
                        break;
                    case 'splice':
                        // Insere os itens na posição 1 usando array_splice
                        array_splice($arrayBase, 1, 0, $itens);
                        $explicacao = "Com array_splice(), você insere itens em uma posição específica.";
                        break;
                    case 'merge':
                        // Junta os arrays usando array_merge
                        $arrayBase = array_merge($arrayBase, $itens);
                        $explicacao = "Com array_merge(), dois arrays são combinados em um só.";
                        break;
                    case 'spread':
                        // Junta os arrays usando operador spread (PHP 7.4+)
                        $arrayBase = [...$arrayBase, ...$itens];
                        $explicacao = "Com o operador spread (...), você expande o conteúdo de outro array dentro do atual.";
                        break;
                }

                // Exibe o resultado da inserção
                echo "<div class='secao-resultado'>";
                echo "<h2>Inserção de Itens</h2>";
                echo "<p>$explicacao</p>";
                echo "<pre class='exibicao-array'>";
                print_r($arrayBase);
                echo "</pre></div>";
            }

            // Testa funções de array conforme selecionado pelo usuário
            if ($acao === 'testar_funcoes') {
                // Cria array para teste e obtém a função escolhida
                $array = array_map('trim', explode(',', $_POST['array_teste']));
                $funcao = $_POST['funcao_array'];
                $explicacao = "";

                // Define explicação para cada função
                switch ($funcao) {
                    case 'sort': $explicacao = "sort() ordena os elementos em ordem crescente."; break;
                    case 'rsort': $explicacao = "rsort() ordena em ordem decrescente."; break;
                    case 'asort': $explicacao = "asort() ordena mantendo os índices originais."; break;
                    case 'ksort': $explicacao = "ksort() ordena de acordo com as chaves."; break;
                    case 'shuffle': $explicacao = "shuffle() embaralha a ordem dos elementos."; break;
                    case 'array_reverse': $explicacao = "array_reverse() inverte a ordem dos itens."; break;
                    case 'array_unique': $explicacao = "array_unique() remove valores duplicados."; break;
                    case 'array_search': $explicacao = "array_search() retorna a posição de um valor no array."; break;
                }

                // Caso especial para array_search, mostra a posição do valor 'Banana'
                if ($funcao === 'array_search') {
                    $pos = array_search('Banana', $array);
                    echo "<div class='secao-resultado'><h2>Função: $funcao</h2><p>$explicacao</p><pre class='exibicao-array'>Valor 'Banana' encontrado na posição: $pos</pre></div>";
                    exit;
                }

                // Executa a função no array, se existir
                if (function_exists($funcao)) {
                    $funcao($array);
                }

                // Exibe o resultado da função aplicada
                echo "<div class='secao-resultado'>";
                echo "<h2>Função: $funcao</h2>";
                echo "<p>$explicacao</p>";
                echo "<pre class='exibicao-array'>";
                print_r($array);
                echo "</pre></div>";
            }
        }
        ?>
        <a href="index.html">Voltar</a>