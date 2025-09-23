// Alterna entre abas
function mostrarAba(indice) {
    const abas = document.querySelectorAll('.aba');
    const conteudosAbas = document.querySelectorAll('.conteudo-aba');
    abas.forEach(a => a.classList.remove('ativa'));
    conteudosAbas.forEach(c => c.classList.remove('ativa'));
    abas[indice].classList.add('ativa');
    conteudosAbas[indice].classList.add('ativa');

    // Atualiza previews ao ativar abas (opcional)
    try { mostrarExemploInsercao(); } catch (e) { }
    try { mostrarExemploRemocao(); } catch (e) { }
    try { mostrarExemploOrganizacao(); } catch (e) { }
    try { mostrarExemploFuncao(); } catch (e) { }
}

// ================== Inserção (mantido) ==================
function mostrarExemploInsercao() {
    const metodo = document.getElementById('metodo_insercao').value;
    const arrayBase = document.getElementById('array_base').value.split(',').map(e => e.trim()).filter(Boolean);
    const itens = document.getElementById('itens_adicionar').value.split(',').map(e => e.trim()).filter(Boolean);

    let codigo = `$frutas = ["${arrayBase.join('", "')}"];\n`;
    switch (metodo) {
        case 'colchetes':
            codigo += `${itens.map(i => `$frutas[] = "${i}";`).join('\n')}`;
            break;
        case 'push':
            codigo += `array_push($frutas, "${itens.join('", "')}");`;
            break;
        case 'splice':
            codigo += `array_splice($frutas, 1, 0, ["${itens.join('", "')}"]);`;
            break;
        case 'merge':
            codigo += `$frutas = array_merge($frutas, ["${itens.join('", "')}"]);`;
            break;
        case 'spread':
            codigo += `$frutas = [...$frutas, "${itens.join('", "')}"];`;
            break;
    }
    codigo += `\nprint_r($frutas);`;
    document.getElementById('exemplo-insercao').innerText = codigo;
}

// ================== Remoção ==================
function toggleRemocaoControls() {
    const metodo = document.getElementById('metodo_remocao').value;
    const idx = document.getElementById('remover_index');
    const len = document.getElementById('remover_length');
    const diff = document.getElementById('remover_diff_values');

    // mostra/esconde controles conforme método
    idx.style.display = (metodo === 'unset' || metodo === 'splice') ? 'block' : 'none';
    len.style.display = (metodo === 'splice') ? 'block' : 'none';
    diff.style.display = (metodo === 'diff') ? 'block' : 'none';
}
function mostrarExemploRemocao() {
    const metodo = document.getElementById('metodo_remocao').value;
    const raw = document.getElementById('array_remover').value;
    const array = raw.split(',').map(e => e.trim()).filter(Boolean);
    const idx = document.getElementById('remover_index').value || 0;
    const len = document.getElementById('remover_length').value || 1;
    const diffValues = document.getElementById('remover_diff_values').value.split(',').map(e => e.trim()).filter(Boolean);

    let codigo = `$frutas = ["${array.join('", "')}"];\n`;
    if (array.length === 0) {
        document.getElementById('msg-remocao').style.display = 'block';
        document.getElementById('msg-remocao').innerText = 'Atenção: o array está vazio — não há nada para remover!';
        document.getElementById('btn-remover').classList.add('disabled');
    } else {
        document.getElementById('msg-remocao').style.display = 'none';
        document.getElementById('btn-remover').classList.remove('disabled');
    }

    switch (metodo) {
        case 'unset':
            codigo += `unset($frutas[${idx}]); // Remove índice ${idx}`;
            break;
        case 'pop':
            codigo += `array_pop($frutas); // Remove o último`;
            break;
        case 'shift':
            codigo += `array_shift($frutas); // Remove o primeiro`;
            break;
        case 'splice':
            codigo += `array_splice($frutas, ${idx}, ${len}); // Remove ${len} itens a partir do índice ${idx}`;
            break;
        case 'diff':
            codigo += `$frutas = array_diff($frutas, ["${diffValues.join('","')}"]); // Remove esses valores`;
            break;
    }
    codigo += `\nprint_r($frutas);`;
    document.getElementById('exemplo-remocao').innerText = codigo;
}

// Ao submeter remoção fazemos via fetch (para retorno rápido)
function submitRemocao(e) {
    e.preventDefault();
    if (document.getElementById('btn-remover').classList.contains('disabled')) return false;

    const form = document.getElementById('form-remocao');
    const data = new FormData(form);
    fetch('funcaoArray.php', { method: 'POST', body: data })
        .then(r => r.text())
        .then(html => {
            // mostra em um modal simples (reaproveitando o pre)
            document.getElementById('exemplo-remocao').innerText = html;
        });
    return false;
}

