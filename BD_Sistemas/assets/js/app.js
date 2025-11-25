// Função auxiliar para fazer requisições POST
async function apiPost(url, formData) {
	try {
		const response = await fetch(url, {
			method: 'POST',
			body: formData
		});
		return await response.json();
	} catch (error) {
		console.error('Erro na requisição:', error);
		return { success: false, message: 'Erro na comunicação com servidor' };
	}
}

// Função auxiliar para fazer requisições GET
async function apiGet(url) {
	try {
		const response = await fetch(url, {
			method: 'GET'
		});
		return await response.json();
	} catch (error) {
		console.error('Erro na requisição:', error);
		return { success: false, message: 'Erro na comunicação com servidor' };
	}
}

// Função para exibir alertas
function showAlert(elementId, message, type) {
	const alertContainer = document.getElementById(elementId);
	if (!alertContainer) return;
	
	const alertClass = type === 'success' ? 'alert-success' : 'alert-error';
	alertContainer.innerHTML = `<div class="alert ${alertClass}">${message}</div>`;
	
	setTimeout(() => {
		alertContainer.innerHTML = '';
	}, 5000);
}

// Função para formatar preço em Real
function formatPriceBR(value) {
	return new Intl.NumberFormat('pt-BR', {
		style: 'currency',
		currency: 'BRL'
	}).format(value);
}

// Função para alternar abas
function showTab(tabName, event) {
	event.preventDefault();
	
	// Ocultar todas as abas
	const tabContents = document.querySelectorAll('.tab-content');
	tabContents.forEach(tab => {
		tab.classList.remove('active');
	});
	
	// Remover classe active de todos os botões
	const tabButtons = document.querySelectorAll('.tab-button');
	tabButtons.forEach(btn => {
		btn.classList.remove('active');
	});
	
	// Mostrar aba selecionada
	const selectedTab = document.getElementById(tabName);
	if (selectedTab) {
		selectedTab.classList.add('active');
	}
	
	// Adicionar classe active ao botão clicado
	event.target.classList.add('active');
}
