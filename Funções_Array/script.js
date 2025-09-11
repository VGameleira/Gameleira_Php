// Alterna entre as abas
function mostrarAba(indice) {
    const abas = document.querySelectorAll('.aba');
    const conteudosAbas = document.querySelectorAll('.conteudo-aba');

    abas.forEach(aba => aba.classList.remove('ativa'));
    conteudosAbas.forEach(conteudo => conteudo.classList.remove('ativa'));

    abas[indice].classList.add('ativa');
    conteudosAbas[indice].classList.add('ativa');
}

// Exemplo dinâmico para inserção
function mostrarExemploInsercao() {
    const metodo = document.getElementById('metodo_insercao').value;
    const arrayBase = document.getElementById('array_base').value.split(',').map(e => e.trim());
    const itens = document.getElementById('itens_adicionar').value.split(',').map(e => e.trim());

    let codigo = `$frutas = ["${arrayBase.join('", "')}"];\n`;
    switch(metodo) {
        case 'colchetes':
            codigo += `$frutas[] = "${itens.join('";\n$frutas[] = "')}";`;
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

// Exemplo dinâmico para remoção
function mostrarExemploRemocao() {
    const metodo = document.getElementById('metodo_remocao').value;
    const array = document.getElementById('array_remover').value.split(',').map(e => e.trim());

    let codigo = `$frutas = ["${array.join('", "')}"];\n`;
    switch(metodo) {
        case 'unset':
            codigo += `unset($frutas[1]); // Remove o índice 1`;
            break;
        case 'pop':
            codigo += `array_pop($frutas); // Remove o último`;
            break;
        case 'shift':
            codigo += `array_shift($frutas); // Remove o primeiro`;
            break;
        case 'splice':
            codigo += `array_splice($frutas, 1, 2); // Remove dois itens a partir do índice 1`;
            break;
        case 'diff':
            codigo += `$frutas = array_diff($frutas, ["Banana"]); // Remove todas as "Banana"`;
            break;
    }
    codigo += `\nprint_r($frutas);`;
    document.getElementById('exemplo-remocao').innerText = codigo;
}

// Exemplo dinâmico para organização
function mostrarExemploOrganizacao() {
    const metodo = document.getElementById('metodo_organizacao').value;
    const array = document.getElementById('array_organizar').value.split(',').map(e => e.trim());

    let codigo = `$frutas = ["${array.join('", "')}"];\n`;
    switch(metodo) {
        case 'sort':
            codigo += `sort($frutas); // Ordena em ordem alfabética`;
            break;
        case 'rsort':
            codigo += `rsort($frutas); // Ordem reversa`;
            break;
        case 'asort':
            codigo += `asort($frutas); // Mantém os índices originais`;
            break;
        case 'ksort':
            codigo += `ksort($frutas); // Ordena pelas chaves`;
            break;
        case 'shuffle':
            codigo += `shuffle($frutas); // Embaralha os itens`;
            break;
        case 'array_reverse':
            codigo += `$frutas = array_reverse($frutas); // Inverte a ordem`;
            break;
    }
    codigo += `\nprint_r($frutas);`;
    document.getElementById('exemplo-organizacao').innerText = codigo;
}

// Exemplo dinâmico para funções utilitárias
function mostrarExemploFuncao() {
    const funcao = document.getElementById('funcao_array').value;
    const array = document.getElementById('array_teste').value.split(',').map(e => e.trim());

    let codigo = `$frutas = ["${array.join('", "')}"];\n`;
    switch(funcao) {
        case 'array_unique':
            codigo += `$frutas = array_unique($frutas); // Remove duplicatas`;
            break;
        case 'array_values':
            codigo += `$frutas = array_values($frutas); // Reindexa`;
            break;
        case 'array_search':
            codigo += `$pos = array_search("Banana", $frutas);\necho $pos; // Posição de "Banana"`;
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
            codigo += `echo count($frutas); // Número de itens`;
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
}