// ================== Organização ==================
function mostrarExemploOrganizacao() {
    const metodo = document.getElementById('metodo_organizacao').value;
    const array = document.getElementById('array_organizar').value.split(',').map(e => e.trim()).filter(Boolean);
    let codigo = `$frutas = ["${array.join('", "')}"];\n`;
    switch (metodo) {
        case 'sort':
            codigo += `sort($frutas); // Ordena em ordem alfabética`;
            break;
        case 'rsort':
            codigo += `rsort($frutas); // Ordem reversa`;
            break;
        case 'asort':
            codigo += `asort($frutas); // Mantém índices`;
            break;
        case 'ksort':
            codigo += `ksort($frutas); // Ordena pelas chaves`;
            break;
        case 'shuffle':
            codigo += `shuffle($frutas); // Embaralha`;
            break;
        case 'array_reverse':
            codigo += `$frutas = array_reverse($frutas); // Inverte a ordem`;
            break;
    }
    codigo += `\nprint_r($frutas);`;
    document.getElementById('exemplo-organizacao').innerText = codigo;
}
function submitOrganizacao(e) {
    e.preventDefault();
    const form = document.getElementById('form-organizacao');
    const data = new FormData(form);
    fetch('funcaoArray.php', { method: 'POST', body: data })
        .then(r => r.text())
        .then(html => {
            document.getElementById('exemplo-organizacao').innerText = html;
        });
    return false;
}

// ================== Funções utilitárias + info detalhada ==================
const functionDocs = {
    array_unique: {
        title: 'array_unique()',
        what: 'Remove valores duplicados e mantém a primeira ocorrência.',
        when: 'Quando quiser eliminar duplicatas em listas de valores simples.',
        complexity: 'O(n) em prática (depende de hashing interno).',
        example: 'Remover duplicatas de nomes num cadastro.'
    },
    array_values: {
        title: 'array_values()',
        what: 'Reindexa o array com índices numéricos sequenciais.',
        when: 'Depois de usar array_filter/array_diff quando quer indices 0..n-1.',
        complexity: 'O(n).',
        example: 'Preparar array para json_encode sem chaves "faltantes".'
    },
    array_search: {
        title: 'array_search()',
        what: 'Busca o valor e retorna a chave/índice da primeira ocorrência.',
        when: 'Quando precisa saber a posição de um valor.',
        complexity: 'O(n).',
        example: 'Encontrar o índice de um usuário em um array de IDs.'
    },
    array_keys: {
        title: 'array_keys()',
        what: 'Retorna um array com todas as chaves de um array.',
        when: 'Quando precisa das chaves para iteração ou verificação.',
        complexity: 'O(n).',
        example: 'Obter todas as chaves para um formulário dinâmico.'
    },
    array_map: {
        title: 'array_map()',
        what: 'Aplica uma função a cada elemento do array e retorna outro array.',
        when: 'Quando quer transformar todos os elementos (ex.: strtoupper).',
        complexity: 'O(n).',
        example: 'Converter todas as strings para maiúsculas.'
    },
    array_filter: {
        title: 'array_filter()',
        what: 'Filtra elementos que passam numa condição (callback).',
        when: 'Remover itens indesejados com critérios customizados.',
        complexity: 'O(n).',
        example: 'Remover strings vazias ou valores nulos.'
    },
    array_reduce: {
        title: 'array_reduce()',
        what: 'Reduz o array a um valor cumulativo (ex.: soma, concatenação).',
        when: 'Calcular somas, concatenar strings ou produzir um acumulado.',
        complexity: 'O(n).',
        example: 'Somar preços de um carrinho.'
    },
    count: {
        title: 'count()',
        what: 'Retorna o número de elementos no array.',
        when: 'Sempre que precisar da contagem.',
        complexity: 'O(1) para arrays conhecidos, O(n) em casos aninhados.',
        example: 'Mostrar número de itens no carrinho.'
    },
    in_array: {
        title: 'in_array()',
        what: 'Verifica existência de um valor no array (true/false).',
        when: 'Checks simples de presença de item.',
        complexity: 'O(n).',
        example: 'Verificar se um usuário já foi selecionado.'
    },
    implode: {
        title: 'implode()',
        what: 'Concatena elementos num string com separador.',
        when: 'Gerar CSV, tags separadas por vírgula, etc.',
        complexity: 'O(n).',
        example: 'Transformar array de tags em uma string.'
    },
    explode: {
        title: 'explode()',
        what: 'Cria um array a partir de uma string separada por delimitador.',
        when: 'Converter input textual em array de valores.',
        complexity: 'O(n).',
        example: 'Separar uma string CSV em um array.'
    },



    // ======================================== NOVOS ARRAY FUNCIONAIS ADICIONADOS ========================================
    charge_key_case: {
        title: 'array_change_key_case()',
        what: 'Converte todas as chaves do array para maiúsculas ou minúsculas.',
        when: 'Quando precisa uniformizar as chaves para comparações ou buscas.',
        complexity: 'O(n).',
        example: 'Padronizar chaves de um array associativo vindo de uma fonte externa.'
    },

    array_sum: {
        title: 'array_sum()',
        what: 'Calcula a soma dos valores numéricos em um array.',
        when: 'Quando precisa somar rapidamente valores numéricos.',
        complexity: 'O(n).',
        example: 'Somar preços de produtos em um carrinho de compras.'
    },

    array_match: {
        title: 'array_match()',
        what: 'Compara dois arrays e retorna os elementos que existem em ambos.',
        when: 'Quando precisa encontrar interseções entre dois conjuntos de dados.',
        complexity: 'O(n*m) no pior caso, onde n e m são os tamanhos dos arrays.',
        example: 'Encontrar usuários que estão em duas listas diferentes.'
    },

    array_column: {
        title: 'array_column()',
        what: 'Extrai uma coluna de valores de um array multidimensional.',
        when: 'Quando precisa de uma lista de valores específicos de um conjunto de registros.',
        complexity: 'O(n).',
        example: 'Obter todos os nomes de usuários de um array de registros de usuários.'
    },

    
};

