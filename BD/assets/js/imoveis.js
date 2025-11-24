document.addEventListener('DOMContentLoaded', function() {
	const form = document.getElementById('formImoveis');
	if (form) form.addEventListener('submit', async function(e) {
		e.preventDefault();
		const formData = new FormData(e.target);
		const res = await apiPost('../api/imoveis.php', formData);
		if (res.success) {
			showAlert('alertImoveis', 'Imóvel cadastrado com sucesso!', 'success');
			e.target.reset();
			await renderImoveis();
		} else {
			showAlert('alertImoveis', res.message || 'Erro', 'error');
		}
	});

	renderImoveis();
});

async function renderImoveis() {
	const resp = await apiGet('../api/imoveis.php');
	const imoveis = (resp && resp.data) ? resp.data : [];
	const container = document.getElementById('tabelaImoveis');
	if (!container) return;
	document.getElementById('totalImoveis').textContent = imoveis.length;
	if (imoveis.length === 0) {
		container.innerHTML = '<div class="empty-state"><div class="icon">📭</div><p>Nenhum imóvel cadastrado ainda</p></div>';
		return;
	}
	let html = '<table><thead><tr><th>ID</th><th>Tipo</th><th>Finalidade</th><th>Localização</th><th>Preço</th><th>Detalhes</th></tr></thead><tbody>';
	imoveis.forEach(i => {
		const detalhes = `${i.qtd_quarto || 0} quartos, ${i.qtd_banheiro || 0} banheiros, ${i.qtd_vaga || 0} vagas`;
		html += `<tr>
			<td>${i.id}</td>
			<td>${i.tipo}</td>
			<td>${i.finalidade}</td>
			<td>${i.localizacao}</td>
			<td class="price">${formatPriceBR(i.preco)}</td>
			<td>${detalhes}</td>
		</tr>`;
	});
	html += '</tbody></table>';
	container.innerHTML = html;
}
