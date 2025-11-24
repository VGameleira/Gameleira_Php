<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Integrado de Gestão</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🏢 Sistema Integrado de Gestão</h1>
            <p>Gerencie Clientes, Produtos e Imóveis em um só lugar</p>
        </header>

        <div class="tabs">
            <button class="tab-button active" onclick="showTab('clientes', event)">
                👥 Clientes
            </button>
            <button class="tab-button" onclick="showTab('produtos', event)">
                📦 Produtos
            </button>
            <button class="tab-button" onclick="showTab('imoveis', event)">
                🏠 Imóveis
            </button>
        </div>

        {/* <!-- TAB CLIENTES --> */}
        <div id="clientes" class="tab-content active">
            <div class="system-container">
                <div class="system-header">
                    <div class="icon">👥</div>
                    <h2>Sistema de Clientes</h2>
                    <p>Cadastre e gerencie seus clientes</p>
                </div>

                <form id="formClientes">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nome *</label>
                            <input type="text" name="nome" required placeholder="Nome completo">
                        </div>
                        <div class="form-group">
                            <label>Endereço</label>
                            <input type="text" name="endereco" placeholder="Rua, número">
                        </div>
                        <div class="form-group">
                            <label>Cidade</label>
                            <input type="text" name="cidade" placeholder="Cidade">
                        </div>
                        <div class="form-group">
                            <label>Bairro</label>
                            <input type="text" name="bairro" placeholder="Bairro">
                        </div>
                        <div class="form-group">
                            <label>Produto</label>
                            <input type="text" name="produto" placeholder="Produto de interesse">
                        </div>
                    </div>
                    <button type="submit" class="btn-submit">✅ Cadastrar Cliente</button>
                </form>

                <div id="alertClientes"></div>

                <div class="table-container">
                    <h3 style="margin-bottom: 20px; color: #667eea;">📋 Clientes Cadastrados</h3>
                    <div class="stats">
                        <div class="stat-card">
                            <h3 id="totalClientes">0</h3>
                            <p>Total de Clientes</p>
                        </div>
                    </div>
                    <div id="tabelaClientes"></div>
                </div>
            </div>
        </div>

        {/* <!-- TAB PRODUTOS --> */}
        <div id="produtos" class="tab-content">
            <div class="system-container">
                <div class="system-header">
                    <div class="icon">📦</div>
                    <h2>Sistema de Produtos</h2>
                    <p>Gerencie seu estoque de produtos</p>
                </div>

                <form id="formProdutos">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nome do Produto *</label>
                            <input type="text" name="nome" required placeholder="Ex: Notebook Dell">
                        </div>
                        <div class="form-group">
                            <label>Preço (R$) *</label>
                            <input type="number" name="preco" step="0.01" min="0" required placeholder="0.00">
                        </div>
                        <div class="form-group">
                            <label>Quantidade *</label>
                            <input type="number" name="quantidade" min="0" required placeholder="0">
                        </div>
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label>Descrição</label>
                            <textarea name="descricao" placeholder="Descreva as características do produto..."></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit">✅ Cadastrar Produto</button>
                </form>

                <div id="alertProdutos"></div>

                <div class="table-container">
                    <h3 style="margin-bottom: 20px; color: #667eea;">📋 Produtos Cadastrados</h3>
                    <div class="stats">
                        <div class="stat-card">
                            <h3 id="totalProdutos">0</h3>
                            <p>Total de Produtos</p>
                        </div>
                        <div class="stat-card">
                            <h3 id="totalEstoque">0</h3>
                            <p>Itens em Estoque</p>
                        </div>
                    </div>
                    <div id="tabelaProdutos"></div>
                </div>
            </div>
        </div>

        {/* <!-- TAB IMÓVEIS --> */}
        <div id="imoveis" class="tab-content">
            <div class="system-container">
                <div class="system-header">
                    <div class="icon">🏠</div>
                    <h2>Sistema Imobiliário</h2>
                    <p>Cadastre e divulgue imóveis</p>
                </div>

                <form id="formImoveis">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Tipo de Imóvel *</label>
                            <select name="tipo" required>
                                <option value="">Selecione...</option>
                                <option value="Casa">Casa</option>
                                <option value="Apartamento">Apartamento</option>
                                <option value="Terreno">Terreno</option>
                                <option value="Kitnet">Kitnet</option>
                                <option value="Sobrado">Sobrado</option>
                                <option value="Chácara">Chácara</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Finalidade *</label>
                            <select name="finalidade" required>
                                <option value="Venda">Venda</option>
                                <option value="Aluguel">Aluguel</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Localização *</label>
                            <input type="text" name="localizacao" required placeholder="Endereço completo">
                        </div>
                        <div class="form-group">
                            <label>Preço (R$) *</label>
                            <input type="number" name="preco" step="0.01" min="0" required placeholder="0.00">
                        </div>
                        <div class="form-group">
                            <label>Área Construída (m²)</label>
                            <input type="number" name="area_cons" min="0" placeholder="0">
                        </div>
                        <div class="form-group">
                            <label>Área do Terreno (m²)</label>
                            <input type="number" name="area_terreno" min="0" placeholder="0">
                        </div>
                        <div class="form-group">
                            <label>Quartos</label>
                            <input type="number" name="qtd_quarto" min="0" placeholder="0">
                        </div>
                        <div class="form-group">
                            <label>Banheiros</label>
                            <input type="number" name="qtd_banheiro" min="0" placeholder="0">
                        </div>
                        <div class="form-group">
                            <label>Vagas de Garagem</label>
                            <input type="number" name="qtd_vaga" min="0" placeholder="0">
                        </div>
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label>Descrição</label>
                            <textarea name="descricao" placeholder="Descreva o imóvel em detalhes..."></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit">✅ Cadastrar Imóvel</button>
                </form>

                <div id="alertImoveis"></div>

                <div class="table-container">
                    <h3 style="margin-bottom: 20px; color: #667eea;">📋 Imóveis Cadastrados</h3>
                    <div class="stats">
                        <div class="stat-card">
                            <h3 id="totalImoveis">0</h3>
                            <p>Total de Imóveis</p>
                        </div>
                    </div>
                    <div id="tabelaImoveis"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/app.js"></script>
    <script src="../assets/js/clientes.js"></script>
    <script src="../assets/js/produtos.js"></script>
    <script src="../assets/js/imoveis.js"></script>
</body>
</html>