function updateFunctionInfo() {
    const key = document.getElementById('funcao_array').value;
    const info = functionDocs[key];
    const el = document.getElementById('funcao-info');
    if (!info) { el.style.display = 'none'; return; }
    el.style.display = 'block';
    el.innerHTML = `<strong>${info.title}</strong>
    <p><em>O que faz:</em> ${info.what}</p>
    <p><em>Quando usar:</em> ${info.when}</p>
    <p><em>Complexidade:</em> ${info.complexity}</p>
    <p><em>Exemplo prático:</em> ${info.example}</p>`;
}

// monta o exemplo de código para a função selecionada
function mostrarExemploFuncao() {
    const funcao = document.getElementById('funcao_array').value;
    const array = document.getElementById('array_teste').value.split(',').map(e => e.trim()).filter(Boolean);
    let codigo = `$frutas = ["${array.join('", "')}"];\n`;
    switch (funcao) {
        case 'array_unique':
            codigo += `$frutas = array_unique($frutas);`;
            break;
        case 'array_values':
            codigo += `$frutas = array_values($frutas);`;
            break;
        case 'array_search':
            codigo += `$pos = array_search("Banana", $frutas);\necho $pos;`;
            break;
        case 'array_keys':
            codigo += `$chaves = array_keys($frutas);\nprint_r($chaves);`;
            break;
        case 'array_map':
            codigo += `$maiusculas = array_map('strtoupper', $frutas);\nprint_r($maiusculas);`;
            break;
        case 'array_filter':
            codigo += `$filtrado = array_filter($frutas, fn($v) => strlen($v) > 4);\nprint_r($filtrado);`;
            break;
        case 'array_reduce':
            codigo += `$resultado = array_reduce($frutas, fn($c,$i) => $c.$i."-", "");\necho $resultado;`;
            break;
        case 'count':
            codigo += `echo count($frutas); // ou count($frutas, COUNT_RECURSIVE) para contar recursivamente`;
            break;
        case 'in_array':
            codigo += `echo in_array("Uva", $frutas) ? "Existe" : "Não existe";`;
            break;
        case 'implode':
            codigo += `$str = implode(" | ", $frutas);\necho $str;`;
            break;
        case 'explode':
            codigo += `$str = "Maçã|Banana|Laranja|Uva";\n$nova = explode("|", $str);\nprint_r($nova);`;
            break;
    }
    document.getElementById('exemplo-funcao').innerText = codigo;
    updateFunctionInfo();
}
// Submete a função via AJAX
function submitFuncao(e) {
    e.preventDefault();
    const form = document.getElementById('form-funcoes');
    const data = new FormData(form);
    fetch('funcaoArray.php', { method: 'POST', body: data })
        .then(r => r.text())
        .then(html => {
            const el = document.getElementById('funcao-result');
            el.style.display = 'block';
            el.innerHTML = html;
        });
    return false;
}

