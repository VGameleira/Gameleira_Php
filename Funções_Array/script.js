// Função para alternar entre as abas do conteúdo
function mostrarAba(indice) {
    const abas = document.querySelectorAll('.aba'); // Seleciona todas as abas
    const conteudosAbas = document.querySelectorAll('.conteudo-aba'); // Seleciona todos os conteúdos das abas

    // Remove a classe 'ativa' de todas as abas e conteúdos
    abas.forEach(aba => aba.classList.remove('ativa'));
    conteudosAbas.forEach(conteudo => conteudo.classList.remove('ativa'));

    // Adiciona a classe 'ativa' na aba e conteúdo selecionados
    abas[indice].classList.add('ativa');
    conteudosAbas[indice].classList.add('ativa');
}

// Função para mostrar o exemplo de código PHP de inserção de itens no array
function mostrarExemploInsercao() {
    // Obtém o método selecionado e os valores dos campos do formulário
    const metodo = document.getElementById('metodo_insercao').value;
    const arrayBase = document.getElementById('array_base').value.split(',').map(e => e.trim());
    const itens = document.getElementById('itens_adicionar').value.split(',').map(e => e.trim());

    // Monta o início do código PHP de exemplo
    let codigo = "$frutas = [\"" + arrayBase.join('\", \"') + "\"];\n";
    // Adiciona o exemplo conforme o método escolhido
    switch(metodo) {
        case 'colchetes':
            // Adiciona cada item usando colchetes
            codigo += `$frutas[] = "${itens.join('";\n$frutas[] = "')}";`;
            break;
        case 'push':
            // Usa array_push para adicionar todos os itens
            codigo += `array_push($frutas, "${itens.join('", "')}");`;
            break;
        case 'splice':
            // Usa array_splice para inserir itens na posição 1
            codigo += `array_splice($frutas, 1, 0, ["${itens.join('", "')}"]);`;
            break;
        case 'merge':
            // Usa array_merge para juntar arrays
            codigo += `$frutas = array_merge($frutas, ["${itens.join('", "')}"]);`;
            break;
        case 'spread':
            // Usa operador spread (PHP 7.4+) para juntar arrays
            codigo += `$frutas = [...$frutas, "${itens.join('", "')}"];`;
            break;
    }
    // Exibe o código de exemplo no elemento da página
    document.getElementById('exemplo-insercao').innerText = codigo;
}

// Função para mostrar o exemplo de código PHP das funções de array
function mostrarExemploFuncao() {
    // Obtém a função selecionada e os valores do array do formulário
    const funcao = document.getElementById('funcao_array').value;
    const array = document.getElementById('array_teste').value.split(',').map(e => e.trim());
    let codigo = "$frutas = [\"" + array.join('\", \"') + "\"];\n";

    // Adiciona o exemplo conforme a função escolhida
    switch(funcao) {
        case 'array_pop':
            // Remove o último item do array
            codigo += "array_pop($frutas); // remove o último item\n";
            break;
        case 'array_shift':
            // Remove o primeiro item do array
            codigo += "array_shift($frutas); // remove o primeiro item\n";
            break;
        case 'array_slice':
            // Pega uma parte do array
            codigo += "$nova = array_slice($frutas, 1, 3); // pega parte do array\n";
            break;
        case 'array_diff':
            // Remove elementos iguais ao outro array
            codigo += "$outra = ['Banana'];\n$nova = array_diff($frutas, $outra); // remove elementos iguais\n";
            break;
        case 'array_values':
            // Reindexa o array
            codigo += "$frutas = array_values($frutas); // reindexa o array\n";
            break;
        default:
            // Aplica a função diretamente
            codigo += `${funcao}($frutas);\n`;
    }
    // Adiciona a impressão do array no final
    codigo += "print_r($frutas);";

    // Exibe o código de exemplo no elemento da página
    document.getElementById('exemplo-funcao').innerText = codigo;
}