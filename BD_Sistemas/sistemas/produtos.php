<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Produtos - Sistema</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        header {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        header h1 {
            color: #667eea;
            font-size: 2em;
        }

        .user-info {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s;
            position: relative;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
        }

        .badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            align-items: center;
            justify-content: center;
            overflow-y: auto;
            padding: 20px;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 40px;
            border-radius: 15px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-content h2 {
            color: #667eea;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
        }

        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #667eea;
        }

        .modal-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }

        .modal-tab {
            flex: 1;
            padding: 12px;
            background: #f0f0f0;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s;
        }

        .modal-tab.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .filters {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .filters h3 {
            color: #667eea;
            margin-bottom: 20px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }

        .produtos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }

        .produto-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }

        .produto-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
        }

        .produto-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
        }

        .produto-content {
            padding: 20px;
        }

        .produto-categoria {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .produto-preco {
            color: #28a745;
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
        }

        .produto-estoque {
            color: #666;
            font-size: 14px;
            margin: 10px 0;
        }

        .btn-add-cart {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s;
        }

        .btn-add-cart:hover {
            transform: translateY(-2px);
        }

        .btn-add-cart:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .carrinho-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .carrinho-item-info {
            flex: 1;
        }

        .carrinho-item-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .qty-control {
            display: flex;
            gap: 5px;
            align-items: center;
        }

        .qty-btn {
            width: 30px;
            height: 30px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .qty-input {
            width: 50px;
            text-align: center;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .carrinho-total {
            background: #667eea;
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin: 20px 0;
            font-weight: bold;
            text-align: center;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 15px;
        }

        .empty-state .icon {
            font-size: 80px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>📦 Loja de Produtos</h1>
            <div class="user-info">
                <span id="welcomeText">Bem-vindo!</span>
                <button class="btn" id="btnCarrinho" style="display:none;">
                    🛒 Carrinho
                    <span class="badge" id="carrinhoCount">0</span>
                </button>
                <button class="btn btn-secondary" id="btnLogout" style="display:none;">Sair</button>
                <button class="btn" id="btnLogin">Login / Cadastro</button>
            </div>
        </header>

        <div id="alertContainer"></div>

        <!-- Modal de Login/Registro -->
        <div class="modal" id="authModal">
            <div class="modal-content">
                <h2>Acesso ao Sistema</h2>
                <div class="modal-tabs">
                    <button class="modal-tab active" onclick="switchAuthTab('login')">Login</button>
                    <button class="modal-tab" onclick="switchAuthTab('register')">Cadastro</button>
                </div>

                <form id="formLogin" style="display:block;">
                    <div class="form-group">
                        <label>CPF *</label>
                        <input type="text" name="cpf" required placeholder="000.000.000-00">
                    </div>
                    <div class="form-group">
                        <label>Senha *</label>
                        <input type="password" name="senha" required>
                    </div>
                    <button type="submit" class="btn" style="width:100%;">Entrar</button>
                </form>

                <form id="formRegister" style="display:none;">
                    <div class="form-group">
                        <label>Nome Completo *</label>
                        <input type="text" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label>CPF *</label>
                        <input type="text" name="cpf" required placeholder="000.000.000-00">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email">
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="tel" name="telefone" placeholder="(00) 00000-0000">
                    </div>
                    <div class="form-group">
                        <label>Senha *</label>
                        <input type="password" name="senha" required>
                    </div>
                    <button type="submit" class="btn" style="width:100%;">Cadastrar</button>
                </form>
            </div>
        </div>

        <!-- Modal do Carrinho -->
        <div class="modal" id="carrinhoModal">
            <div class="modal-content">
                <h2>🛒 Meu Carrinho</h2>
                <div id="carrinhoContent"></div>
                <div class="carrinho-total" id="carrinhoTotal">
                    Total: R$ 0,00
                </div>
                <button class="btn" style="width:100%;margin-top:15px;" onclick="finalizarCompra()">
                    Finalizar Compra
                </button>
                <button class="btn btn-secondary" style="width:100%;margin-top:10px;" onclick="fecharCarrinho()">
                    Continuar Comprando
                </button>
            </div>
        </div>

        <!-- Filtros -->
        <div class="filters">
            <h3>🔍 Filtrar Produtos</h3>
            <div class="filter-grid">
                <div class="form-group">
                    <label>Buscar</label>
                    <input type="text" id="filtroBusca" placeholder="Nome do produto...">
                </div>
                <div class="form-group">
                    <label>Categoria</label>
                    <select id="filtroCategoria">
                        <option value="">Todas</option>
                        <option value="Informática">Informática</option>
                        <option value="Celulares">Celulares</option>
                        <option value="Eletrônicos">Eletrônicos</option>
                        <option value="Móveis">Móveis</option>
                        <option value="Áudio">Áudio</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Preço Mínimo</label>
                    <input type="number" id="filtroPrecoMin" value="0" min="0">
                </div>
                <div class="form-group">
                    <label>Preço Máximo</label>
                    <input type="number" id="filtroPrecoMax" value="10000" min="0">
                </div>
            </div>
            <button class="btn" onclick="aplicarFiltros()" style="width:100%;">Aplicar Filtros</button>
        </div>

        <!-- Grid de Produtos -->
        <div class="produtos-grid" id="produtosGrid"></div>
    </div>

    <script>
        let clienteLogado = false;
        let clienteNome = '';
        let carrinho = [];

        window.addEventListener('DOMContentLoaded', async function() {
            await verificarSessao();
            await carregarProdutos();
        });

        async function verificarSessao() {
            const res = await fetch('../api/auth.php?sistema=produtos&action=check');
            const data = await res.json();
            
            if (data.logged_in) {
                clienteLogado = true;
                clienteNome = data.cliente_nome;
                document.getElementById('welcomeText').textContent = `Olá, ${clienteNome}!`;
                document.getElementById('btnLogin').style.display = 'none';
                document.getElementById('btnLogout').style.display = 'block';
                document.getElementById('btnCarrinho').style.display = 'block';
                await atualizarCarrinho();
            }
        }

        function switchAuthTab(tab) {
            document.querySelectorAll('.modal-tab').forEach(t => t.classList.remove('active'));
            event.target.classList.add('active');
            
            if (tab === 'login') {
                document.getElementById('formLogin').style.display = 'block';
                document.getElementById('formRegister').style.display = 'none';
            } else {
                document.getElementById('formLogin').style.display = 'none';
                document.getElementById('formRegister').style.display = 'block';
            }
        }

        document.getElementById('formLogin').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            formData.append('action', 'login');
            
            const res = await fetch('../api/auth.php?sistema=produtos', {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            
            showAlert(data.message, data.success ? 'success' : 'error');
            
            if (data.success) {
                document.getElementById('authModal').classList.remove('active');
                await verificarSessao();
                await carregarProdutos();
            }
        });

        document.getElementById('formRegister').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            formData.append('action', 'register');
            
            const res = await fetch('../api/auth.php?sistema=produtos', {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            
            showAlert(data.message, data.success ? 'success' : 'error');
            
            if (data.success) {
                document.getElementById('authModal').classList.remove('active');
                await verificarSessao();
                await carregarProdutos();
            }
        });

        document.getElementById('btnLogout').addEventListener('click', async function() {
            const formData = new FormData();
            formData.append('action', 'logout');
            await fetch('../api/auth.php?sistema=produtos', { method: 'POST', body: formData });
            location.reload();
        });

        document.getElementById('btnLogin').addEventListener('click', function() {
            document.getElementById('authModal').classList.add('active');
        });

        document.getElementById('btnCarrinho').addEventListener('click', function() {
            document.getElementById('carrinhoModal').classList.add('active');
        });

        ['authModal', 'carrinhoModal'].forEach(id => {
            document.getElementById(id).addEventListener('click', function(e) {
                if (e.target === this) this.classList.remove('active');
            });
        });

        async function carregarProdutos() {
            const categoria = document.getElementById('filtroCategoria').value;
            const busca = document.getElementById('filtroBusca').value;
            const precoMin = document.getElementById('filtroPrecoMin').value;
            const precoMax = document.getElementById('filtroPrecoMax').value;
            
            const url = clienteLogado 
                ? `../api/produtos_cliente.php?categoria=${categoria}&busca=${busca}&preco_min=${precoMin}&preco_max=${precoMax}`
                : `../api/produtos_cliente.php?categoria=${categoria}&busca=${busca}&preco_min=${precoMin}&preco_max=${precoMax}`;
            
            const res = await fetch(url);
            const data = await res.json();
            
            if (!data.success && !clienteLogado) {
                document.getElementById('produtosGrid').innerHTML = `
                    <div class="empty-state" style="grid-column: 1/-1;">
                        <div class="icon">🔒</div>
                        <h2>Faça login para ver os produtos disponíveis</h2>
                        <button class="btn" onclick="document.getElementById('authModal').classList.add('active')" style="margin-top:20px;">
                            Fazer Login
                        </button>
                    </div>
                `;
                return;
            }
            
            renderProdutos(data.data || []);
        }

        function renderProdutos(produtos) {
            const grid = document.getElementById('produtosGrid');
            
            if (produtos.length === 0) {
                grid.innerHTML = `
                    <div class="empty-state" style="grid-column: 1/-1;">
                        <div class="icon">📭</div>
                        <p>Nenhum produto encontrado</p>
                    </div>
                `;
                return;
            }
            
            grid.innerHTML = produtos.map(p => `
                <div class="produto-card">
                    <div class="produto-image">📦</div>
                    <div class="produto-content">
                        ${p.categoria ? `<span class="produto-categoria">${p.categoria}</span>` : ''}
                        <h3>${p.nome}</h3>
                        <div class="produto-preco">
                            ${formatarPreco(p.preco)}
                        </div>
                        <div class="produto-estoque">
                            ${p.quantidade > 0 ? `✅ ${p.quantidade} em estoque` : '❌ Indisponível'}
                        </div>
                        <p style="color:#666;font-size:14px;margin:10px 0;">
                            ${p.descricao || ''}
                        </p>
                        ${clienteLogado ? `
                            <button class="btn-add-cart" 
                                    onclick="adicionarAoCarrinho(${p.id})"
                                    ${p.quantidade === 0 ? 'disabled' : ''}>
                                ${p.quantidade > 0 ? '🛒 Adicionar ao Carrinho' : 'Indisponível'}
                            </button>
                        ` : ''}
                    </div>
                </div>
            `).join('');
        }

        async function adicionarAoCarrinho(produtoId) {
            const formData = new FormData();
            formData.append('produto_id', produtoId);
            formData.append('quantidade', 1);
            formData.append('action', 'add_carrinho');
            
            const res = await fetch('../api/produtos_cliente.php', {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            
            showAlert(data.message, data.success ? 'success' : 'error');
            
            if (data.success) {
                await atualizarCarrinho();
            }
        }

        async function atualizarCarrinho() {
            const res = await fetch('../api/produtos_cliente.php?action=carrinho');
            const data = await res.json();
            
            carrinho = data.data || [];
            document.getElementById('carrinhoCount').textContent = carrinho.length;
            
            const content = document.getElementById('carrinhoContent');
            if (carrinho.length === 0) {
                content.innerHTML = '<p style="text-align:center;color:#666;padding:40px;">Seu carrinho está vazio</p>';
                document.getElementById('carrinhoTotal').textContent = 'Total: R$ 0,00';
            } else {
                content.innerHTML = carrinho.map(item => `
                    <div class="carrinho-item">
                        <div class="carrinho-item-info">
                            <strong>${item.nome}</strong><br>
                            <span style="color:#666;">${formatarPreco(item.preco)} x ${item.quantidade}</span>
                        </div>
                        <div class="carrinho-item-actions">
                            <div class="qty-control">
                                <button class="qty-btn" onclick="atualizarQtd(${item.id}, ${item.quantidade - 1})">-</button>
                                <span style="padding:0 10px;font-weight:bold;">${item.quantidade}</span>
                                <button class="qty-btn" onclick="atualizarQtd(${item.id}, ${item.quantidade + 1})">+</button>
                            </div>
                            <button class="btn btn-secondary" style="padding:5px 10px;font-size:12px;" onclick="removerItem(${item.id})">🗑️</button>
                        </div>
                    </div>
                `).join('');
                document.getElementById('carrinhoTotal').textContent = `Total: ${formatarPreco(data.total)}`;
            }
        }

        async function atualizarQtd(itemId, novaQtd) {
            if (novaQtd < 1) return;
            
            const formData = new FormData();
            formData.append('item_id', itemId);
            formData.append('quantidade', novaQtd);
            formData.append('action', 'atualizar_carrinho');
            
            await fetch('../api/produtos_cliente.php', { method: 'POST', body: formData });
            await atualizarCarrinho();
        }

        async function removerItem(itemId) {
            const formData = new FormData();
            formData.append('item_id', itemId);
            formData.append('action', 'remover_carrinho');
            
            const res = await fetch('../api/produtos_cliente.php', { method: 'POST', body: formData });
            const data = await res.json();
            
            if (data.success) {
                await atualizarCarrinho();
            }
        }

        function fecharCarrinho() {
            document.getElementById('carrinhoModal').classList.remove('active');
        }

        function finalizarCompra() {
            if (carrinho.length === 0) {
                showAlert('Seu carrinho está vazio', 'error');
                return;
            }
            showAlert('Compra finalizada com sucesso! (Funcionalidade de pagamento será implementada)', 'success');
            document.getElementById('carrinhoModal').classList.remove('active');
        }

        function aplicarFiltros() {
            carregarProdutos();
        }

        ['filtroCategoria'].forEach(id => {
            document.getElementById(id).addEventListener('change', aplicarFiltros);
        });

        document.getElementById('filtroBusca').addEventListener('input', function() {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => aplicarFiltros(), 500);
        });

        function formatarPreco(valor) {
            return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(valor);
        }

        function showAlert(message, type) {
            const container = document.getElementById('alertContainer');
            container.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
            setTimeout(() => container.innerHTML = '', 5000);
        }
    </script>
</body>
</html>