// ================== Associativos (simulador) ==================
function addAssocRow(key = '', value = '') {
    const container = document.getElementById('assoc-rows');
    const idx = container.children.length;
    const row = document.createElement('div');
    row.className = 'assoc-row';
    row.innerHTML = `
        <input placeholder="chave" class="assoc-key" value="${escapeHtml(key)}">
        <input placeholder="valor" class="assoc-value" value="${escapeHtml(value)}">
        <button type="button" onclick="removeAssocRow(this)">✖</button>
    `;
    container.appendChild(row);
}
function removeAssocRow(btn) {
    btn.parentElement.remove();
}
function resetAssoc() {
    const container = document.getElementById('assoc-rows');
    container.innerHTML = '';
    addAssocRow('nome', 'João');
    addAssocRow('idade', '30');
}
function generateAssocPreview() {
    const keys = Array.from(document.querySelectorAll('.assoc-key')).map(i => i.value.trim()).filter(Boolean);
    const values = Array.from(document.querySelectorAll('.assoc-value')).map(i => i.value);
    // envia para o PHP para gerar print_r e código
    const fd = new FormData();
    fd.append('acao', 'create_assoc');
    keys.forEach(k => fd.append('assoc_keys[]', k));
    values.forEach(v => fd.append('assoc_values[]', v));
    fetch('funcaoArray.php', { method: 'POST', body: fd })
        .then(r => r.text())
        .then(html => {
            document.getElementById('assoc-preview').style.display = 'block';
            document.getElementById('assoc-preview').innerHTML = html;
            document.getElementById('exemplo-associativo').innerText = html;
        });
}
function escapeHtml(s) { return (s + '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;'); }

// ================== Comparador ==================
function submitCompare(e) {
    e.preventDefault();
    const base = document.getElementById('compare_base').value;
    const other = document.getElementById('compare_other').value;
    const a = document.getElementById('compare_a').value;
    const b = document.getElementById('compare_b').value;

    const fd = new FormData();
    fd.append('acao', 'compare_methods');
    fd.append('base', base);
    fd.append('other', other);
    fd.append('methodA', a);
    fd.append('methodB', b);

    fetch('funcaoArray.php', { method: 'POST', body: fd })
        .then(r => r.text())
        .then(html => {
            const el = document.getElementById('compare-result');
            el.style.display = 'block';
            el.innerHTML = html;
        });
    return false;
}

// ================== Tente Você Mesmo ==================
// function runUserCode() {
//     const code = document.getElementById('user_code').value;
//     const fd = new FormData();
//     fd.append('acao', 'try_code');
//     fd.append('user_code', code);

//     fetch('funcaoArray.php', { method: 'POST', body: fd })
//         .then(r => r.text())
//         .then(html => {
//             const el = document.getElementById('try-result');
//             el.style.display = 'block';
//             el.innerHTML = html;
//             window.scrollTo({ top: el.offsetTop, behavior: 'smooth' });
//         });
// }

// ================== Utils ==================
function copyCode(preId) {
    const txt = document.getElementById(preId).innerText;
    navigator.clipboard?.writeText(txt).then(() => {
        alert('Código copiado!');
    }).catch(() => {
        prompt('Copiar manualmente:', txt);
    });
}

// Inicialização
document.addEventListener('DOMContentLoaded', () => {
    // adicionar algumas linhas iniciais no associativo
    if (!document.getElementById('assoc-rows').children.length) {
        resetAssoc();
    }
    toggleRemocaoControls();
    mostrarExemploInsercao();
    mostrarExemploRemocao();
    mostrarExemploOrganizacao();
    mostrarExemploFuncao();

    // ajuda rápida: quando clicar em uma help-icon mostra explicação geral
    document.querySelectorAll('.help-icon').forEach(btn => {
        btn.addEventListener('click', () => {
            const fn = btn.dataset.fn;
            let text = '';
            switch (fn) {
                case 'insercao': text = `Inserção: [] é simples;    
                array_push aceita múltiplos; 
                array_splice insere em posição; 
                array_merge junta arrays; 
                spread exige PHP 7.4+`; break;

                case 'remocao': text = `Remoção: unset remove chave; 
                array_pop/shift removem fim/início; 
                splice remove por faixa; 
                array_diff remove valores comparando outro array.`; break;
                
                case 'organizacao': text = `Organização: 
                sort/rsort ordenam; 
                                asort/ksort mantêm chaves; 
                shuffle embaralha; 
                array_reverse inverte.`; break;
                
                case 'funcoes': text = `Funções comuns: 
                array_map/array_filter/array_reduce para transformar/filtrar/reduzir; 
                array_search/in_array para buscar; implode/explode para strings.`; break;
            }
            alert(text);
        });
    });

    // atualizar info quando mudar a função
    document.getElementById('funcao_array').addEventListener('change', updateFunctionInfo);
});


