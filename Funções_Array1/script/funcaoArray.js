const categories = [
    {
        name: 'Fundamentos',
        icon: '📖',
        subcategories: [
            { name: 'Tipos de Arrays', id: 'tipos' },
            { name: 'Criação', id: 'criacao' },
            { name: 'Acesso', id: 'acesso' }
        ]
    },
    {
        name: 'Manipulação',
        icon: '✏️',
        subcategories: [
            { name: 'Inserção', id: 'insercao' },
            { name: 'Remoção', id: 'remocao' },
            { name: 'Modificação', id: 'modificacao' }
        ]
    },
    {
        name: 'Organização',
        icon: '🔄',
        subcategories: [
            { name: 'Ordenação', id: 'ordenacao' },
            { name: 'Reversão', id: 'reversao' },
            { name: 'Embaralhamento', id: 'embaralhamento' }
        ]
    },
    {
        name: 'Transformação',
        icon: '🔨',
        subcategories: [
            { name: 'Map', id: 'map' },
            { name: 'Filter', id: 'filter' },
            { name: 'Reduce', id: 'reduce' }
        ]
    },
    {
        name: 'Busca & Análise',
        icon: '🔍',
        subcategories: [
            { name: 'Busca', id: 'busca' },
            { name: 'Verificação', id: 'verificacao' },
            { name: 'Estatísticas', id: 'estatisticas' }
        ]
    },
    {
        name: 'Combinação',
        icon: '🔗',
        subcategories: [
            { name: 'Merge & Combine', id: 'merge' },
            { name: 'Intersecção', id: 'intersecao' },
            { name: 'Diferença', id: 'diferenca' }
        ]
    },
    {
        name: 'Strings',
        icon: '✍️',
        subcategories: [
            { name: 'Transformação', id: 'string_transform' },
            { name: 'Verificação', id: 'string_check' }
        ]
    }
];

