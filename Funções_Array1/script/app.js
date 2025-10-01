let currentCategory = 0;
let currentSubTab = 0;
let currentExplanation = null; // Nova variável para controlar a explicação aberta

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
                    <button class="copy-btn" onclick="copyCode(\`${escapeCode(func.code)}\`)">
                        📋 Copiar
                    </button>
                </div>
            </div>
            <p class="card-description">${func.description}</p>
            <div class="code-block">${escapeHtml(func.code)}</div>
            <div class="card-footer">
                <div class="info-box complexity-box">
                    <h4>⚡ Complexidade</h4>
                    <p>${func.complexity}</p>
                </div>
                <div class="info-box usecases-box">
                    <h4>💡 Casos de Uso</h4>
                    <ul>
                        ${func.useCases.map(use => `<li>${use}</li>`).join('')}
                    </ul>
                </div>
            </div>
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
        <p>📝 <strong>Explicação detalhada:</strong></p>
        <p>${func.description}</p>
        <p>⚡ <strong>Complexidade:</strong> ${func.complexity}</p>
        <p>💡 <strong>Casos de uso comuns:</strong></p>
        <ul>
            ${func.useCases.map(use => `<li>${use}</li>`).join('')}
        </ul>
        <p>🔍 <strong>Dica:</strong> Experimente o código exemplo para entender melhor como funciona!</p>
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

function copyCode(code) {
    navigator.clipboard.writeText(code).then(() => {
        showToast('✓ Código copiado!');
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
    return code.replace(/`/g, '\\`').replace(/\$/g, '\\$');
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