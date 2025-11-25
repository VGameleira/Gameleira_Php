document.addEventListener('DOMContentLoaded', function() {
	const form = document.getElementById('formProdutos');
	if (form) form.addEventListener('submit', async function(e) {
		e.preventDefault();
		const formData = new FormData(e.target);
		const res = await apiPost('../api/produtos.php', formData);
		if (res.success) {
			showAlert('alertProdutos', 'Produto cadastrado com sucesso!', 'success');
			e.target.reset();
			await renderProdutos();
		} else {
			showAlert('alertProdutos', res.message || 'Erro', 'error');
		}
	});

	renderProdutos();
});

async function renderProdutos() {
	const resp = await apiGet('../api/produtos.php');
	const produtos = (resp && resp.data) ? resp.data : [];
	const container = document.getElementById('tabelaProdutos');
	if (!container) return;
	document.getElementById('totalProdutos').textContent = produtos.length;
	const totalEstoque = produtos.reduce((sum, p) => sum + (parseInt(p.quantidade) || 0), 0);
	const totalEstoqueEl = document.getElementById('totalEstoque');
	if (totalEstoqueEl) totalEstoqueEl.textContent = totalEstoque;
	if (produtos.length === 0) {
		container.innerHTML = '<div class="empty-state"><div class="icon">📭</div><p>Nenhum produto cadastrado ainda</p></div>';
		return;
	}
	let html = '<table><thead><tr><th>ID</th><th>Nome</th><th>Preço</th><th>Quantidade</th><th>Descrição</th></tr></thead><tbody>';
	produtos.forEach(p => {
		html += `<tr>
			<td>${p.id}</td>
			<td>${p.nome}</td>
			<td class="price">${formatPriceBR(p.preco)}</td>
			<td style="text-align: center;">${p.quantidade}</td>
			<td>${p.descricao || '-'}</td>
		</tr>`;
	});
	html += '</tbody></table>';
	container.innerHTML = html;
}