const functionDatabase = {
    tipos: [
        {
            name: 'Array Indexado',
            code: `$frutas = ["Maçã", "Banana", "Laranja"];
// Acesso: $frutas[0] = "Maçã"
echo $frutas[1]; // Banana`,
            description: 'Array com índices numéricos automáticos (0, 1, 2...)',
            complexity: 'O(1) para acesso',
            useCases: ['Listas simples', 'Coleções ordenadas', 'Iteração sequencial']
        },
        {
            name: 'Array Associativo',
            code: `$usuario = [
    "nome" => "João",
    "idade" => 30,
    "email" => "joao@email.com"
];
// Acesso: $usuario["nome"] = "João"
echo $usuario["idade"]; // 30`,
            description: 'Array com chaves nomeadas (strings)',
            complexity: 'O(1) para acesso',
            useCases: ['Objetos de dados', 'Configurações', 'Mapeamento chave-valor']
        },
        {
            name: 'Array Multidimensional',
            code: `$matriz = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];
// Acesso: $matriz[1][2] = 6
echo $matriz[0][0]; // 1`,
            description: 'Arrays dentro de arrays (múltiplas dimensões)',
            complexity: 'O(1) para acesso direto',
            useCases: ['Matrizes', 'Tabelas', 'Dados hierárquicos']
        }
    ],

    criacao: [
        {
            name: 'Sintaxe Curta []',
            code: `$frutas = ["Maçã", "Banana", "Laranja"];
$vazio = [];
$misto = [1, "texto", true, 3.14];`,
            description: 'Forma moderna e recomendada de criar arrays (PHP 5.4+)',
            complexity: 'O(1)',
            useCases: ['Criação rápida', 'Código limpo', 'Arrays literais']
        },
        {
            name: 'Função array()',
            code: `$frutas = array("Maçã", "Banana", "Laranja");
$assoc = array("nome" => "João", "idade" => 30);`,
            description: 'Forma tradicional de criar arrays',
            complexity: 'O(1)',
            useCases: ['Compatibilidade PHP < 5.4', 'Código legado']
        },
        {
            name: 'range()',
            code: `$numeros = range(1, 10);
// [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]

$letras = range('a', 'z');
// ['a', 'b', 'c', ..., 'z']

$pares = range(0, 20, 2);
// [0, 2, 4, 6, 8, 10, 12, 14, 16, 18, 20]`,
            description: 'Cria array com sequência de valores',
            complexity: 'O(n)',
            useCases: ['Sequências numéricas', 'Letras do alfabeto', 'Loops']
        }
    ],

    acesso: [
        {
            name: 'Acesso por Índice',
            code: `$frutas = ["Maçã", "Banana", "Laranja"];
echo $frutas[0]; // Maçã
echo $frutas[2]; // Laranja

// Modificar
$frutas[1] = "Morango";`,
            description: 'Acessa elementos usando colchetes',
            complexity: 'O(1)',
            useCases: ['Ler valores', 'Modificar elementos', 'Acesso direto']
        },
        {
            name: 'Acesso por Chave',
            code: `$usuario = ["nome" => "João", "idade" => 30];
echo $usuario["nome"]; // João

// Verificar se existe
if (isset($usuario["email"])) {
    echo $usuario["email"];
}`,
            description: 'Acessa elementos associativos por chave',
            complexity: 'O(1)',
            useCases: ['Arrays associativos', 'Dados estruturados']
        },
        {
            name: 'list() - Desestruturação',
            code: `$coordenadas = [10, 20];
list($x, $y) = $coordenadas;
echo $x; // 10
echo $y; // 20

// Sintaxe curta (PHP 7.1+)
[$a, $b] = [100, 200];`,
            description: 'Extrai valores para variáveis individuais',
            complexity: 'O(1)',
            useCases: ['Desestruturar arrays', 'Múltiplas atribuições']
        }
    ],

    insercao: [
        {
            name: 'array_push()',
            code: `$frutas = ["Maçã", "Banana"];
array_push($frutas, "Laranja", "Uva");
// Resultado: ["Maçã", "Banana", "Laranja", "Uva"]

print_r($frutas);`,
            description: 'Adiciona um ou mais elementos no final do array',
            complexity: 'O(1) por elemento',
            useCases: ['Adicionar múltiplos itens', 'Construir listas dinamicamente']
        },
        {
            name: 'array_unshift()',
            code: `$frutas = ["Banana", "Laranja"];
array_unshift($frutas, "Maçã", "Uva");
// Resultado: ["Maçã", "Uva", "Banana", "Laranja"]

print_r($frutas);`,
            description: 'Adiciona elementos no início do array',
            complexity: 'O(n) - reindexação necessária',
            useCases: ['Adicionar itens prioritários', 'Fila invertida']
        },
        {
            name: 'array_splice() - Inserir',
            code: `$frutas = ["Maçã", "Laranja"];
array_splice($frutas, 1, 0, ["Banana", "Uva"]);
// Insere no índice 1, sem remover nada
// Resultado: ["Maçã", "Banana", "Uva", "Laranja"]

print_r($frutas);`,
            description: 'Insere elementos em posição específica',
            complexity: 'O(n)',
            useCases: ['Inserção em posição específica', 'Manipulação precisa']
        },
        {
            name: 'Operador [] (colchetes)',
            code: `$frutas = ["Maçã"];
$frutas[] = "Banana";
$frutas[] = "Laranja";
// Resultado: ["Maçã", "Banana", "Laranja"]

print_r($frutas);`,
            description: 'Adiciona um elemento por vez no final',
            complexity: 'O(1)',
            useCases: ['Adicionar um item', 'Construção incremental', 'Mais simples']
        }
    ],

    remocao: [
        {
            name: 'array_pop()',
            code: `$frutas = ["Maçã", "Banana", "Laranja"];
$ultima = array_pop($frutas);
echo $ultima; // "Laranja"
// $frutas agora é ["Maçã", "Banana"]

print_r($frutas);`,
            description: 'Remove e retorna o último elemento',
            complexity: 'O(1)',
            useCases: ['Pilha (stack)', 'Remover último item']
        },
        {
            name: 'array_shift()',
            code: `$frutas = ["Maçã", "Banana", "Laranja"];
$primeira = array_shift($frutas);
echo $primeira; // "Maçã"
// $frutas agora é ["Banana", "Laranja"]

print_r($frutas);`,
            description: 'Remove e retorna o primeiro elemento',
            complexity: 'O(n) - reindexação',
            useCases: ['Fila (queue)', 'Remover primeiro item']
        },
        {
            name: 'unset()',
            code: `$frutas = ["Maçã", "Banana", "Laranja"];
unset($frutas[1]);
// $frutas = [0 => "Maçã", 2 => "Laranja"]

// Reindexar se necessário
$frutas = array_values($frutas);
print_r($frutas);`,
            description: 'Remove elemento por índice (não reindexa automaticamente)',
            complexity: 'O(1)',
            useCases: ['Remover item específico', 'Quando índices não importam']
        },
        {
            name: 'array_splice() - Remover',
            code: `$frutas = ["Maçã", "Banana", "Laranja", "Uva"];
array_splice($frutas, 1, 2);
// Remove 2 elementos a partir do índice 1
// Resultado: ["Maçã", "Uva"]

print_r($frutas);`,
            description: 'Remove elementos por faixa e reindexa',
            complexity: 'O(n)',
            useCases: ['Remover múltiplos itens', 'Remoção precisa']
        },
        {
            name: 'array_diff()',
            code: `$frutas = ["Maçã", "Banana", "Laranja", "Uva"];
$remover = ["Banana", "Uva"];
$resultado = array_diff($frutas, $remover);
// Resultado: ["Maçã", "Laranja"]

print_r(array_values($resultado));`,
            description: 'Remove valores comparando com outro array',
            complexity: 'O(n*m)',
            useCases: ['Remover múltiplos valores', 'Filtrar por exclusão']
        }
    ],

    modificacao: [
        {
            name: 'array_map() - Modificar',
            code: `$precos = [10, 20, 30];
$com_desconto = array_map(function($p) {
    return $p * 0.9; // 10% desconto
}, $precos);
// Resultado: [9, 18, 27]

print_r($com_desconto);`,
            description: 'Transforma cada elemento mantendo estrutura',
            complexity: 'O(n)',
            useCases: ['Aplicar desconto', 'Converter valores', 'Transformações']
        },
        {
            name: 'array_walk()',
            code: `$frutas = ["maçã", "banana"];
array_walk($frutas, function(&$v, $k) {
    $v = strtoupper($v);
});
// Modifica o array original
// Resultado: ["MAÇÃ", "BANANA"]

print_r($frutas);`,
            description: 'Modifica array in-place com callback',
            complexity: 'O(n)',
            useCases: ['Modificar array original', 'Efeitos colaterais']
        },
        {
            name: 'array_replace()',
            code: `$base = ["a" => "maçã", "b" => "banana"];
$novo = ["b" => "beterraba", "c" => "cenoura"];
$resultado = array_replace($base, $novo);
// ["a" => "maçã", "b" => "beterraba", "c" => "cenoura"]

print_r($resultado);`,
            description: 'Substitui valores mantendo chaves',
            complexity: 'O(n+m)',
            useCases: ['Atualizar configurações', 'Override de valores']
        }
    ],

    ordenacao: [
        {
            name: 'sort()',
            code: `$numeros = [3, 1, 4, 1, 5, 9];
sort($numeros);
// Resultado: [1, 1, 3, 4, 5, 9]

print_r($numeros);`,
            description: 'Ordena em ordem crescente (não mantém chaves)',
            complexity: 'O(n log n)',
            useCases: ['Ordenar valores simples', 'Listas numéricas']
        },
        {
            name: 'rsort()',
            code: `$numeros = [3, 1, 4, 1, 5, 9];
rsort($numeros);
// Resultado: [9, 5, 4, 3, 1, 1]

print_r($numeros);`,
            description: 'Ordena em ordem decrescente',
            complexity: 'O(n log n)',
            useCases: ['Top N', 'Ranking decrescente', 'Maiores valores']
        },
        {
            name: 'asort()',
            code: `$notas = ["João" => 85, "Maria" => 92, "Pedro" => 78];
asort($notas);
// Mantém associação chave => valor
// Resultado: ["Pedro" => 78, "João" => 85, "Maria" => 92]

print_r($notas);`,
            description: 'Ordena mantendo associação chave-valor',
            complexity: 'O(n log n)',
            useCases: ['Ordenar mantendo chaves', 'Rankings com nomes']
        },
        {
            name: 'ksort()',
            code: `$dados = ["z" => 1, "a" => 2, "m" => 3];
ksort($dados);
// Ordena pelas chaves
// Resultado: ["a" => 2, "m" => 3, "z" => 1]

print_r($dados);`,
            description: 'Ordena pelas chaves alfabeticamente',
            complexity: 'O(n log n)',
            useCases: ['Ordenar por chave', 'Organizar configurações']
        },
        {
            name: 'usort()',
            code: `$pessoas = [
    ["nome" => "João", "idade" => 30],
    ["nome" => "Maria", "idade" => 25]
];
usort($pessoas, function($a, $b) {
    return $a["idade"] <=> $b["idade"];
});
// Ordena por idade

print_r($pessoas);`,
            description: 'Ordenação customizada com função',
            complexity: 'O(n log n)',
            useCases: ['Ordenação complexa', 'Múltiplos critérios', 'Objetos']
        },
        {
            name: 'natsort()',
            code: `$arquivos = ["img1.jpg", "img10.jpg", "img2.jpg"];
natsort($arquivos);
// Ordenação "natural"
// Resultado: ["img1.jpg", "img2.jpg", "img10.jpg"]

print_r($arquivos);`,
            description: 'Ordenação natural (numérica dentro de strings)',
            complexity: 'O(n log n)',
            useCases: ['Nomes de arquivos', 'Versões', 'Ordenação humana']
        }
    ],

    reversao: [
        {
            name: 'array_reverse()',
            code: `$frutas = ["Maçã", "Banana", "Laranja"];
$invertido = array_reverse($frutas);
// Resultado: ["Laranja", "Banana", "Maçã"]

print_r($invertido);`,
            description: 'Inverte a ordem dos elementos',
            complexity: 'O(n)',
            useCases: ['Inverter ordem', 'LIFO para FIFO', 'Reverter sequência']
        },
        {
            name: 'array_reverse() - Preservar Chaves',
            code: `$notas = ["João" => 85, "Maria" => 92];
$invertido = array_reverse($notas, true);
// true = preserva chaves
// Resultado: ["Maria" => 92, "João" => 85]

print_r($invertido);`,
            description: 'Inverte mantendo chaves associativas',
            complexity: 'O(n)',
            useCases: ['Inverter mantendo associações', 'Ordem reversa']
        }
    ],

    embaralhamento: [
        {
            name: 'shuffle()',
            code: `$cartas = ["A", "K", "Q", "J"];
shuffle($cartas);
// Ordem aleatória (perde as chaves)
// Resultado: pode ser ["Q", "A", "J", "K"]

print_r($cartas);`,
            description: 'Embaralha elementos aleatoriamente',
            complexity: 'O(n)',
            useCases: ['Jogos', 'Randomização', 'Sorteios']
        },
        {
            name: 'array_rand()',
            code: `$frutas = ["Maçã", "Banana", "Laranja", "Uva"];
$chave = array_rand($frutas);
echo $frutas[$chave]; // Uma fruta aleatória

// Pegar múltiplos
$chaves = array_rand($frutas, 2);
print_r($chaves);`,
            description: 'Retorna chaves aleatórias do array',
            complexity: 'O(1) para um, O(n) para múltiplos',
            useCases: ['Seleção aleatória', 'Sorteios', 'Amostras']
        }
    ],

    map: [
        {
            name: 'array_map()',
            code: `$numeros = [1, 2, 3, 4, 5];
$quadrados = array_map(function($n) {
    return $n * $n;
}, $numeros);
// Resultado: [1, 4, 9, 16, 25]

print_r($quadrados);`,
            description: 'Aplica função a cada elemento',
            complexity: 'O(n)',
            useCases: ['Transformar todos os elementos', 'Conversão em massa']
        },
        {
            name: 'array_column()',
            code: `$usuarios = [
    ["id" => 1, "nome" => "João"],
    ["id" => 2, "nome" => "Maria"]
];
$nomes = array_column($usuarios, "nome");
// Resultado: ["João", "Maria"]

print_r($nomes);`,
            description: 'Extrai coluna de array multidimensional',
            complexity: 'O(n)',
            useCases: ['Extrair campo específico', 'Projeção de dados', 'Listas simples']
        },
        {
            name: 'array_map() - Múltiplos Arrays',
            code: `$nomes = ["João", "Maria"];
$idades = [30, 25];
$resultado = array_map(function($n, $i) {
    return "$n tem $i anos";
}, $nomes, $idades);
// ["João tem 30 anos", "Maria tem 25 anos"]

print_r($resultado);`,
            description: 'Combina múltiplos arrays em um',
            complexity: 'O(n)',
            useCases: ['Combinar dados', 'Merge personalizado']
        }
    ],

    filter: [
        {
            name: 'array_filter()',
            code: `$numeros = [1, 2, 3, 4, 5, 6];
$pares = array_filter($numeros, function($n) {
    return $n % 2 === 0;
});
// Resultado: [2, 4, 6]

print_r(array_values($pares));`,
            description: 'Filtra elementos com condição',
            complexity: 'O(n)',
            useCases: ['Remover itens indesejados', 'Validação', 'Filtros complexos']
        },
        {
            name: 'array_unique()',
            code: `$frutas = ["Maçã", "Banana", "Maçã", "Laranja", "Banana"];
$unicas = array_unique($frutas);
// Resultado: ["Maçã", "Banana", "Laranja"]

print_r(array_values($unicas));`,
            description: 'Remove valores duplicados',
            complexity: 'O(n)',
            useCases: ['Eliminar duplicatas', 'Valores únicos', 'Limpeza de dados']
        },
        {
            name: 'array_filter() - Remover Vazios',
            code: `$dados = ["João", "", "Maria", null, "Pedro", 0];
$limpo = array_filter($dados);
// Remove valores "falsy" (vazio, null, 0, false)
// Resultado: ["João", "Maria", "Pedro"]

print_r(array_values($limpo));`,
            description: 'Remove valores vazios/falsy',
            complexity: 'O(n)',
            useCases: ['Limpar arrays', 'Remover nulos', 'Validação']
        }
    ],

    reduce: [
        {
            name: 'array_reduce()',
            code: `$numeros = [1, 2, 3, 4, 5];
$soma = array_reduce($numeros, function($carry, $item) {
    return $carry + $item;
}, 0);
// Resultado: 15

echo "Soma: $soma";`,
            description: 'Reduz array a valor único',
            complexity: 'O(n)',
            useCases: ['Somas', 'Concatenação', 'Agregação']
        },
        {
            name: 'array_sum()',
            code: `$numeros = [10, 20, 30, 40];
$total = array_sum($numeros);
// Resultado: 100

echo "Total: $total";`,
            description: 'Soma todos os valores numéricos',
            complexity: 'O(n)',
            useCases: ['Totalizações', 'Cálculos rápidos', 'Somar preços']
        },
        {
            name: 'array_product()',
            code: `$numeros = [2, 3, 4];
$produto = array_product($numeros);
// Resultado: 24 (2 * 3 * 4)

echo "Produto: $produto";`,
            description: 'Multiplica todos os valores',
            complexity: 'O(n)',
            useCases: ['Produto de valores', 'Cálculos matemáticos']
        },
        {
            name: 'implode()',
            code: `$frutas = ["Maçã", "Banana", "Laranja"];
$texto = implode(", ", $frutas);
// Resultado: "Maçã, Banana, Laranja"

echo $texto;`,
            description: 'Junta elementos em string',
            complexity: 'O(n)',
            useCases: ['CSV', 'Strings formatadas', 'Concatenação']
        }
    ],

    busca: [
        {
            name: 'array_search()',
            code: `$frutas = ["Maçã", "Banana", "Laranja"];
$indice = array_search("Banana", $frutas);
// Resultado: 1

if ($indice !== false) {
    echo "Encontrado no índice: $indice";
}`,
            description: 'Busca valor e retorna índice',
            complexity: 'O(n)',
            useCases: ['Encontrar posição', 'Localizar item', 'Validação']
        },
        {
            name: 'in_array()',
            code: `$frutas = ["Maçã", "Banana", "Laranja"];
$existe = in_array("Banana", $frutas);
// Resultado: true

if ($existe) {
    echo "Banana está no array!";
}`,
            description: 'Verifica se valor existe',
            complexity: 'O(n)',
            useCases: ['Validação', 'Verificação rápida', 'Segurança']
        },
        {
            name: 'array_key_exists()',
            code: `$usuario = ["nome" => "João", "idade" => 30];
$tem_email = array_key_exists("email", $usuario);
// Resultado: false

if (array_key_exists("nome", $usuario)) {
    echo $usuario["nome"];
}`,
            description: 'Verifica se chave existe',
            complexity: 'O(1)',
            useCases: ['Verificar campos', 'Validação de estrutura', 'APIs']
        },
        {
            name: 'array_keys()',
            code: `$usuario = ["nome" => "João", "idade" => 30, "cidade" => "SP"];
$campos = array_keys($usuario);
// Resultado: ["nome", "idade", "cidade"]

print_r($campos);`,
            description: 'Retorna todas as chaves',
            complexity: 'O(n)',
            useCases: ['Listar campos', 'Validação', 'Iteração por chaves']
        },
        {
            name: 'array_values()',
            code: `$usuario = ["nome" => "João", "idade" => 30];
$valores = array_values($usuario);
// Resultado: ["João", 30]

print_r($valores);`,
            description: 'Retorna todos os valores (reindexa)',
            complexity: 'O(n)',
            useCases: ['Reindexar', 'Remover chaves', 'Arrays numéricos']
        }
    ],

    verificacao: [
        {
            name: 'isset()',
            code: `$dados = ["nome" => "João", "idade" => null];

if (isset($dados["nome"])) {
    echo $dados["nome"]; // João
}

// isset retorna false para null
echo isset($dados["idade"]); // false`,
            description: 'Verifica se chave existe e não é null',
            complexity: 'O(1)',
            useCases: ['Validação', 'Evitar erros', 'Verificar dados']
        },
        {
            name: 'empty()',
            code: `$dados = ["nome" => "", "idade" => 0, "ativo" => false];

if (empty($dados["nome"])) {
    echo "Nome vazio"; // Executa
}

// empty retorna true para: "", 0, null, false, []
echo empty($dados["idade"]); // true`,
            description: 'Verifica se valor é vazio/falsy',
            complexity: 'O(1)',
            useCases: ['Validação de formulários', 'Dados vazios']
        },
        {
            name: 'is_array()',
            code: `$dados = ["a", "b", "c"];
$texto = "não é array";

if (is_array($dados)) {
    echo "É um array!";
}

echo is_array($texto); // false`,
            description: 'Verifica se variável é array',
            complexity: 'O(1)',
            useCases: ['Validação de tipo', 'Debugging', 'Type checking']
        }
    ],

    estatisticas: [
        {
            name: 'count() / sizeof()',
            code: `$frutas = ["Maçã", "Banana", "Laranja"];
$total = count($frutas);
// Resultado: 3

echo "Total de frutas: $total";

// sizeof é um alias de count
echo sizeof($frutas); // 3`,
            description: 'Conta elementos do array',
            complexity: 'O(1) para arrays simples',
            useCases: ['Tamanho', 'Validação', 'Loops']
        },
        {
            name: 'array_count_values()',
            code: `$votos = ["A", "B", "A", "C", "A", "B"];
$contagem = array_count_values($votos);
// Resultado: ["A" => 3, "B" => 2, "C" => 1]

print_r($contagem);`,
            description: 'Conta frequência de valores',
            complexity: 'O(n)',
            useCases: ['Estatísticas', 'Votação', 'Histograma', 'Analytics']
        },
        {
            name: 'max() / min()',
            code: `$numeros = [3, 7, 2, 9, 5];
$maior = max($numeros);  // 9
$menor = min($numeros);  // 2

echo "Maior: $maior, Menor: $menor";`,
            description: 'Encontra maior/menor valor',
            complexity: 'O(n)',
            useCases: ['Extremos', 'Validação de ranges', 'Estatísticas']
        },
        {
            name: 'array_chunk()',
            code: `$numeros = [1, 2, 3, 4, 5, 6, 7, 8];
$grupos = array_chunk($numeros, 3);
// Resultado: [[1,2,3], [4,5,6], [7,8]]

print_r($grupos);`,
            description: 'Divide array em grupos menores',
            complexity: 'O(n)',
            useCases: ['Paginação', 'Batches', 'Grupos', 'Processamento']
        }
    ],

    merge: [
        {
            name: 'array_merge()',
            code: `$arr1 = ["a", "b"];
$arr2 = ["c", "d"];
$resultado = array_merge($arr1, $arr2);
// Resultado: ["a", "b", "c", "d"]

print_r($resultado);`,
            description: 'Junta arrays (reindexa numéricos)',
            complexity: 'O(n+m)',
            useCases: ['Combinar listas', 'Juntar dados', 'Unir coleções']
        },
        {
            name: 'array_combine()',
            code: `$chaves = ["nome", "idade", "cidade"];
$valores = ["João", 30, "São Paulo"];
$resultado = array_combine($chaves, $valores);
// ["nome" => "João", "idade" => 30, "cidade" => "São Paulo"]

print_r($resultado);`,
            description: 'Cria associativo usando arrays de chaves e valores',
            complexity: 'O(n)',
            useCases: ['Criar dicionário', 'Mapear dados', 'Transformar estrutura']
        },
        {
            name: 'Operador + (union)',
            code: `$arr1 = ["a" => 1, "b" => 2];
$arr2 = ["b" => 3, "c" => 4];
$resultado = $arr1 + $arr2;
// ["a" => 1, "b" => 2, "c" => 4]
// Mantém valores de $arr1 para chaves duplicadas

print_r($resultado);`,
            description: 'União preservando chaves do primeiro array',
            complexity: 'O(n+m)',
            useCases: ['Defaults', 'Configurações', 'Preferências']
        },
        {
            name: 'array_merge_recursive()',
            code: `$arr1 = ["a" => ["x" => 1]];
$arr2 = ["a" => ["y" => 2]];
$resultado = array_merge_recursive($arr1, $arr2);
// ["a" => ["x" => 1, "y" => 2]]

print_r($resultado);`,
            description: 'Merge recursivo para arrays multidimensionais',
            complexity: 'O(n+m)',
            useCases: ['Configurações aninhadas', 'Deep merge']
        }
    ],

    intersecao: [
        {
            name: 'array_intersect()',
            code: `$arr1 = ["a", "b", "c", "d"];
$arr2 = ["b", "d", "e"];
$comum = array_intersect($arr1, $arr2);
// Resultado: ["b", "d"]

print_r(array_values($comum));`,
            description: 'Retorna valores comuns entre arrays',
            complexity: 'O(n*m)',
            useCases: ['Encontrar comum', 'Validação cruzada', 'Interseção']
        },
        {
            name: 'array_intersect_key()',
            code: `$arr1 = ["a" => 1, "b" => 2, "c" => 3];
$arr2 = ["b" => 5, "c" => 6];
$resultado = array_intersect_key($arr1, $arr2);
// Resultado: ["b" => 2, "c" => 3]

print_r($resultado);`,
            description: 'Intersecção por chaves',
            complexity: 'O(n+m)',
            useCases: ['Filtrar por chaves', 'Validação de campos']
        },
        {
            name: 'array_intersect_assoc()',
            code: `$arr1 = ["a" => "verde", "b" => "azul"];
$arr2 = ["a" => "verde", "b" => "vermelho"];
$resultado = array_intersect_assoc($arr1, $arr2);
// ["a" => "verde"] - chave E valor iguais

print_r($resultado);`,
            description: 'Intersecção comparando chave e valor',
            complexity: 'O(n*m)',
            useCases: ['Comparação exata', 'Validação completa']
        }
    ],

    diferenca: [
        {
            name: 'array_diff()',
            code: `$arr1 = ["a", "b", "c", "d"];
$arr2 = ["b", "d"];
$diferenca = array_diff($arr1, $arr2);
// Resultado: ["a", "c"]

print_r(array_values($diferenca));`,
            description: 'Valores presentes no primeiro mas não no segundo',
            complexity: 'O(n*m)',
            useCases: ['Remover itens', 'Exclusão', 'Diferença de conjuntos']
        },
        {
            name: 'array_diff_key()',
            code: `$arr1 = ["a" => 1, "b" => 2, "c" => 3];
$arr2 = ["b" => 5];
$resultado = array_diff_key($arr1, $arr2);
// Resultado: ["a" => 1, "c" => 3]

print_r($resultado);`,
            description: 'Diferença por chaves',
            complexity: 'O(n+m)',
            useCases: ['Remover campos', 'Filtro por chaves']
        },
        {
            name: 'array_diff_assoc()',
            code: `$arr1 = ["a" => "verde", "b" => "azul"];
$arr2 = ["a" => "verde", "b" => "vermelho"];
$resultado = array_diff_assoc($arr1, $arr2);
// ["b" => "azul"] - valor diferente

print_r($resultado);`,
            description: 'Diferença comparando chave e valor',
            complexity: 'O(n*m)',
            useCases: ['Detectar mudanças', 'Comparação de configs']
        }
    ],

    string_transform: [
        {
            name: 'strtolower()',
            code: `$texto = "OLÁPROGRAMADOR";
$minusculo = strtolower($texto);
echo $minusculo; // olaprogramador`,
            description: 'Converte string para minúsculas',
            complexity: 'O(n)',
            useCases: ['Normalização de texto', 'Comparações case-insensitive', 'Formatação']
        },
        {
            name: 'strtoupper()',
            code: `$texto = "oláprogramador";
$maiusculo = strtoupper($texto);
echo $maiusculo; // OLAPROGRAMADOR`,
            description: 'Converte string para maiúsculas',
            complexity: 'O(n)',
            useCases: ['Destaque de texto', 'Padronização', 'Formatação']
        },
        {
            name: 'ucwords()',
            code: `$texto = "olá mundo php";
$capitalizado = ucwords($texto);
echo $capitalizado; // Olá Mundo Php`,
            description: 'Capitaliza primeira letra de cada palavra',
            complexity: 'O(n)',
            useCases: ['Formatação de nomes', 'Títulos', 'Cabeçalhos']
        },
        {
            name: 'ucfirst()',
            code: `$texto = "primeira letra maiúscula";
$capitalizado = ucfirst($texto);
echo $capitalizado; // Primeira letra maiúscula`,
            description: 'Capitaliza primeira letra da string',
            complexity: 'O(1)',
            useCases: ['Formatação de frases', 'Nomes próprios', 'Sentenças']
        }
    ],

    string_check: [
        {
            name: 'preg_match()',
            code: `$texto = "Email: teste@email.com";
$padrao = "/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/";
if (preg_match($padrao, $texto, $matches)) {
    echo "Email encontrado: " . $matches[0];
}`,
            description: 'Busca padrão em string usando expressão regular',
            complexity: 'O(n)',
            useCases: ['Validação de formato', 'Extração de dados', 'Busca avançada']
        },
        {
            name: 'isset()',
            code: `$array = ["nome" => "João"];

// Verifica se chave existe
if (isset($array["nome"])) {
    echo "Nome definido: " . $array["nome"];
}

// Verifica múltiplas variáveis
if (isset($nome, $idade, $email)) {
    echo "Todas variáveis definidas";
}`,
            description: 'Verifica se variável está definida e não é NULL',
            complexity: 'O(1)',
            useCases: ['Validação de dados', 'Verificação de existência', 'Prevenção de erros']
        }
    ]
};
