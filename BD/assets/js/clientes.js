document.addEventListener('DOMContentLoaded', function() {
	const form = document.getElementById('formClientes');
	if (form) form.addEventListener('submit', async function(e) {
		e.preventDefault();
		const formData = new FormData(e.target);
		const res = await apiPost('../api/clientes.php', formData);
		if (res.success) {
			showAlert('alertClientes', 'Cliente cadastrado com sucesso!', 'success');
			e.target.reset();
			await renderClientes();
		} else {
			showAlert('alertClientes', res.message || 'Erro', 'error');
		}
	});

	renderClientes();
});

async function renderClientes() {
	const resp = await apiGet('../api/clientes.php');
	const clientes = (resp && resp.data) ? resp.data : [];
	const container = document.getElementById('tabelaClientes');
	if (!container) return;
	document.getElementById('totalClientes').textContent = clientes.length;
	if (clientes.length === 0) {
		container.innerHTML = '<div class="empty-state"><div class="icon">📭</div><p>Nenhum cliente cadastrado ainda</p></div>';
		return;
	}
	let html = '<table><thead><tr><th>ID</th><th>Nome</th><th>Endereço</th><th>Cidade</th><th>Bairro</th><th>Produto</th></tr></thead><tbody>';
	clientes.forEach(c => {
		html += `<tr>
			<td>${c.id}</td>
			<td>${c.nome}</td>
			<td>${c.endereco || '-'}</td>
			<td>${c.cidade || '-'}</td>
			<td>${c.bairro || '-'}</td>
			<td>${c.produto || '-'}</td>
		</tr>`;
	});
	html += '</tbody></table>';
	container.innerHTML = html;
}
