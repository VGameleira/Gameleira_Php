let currentCategory = 0;
let currentSubTab = 0;
let currentExplanation = null; 

function renderCategories() {
    const container = document.getElementById('categories-container');
    container.innerHTML = categories.map((cat, index) => `
        <button class="category-btn ${index === currentCategory ? 'active' : ''}"
                onclick="changeCategory(${index})">
            <span class="category-icon">${cat.icon}</span>
            <span>${cat.name}</span>
        </button>
    `).join('');
}

function renderSubTabs() {
    const container = document.getElementById('subtabs-container');
    const subcats = categories[currentCategory].subcategories;
    container.innerHTML = subcats.map((sub, index) => `
        <button class="subtab-btn ${index === currentSubTab ? 'active' : ''}"
                onclick="changeSubTab(${index})">
            ${sub.name}
        </button>
    `).join('');
}

function renderFunctions() {
    const container = document.getElementById('functions-container');
    const subcatId = categories[currentCategory].subcategories[currentSubTab].id;
    const functions = functionDatabase[subcatId] || [];

    if (functions.length === 0) {
        container.innerHTML = '<p style="text-align:center;color:#666;padding:40px;">Em breve mais funções nesta categoria...</p>';
        return;
    }

      container.innerHTML = functions.map((func, index) => `
        <div class="function-card">
            <div class="card-header">
                <h3>${func.name}</h3>
                <div class="card-actions">
                    <button class="explain-btn" onclick="showExplanation(${currentCategory}, ${currentSubTab}, ${index})">
                        📚 Explicação
                    </button>
                    <button class="copy-btn" onclick="copyCodeSafe('${index}')">
                        📋 Copiar
                    </button>
                </div>
            </div>
            <p class="card-description">${func.description}</p>
            <div class="code-block">${escapeHtml(func.code)}</div>
            <!-- ...resto do código... -->
        </div>
    `).join('');
}


/**
 * FUNÇÃO: showExplanation(catIndex, subIndex, funcIndex)
 * OBJETIVO: Explica uma função específica em um modal
 */
