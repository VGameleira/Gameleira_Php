<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Imóveis - Sistema</title>
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
            text-align: center;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            color: #667eea;
            font-size: 2em;
        }

        .user-info {
            display: flex;
            gap: 15px;
            align-items: center;
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
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
        }

        /* Modal de Login/Registro */
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
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 40px;
            border-radius: 15px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
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

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
        }

        .form-group input:focus {
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

        /* Filtros */
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

        /* Cards de Imóveis */
        .imoveis-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }

        .imovel-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }

        .imovel-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
        }

        .imovel-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
        }

        .imovel-content {
            padding: 20px;
        }

        .imovel-tipo {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .imovel-preco {
            color: #28a745;
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
        }

        .imovel-detalhes {
            display: flex;
            gap: 15px;
            margin: 15px 0;
            color: #666;
            font-size: 14px;
        }

        .imovel-detalhes span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-interesse {
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

        .btn-interesse:hover {
            transform: translateY(-2px);
        }

        .btn-interesse.interessado {
            background: #dc3545;
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
            <h1>🏠 Imóveis Disponíveis</h1>
            <div class="user-info">
                <span id="welcomeText">Bem-vindo!</span>
                <button class="btn" id="btnMeusInteresses" style="display:none;">Meus Interesses</button>
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

                <!-- Form de Login -->
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

                <!-- Form de Cadastro -->
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

        <!-- Filtros -->
        <div class="filters">
            <h3>🔍 Filtrar Imóveis</h3>
            <div class="filter-grid">
                <div class="form-group">
                    <label>Tipo</label>
                    <select id="filtroTipo">
                        <option value="">Todos</option>
                        <option value="Casa">Casa</option>
                        <option value="Apartamento">Apartamento</option>
                        <option value="Terreno">Terreno</option>
                        <option value="Kitnet">Kitnet</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Finalidade</label>
                    <select id="filtroFinalidade">
                        <option value="">Todas</option>
                        <option value="Venda">Venda</option>
                        <option value="Aluguel">Aluguel</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Preço Mínimo</label>
                    <input type="number" id="filtroPrecoMin" value="0" min="0">
                </div>
                <div class="form-group">
                    <label>Preço Máximo</label>
                    <input type="number" id="filtroPrecoMax" value="1000000" min="0">
                </div>
                <div class="form-group">
                    <label>Quartos (mín)</label>
                    <select id="filtroQuartos">
                        <option value="0">Qualquer</option>
                        <option value="1">1+</option>
                        <option value="2">2+</option>
                        <option value="3">3+</option>
                        <option value="4">4+</option>
                    </select>
                </div>
            </div>
            <button class="btn" onclick="aplicarFiltros()" style="width:100%;">Aplicar Filtros</button>
        </div>

        <!-- Grid de Imóveis -->
        <div class="imoveis-grid" id="imoveisGrid"></div>
    </div>

    <script>
        let clienteLogado = false;
        let clienteNome = '';

        // Verificar sessão ao carregar
        window.addEventListener('DOMContentLoaded', async function() {
            await verificarSessao();
            await carregarImoveis();
        });

        async function verificarSessao() {
            const res = await fetch('../api/auth.php?sistema=imoveis&action=check');
            const data = await res.json();
            
            if (data.logged_in) {
                clienteLogado = true;
                clienteNome = data.cliente_nome;
                document.getElementById('welcomeText').textContent = `Olá, ${clienteNome}!`;
                document.getElementById('btnLogin').style.display = 'none';
                document.getElementById('btnLogout').style.display = 'block';
                document.getElementById('btnMeusInteresses').style.display = 'block';
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

        // Login
        document.getElementById('formLogin').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            formData.append('action', 'login');
            
            const res = await fetch('../api/auth.php?sistema=imoveis', {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            
            showAlert(data.message, data.success ? 'success' : 'error');
            
            if (data.success) {
                document.getElementById('authModal').classList.remove('active');
                await verificarSessao();
                await carregarImoveis();
            }
        });

        // Registro
        document.getElementById('formRegister').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            formData.append('action', 'register');
            
            const res = await fetch('../api/auth.php?sistema=imoveis', {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            
            showAlert(data.message, data.success ? 'success' : 'error');
            
            if (data.success) {
                document.getElementById('authModal').classList.remove('active');
                await verificarSessao();
                await carregarImoveis();
            }
        });

        // Logout
        document.getElementById('btnLogout').addEventListener('click', async function() {
            const formData = new FormData();
            formData.append('action', 'logout');
            
            await fetch('../api/auth.php?sistema=imoveis', {
                method: 'POST',
                body: formData
            });
            
            location.reload();
        });

        document.getElementById('btnLogin').addEventListener('click', function() {
            document.getElementById('authModal').classList.add('active');
        });

        document.getElementById('authModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('active');
            }
        });

        async function carregarImoveis() {
            const tipo = document.getElementById('filtroTipo').value;
            const finalidade = document.getElementById('filtroFinalidade').value;
            const precoMin = document.getElementById('filtroPrecoMin').value;
            const precoMax = document.getElementById('filtroPrecoMax').value;
            const quartos = document.getElementById('filtroQuartos').value;
            
            const url = clienteLogado 
                ? `../api/imoveis_cliente.php?tipo=${tipo}&finalidade=${finalidade}&preco_min=${precoMin}&preco_max=${precoMax}&quartos=${quartos}`
                : `../api/imoveis_cliente.php?tipo=${tipo}&finalidade=${finalidade}&preco_min=${precoMin}&preco_max=${precoMax}&quartos=${quartos}`;
            
            const res = await fetch(url);
            const data = await res.json();
            
            if (!data.success && !clienteLogado) {
                document.getElementById('imoveisGrid').innerHTML = `
                    <div class="empty-state" style="grid-column: 1/-1;">
                        <div class="icon">🔒</div>
                        <h2>Faça login para ver os imóveis disponíveis</h2>
                        <button class="btn" onclick="document.getElementById('authModal').classList.add('active')" style="margin-top:20px;">
                            Fazer Login
                        </button>
                    </div>
                `;
                return;
            }
            
            renderImoveis(data.data || []);
        }

        function renderImoveis(imoveis) {
            const grid = document.getElementById('imoveisGrid');
            
            if (imoveis.length === 0) {
                grid.innerHTML = `
                    <div class="empty-state" style="grid-column: 1/-1;">
                        <div class="icon">🏚️</div>
                        <p>Nenhum imóvel encontrado com os filtros selecionados</p>
                    </div>
                `;
                return;
            }
            
            grid.innerHTML = imoveis.map(i => `
                <div class="imovel-card">
                    <div class="imovel-image">🏠</div>
                    <div class="imovel-content">
                        <span class="imovel-tipo">${i.tipo} - ${i.finalidade}</span>
                        <h3>${i.localizacao}</h3>
                        <div class="imovel-preco">
                            ${new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(i.preco)}
                        </div>
                        <div class="imovel-detalhes">
                            <span>🛏️ ${i.qtd_quarto}</span>
                            <span>🚿 ${i.qtd_banheiro}</span>
                            <span>🚗 ${i.qtd_vaga}</span>
                        </div>
                        <p style="color:#666;font-size:14px;margin:10px 0;">
                            ${i.descricao ? i.descricao.substring(0, 100) + '...' : ''}
                        </p>
                        ${clienteLogado ? `
                            <button class="btn-interesse ${i.interessado > 0 ? 'interessado' : ''}" 
                                    onclick="toggleInteresse(${i.id}, ${i.interessado > 0})">
                                ${i.interessado > 0 ? '❌ Remover Interesse' : '❤️ Tenho Interesse'}
                            </button>
                        ` : ''}
                    </div>
                </div>
            `).join('');
        }

        async function toggleInteresse(imovelId, jaInteressado) {
            if (!clienteLogado) {
                showAlert('Faça login para demonstrar interesse', 'error');
                return;
            }
            
            const formData = new FormData();
            formData.append('imovel_id', imovelId);
            formData.append('action', jaInteressado ? 'remover_interesse' : 'interesse');
            
            const res = await fetch('../api/imoveis_cliente.php', {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            
            showAlert(data.message, data.success ? 'success' : 'error');
            
            if (data.success) {
                await carregarImoveis();
            }
        }

        function aplicarFiltros() {
            carregarImoveis();
        }

        // Aplicar filtros ao mudar
        ['filtroTipo', 'filtroFinalidade', 'filtroQuartos'].forEach(id => {
            document.getElementById(id).addEventListener('change', aplicarFiltros);
        });

        function showAlert(message, type) {
            const container = document.getElementById('alertContainer');
            container.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
            setTimeout(() => container.innerHTML = '', 5000);
        }
    </script>
</body>
</html>