function showExplanation(catIndex, subIndex, funcIndex) {
    const func = functionDatabase[categories[catIndex].subcategories[subIndex].id][funcIndex];
    currentExplanation = { catIndex, subIndex, funcIndex };
    
    const explanationContent = func.explanation || `
        <div class="explanation-section">
            <h3>📝 Descrição Detalhada</h3>
            <p>${func.description}</p>
            
            <h3>⚙️ Como Funciona</h3>
            <div class="explanation-tip">
                <p>Esta função ${func.name.toLowerCase()} opera da seguinte forma:</p>
                <ul>
                    <li>Entrada: ${getInputDescription(func)}</li>
                    <li>Processamento: ${getProcessingDescription(func)}</li>
                    <li>Saída: ${getOutputDescription(func)}</li>
                </ul>
            </div>

            <h3>⚡ Complexidade</h3>
            <p>${func.complexity}</p>
            <div class="explanation-tip">
                <p>Isso significa que ${getComplexityExplanation(func.complexity)}</p>
            </div>

            <h3>💡 Casos de Uso</h3>
            <ul>
                ${func.useCases.map(use => `<li>${use}</li>`).join('')}
            </ul>

            <h3>⚠️ Pontos Importantes</h3>
            <div class="explanation-warning">
                ${getImportantNotes(func.name)}
            </div>

            <h3>🔍 Exemplo Explicado</h3>
            <p>Vamos analisar o código de exemplo:</p>
            <code class="example-code">${func.code}</code>
            <p>${getCodeExplanation(func.name)}</p>
        </div>
    `;

    // Criar ou atualizar o modal de explicação
    let modal = document.getElementById('explanation-modal');
    if (!modal) {
        modal = document.createElement('div');
        modal.id = 'explanation-modal';
        modal.className = 'explanation-modal';
        modal.innerHTML = `
            <div class="modal-content">
                <div class="modal-header">
                    <h2>📚 ${func.name}</h2>
                    <button class="close-btn" onclick="closeExplanation()">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="explanation-content"></div>
                </div>
                <div class="modal-footer">
                    <button class="nav-btn prev-btn" onclick="navigateExplanation(-1)">← Anterior</button>
                    <button class="nav-btn next-btn" onclick="navigateExplanation(1)">Próxima →</button>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
    }

    modal.querySelector('.explanation-content').innerHTML = explanationContent;
    modal.classList.add('show');
    
    updateNavigationButtons();
}

/**
 * FUNÇÃO: closeExplanation()
 * OBJETIVO: Fecha o modal de explicação
 */
function closeExplanation() {
    const modal = document.getElementById('explanation-modal');
    if (modal) {
        modal.classList.remove('show');
    }
    currentExplanation = null;
}

/**
 * FUNÇÃO: navigateExplanation(direction)
 * OBJETIVO: Navega entre as explicações
 */
function navigateExplanation(direction) {
    if (!currentExplanation) return;
    
    const { catIndex, subIndex, funcIndex } = currentExplanation;
    const functions = functionDatabase[categories[catIndex].subcategories[subIndex].id];
    
    const newIndex = funcIndex + direction;
    
    // Verifica limites
    if (newIndex >= 0 && newIndex < functions.length) {
        showExplanation(catIndex, subIndex, newIndex);
    }
}

/**
 * FUNÇÃO: updateNavigationButtons()
 * OBJETIVO: Atualiza estado dos botões de navegação
 */
function updateNavigationButtons() {
    if (!currentExplanation) return;
    
    const { catIndex, subIndex, funcIndex } = currentExplanation;
    const functions = functionDatabase[categories[catIndex].subcategories[subIndex].id];
    const modal = document.getElementById('explanation-modal');
    
    if (modal) {
        const prevBtn = modal.querySelector('.prev-btn');
        const nextBtn = modal.querySelector('.next-btn');
        
        prevBtn.disabled = funcIndex === 0;
        nextBtn.disabled = funcIndex === functions.length - 1;
    }
}

// Funções existentes mantidas...
function changeCategory(index) {
    currentCategory = index;
    currentSubTab = 0;
    closeExplanation(); // Fecha explicação ao mudar categoria
    renderCategories();
    renderSubTabs();
    renderFunctions();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function changeSubTab(index) {
    currentSubTab = index;
    closeExplanation(); // Fecha explicação ao mudar subaba
    renderSubTabs();
    renderFunctions();
}

function copyCodeSafe(index) {
    const subcatId = categories[currentCategory].subcategories[currentSubTab].id;
    const functions = functionDatabase[subcatId] || [];
    const code = functions[index]?.code || '';
    
    navigator.clipboard.writeText(code).then(() => {
        showToast('✓ Código copiado!');
    }).catch(() => {
        showToast('❌ Erro ao copiar código');
    });
}
function showToast(message) {
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.classList.add('show');
    setTimeout(() => {
        toast.classList.remove('show');
    }, 2000);
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function escapeCode(code) {
    if (typeof code !== 'string') return '';
    return code
        .replace(/`/g, '\\`')
        .replace(/\$/g, '\\$')
        .replace(/\\/g, '\\\\')
        .replace(/\n/g, '\\n')
        .replace(/\r/g, '\\r')
        .replace(/'/g, "\\'")
        .replace(/"/g, '\\"');
}

// Fechar modal ao clicar fora
document.addEventListener('click', (e) => {
    const modal = document.getElementById('explanation-modal');
    if (e.target === modal) {
        closeExplanation();
    }
});

// Fechar modal com ESC
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeExplanation();
    }
});

document.addEventListener('DOMContentLoaded', () => {
    renderCategories();
    renderSubTabs();
    renderFunctions();
});

// Funções auxiliares para gerar explicações detalhadas
function getInputDescription(func) {
    const descriptions = {
        'array_map': 'Recebe uma função de callback e um ou mais arrays',
        'array_filter': 'Recebe um array e opcionalmente uma função de callback para filtrar',
        'strtolower': 'Recebe uma string que será convertida para minúsculas',
        'strtoupper': 'Recebe uma string que será convertida para maiúsculas',
        'ucwords': 'Recebe uma string onde cada palavra terá a primeira letra maiúscula',
        'ucfirst': 'Recebe uma string onde a primeira letra será maiúscula',
        'preg_match': 'Recebe um padrão (expressão regular) e uma string para buscar',
        'isset': 'Recebe uma ou mais variáveis para verificar se estão definidas'
        // Adicione mais descrições conforme necessário
    };
    return descriptions[func.name] || 'Recebe os parâmetros necessários para execução';
}

function getProcessingDescription(func) {
    const descriptions = {
        'array_map': 'Aplica a função de callback em cada elemento do(s) array(s)',
        'array_filter': 'Verifica cada elemento do array contra a condição de filtro',
        'strtolower': 'Converte cada caractere da string para sua versão minúscula',
        'strtoupper': 'Converte cada caractere da string para sua versão maiúscula',
        'ucwords': 'Identifica cada palavra e converte sua primeira letra para maiúscula',
        'ucfirst': 'Identifica e converte apenas o primeiro caractere para maiúsculo',
        'preg_match': 'Analisa a string procurando ocorrências que correspondam ao padrão',
        'isset': 'Verifica se cada variável está definida e não é NULL'
        // Adicione mais descrições conforme necessário
    };
    return descriptions[func.name] || 'Processa os dados de acordo com a lógica da função';
}

function getOutputDescription(func) {
    const descriptions = {
        'array_map': 'Retorna um novo array com os resultados das transformações',
        'array_filter': 'Retorna um novo array contendo apenas os elementos que passaram no filtro',
        'strtolower': 'Retorna a string convertida para minúsculas',
        'strtoupper': 'Retorna a string convertida para maiúsculas',
        'ucwords': 'Retorna a string com as primeiras letras de cada palavra em maiúsculo',
        'ucfirst': 'Retorna a string com a primeira letra em maiúsculo',
        'preg_match': 'Retorna true se encontrar o padrão e false caso contrário',
        'isset': 'Retorna true se todas as variáveis estiverem definidas, false caso contrário'
        // Adicione mais descrições conforme necessário
    };
    return descriptions[func.name] || 'Retorna o resultado do processamento';
}

function getComplexityExplanation(complexity) {
    const explanations = {
        'O(1)': 'a função tem tempo constante, independente do tamanho da entrada',
        'O(n)': 'o tempo de execução cresce linearmente com o tamanho da entrada',
        'O(n log n)': 'o tempo de execução cresce de forma logarítmica multiplicada pelo tamanho da entrada',
        'O(n*m)': 'o tempo de execução depende do produto dos tamanhos das duas entradas'
    };
    return explanations[complexity] || 'o tempo de execução varia conforme especificado';
}

function getImportantNotes(funcName) {
    const notes = {
        'strtolower': 'Funciona apenas com caracteres ASCII por padrão. Para caracteres especiais ou UTF-8, considere usar mb_strtolower()',
        'strtoupper': 'Funciona apenas com caracteres ASCII por padrão. Para caracteres especiais ou UTF-8, considere usar mb_strtoupper()',
        'ucwords': 'Considera espaços e alguns caracteres de pontuação como separadores de palavras',
        'ucfirst': 'Afeta apenas o primeiro caractere, mesmo que seja um número ou símbolo',
        'preg_match': 'Expressões regulares podem impactar a performance. Use com moderação em grandes volumes de dados',
        'isset': 'Não verifica se o valor é vazio, apenas se está definido e não é NULL'
    };
    return notes[funcName] || 'Verifique a documentação oficial do PHP para mais detalhes sobre esta função';
}

function getCodeExplanation(funcName) {
    const explanations = {
        'strtolower': 'O exemplo mostra como converter uma string toda para minúsculas, útil para comparações case-insensitive',
        'strtoupper': 'O exemplo demonstra a conversão de uma string para maiúsculas, frequentemente usado para destacar texto',
        'ucwords': 'No exemplo, cada palavra da frase tem sua primeira letra convertida para maiúscula, ideal para títulos',
        'ucfirst': 'O exemplo mostra como capitalizar apenas a primeira letra de uma frase',
        'preg_match': 'O exemplo utiliza uma expressão regular para validar um formato de email',
        'isset': 'O exemplo demonstra como verificar a existência de chaves em um array e múltiplas variáveis'
    };
    return explanations[funcName] || 'O exemplo acima demonstra o uso básico da função';
}