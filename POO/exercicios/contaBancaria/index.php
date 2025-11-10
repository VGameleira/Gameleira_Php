<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Define a codificação de caracteres para UTF-8 (suporta acentuação) -->
    <meta charset="UTF-8">
    
    <!-- Torna o site responsivo em dispositivos móveis -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Título que aparece na aba do navegador -->
    <title>Sistema Bancário - Página Inicial</title>
    
    <!-- Link para o arquivo CSS que contém os estilos da página -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Cabeçalho da página -->
    <header>
        <h1>Bem-vindo ao Sistema Bancário</h1>
        <p>Gerencie suas contas de forma simples e segura</p>
    </header>

    <!-- 
        Menu de navegação 
        CORREÇÃO: Agora os links apontam para os nomes corretos dos arquivos
        (com a primeira letra maiúscula, como estão salvos)
    -->
    <nav>
        <!-- Link para a página de Conta Corrente -->
        <a href="ContaCorrente.php">Conta Corrente</a>
        
        <!-- Link para a página de Poupança -->
        <a href="ContaPoupanca.php">Poupança</a>
    </nav>

    <!-- Container principal com o conteúdo da página -->
    <div class="container">
        <h2>Escolha uma das opções acima para acessar sua conta</h2>
        
        <!-- Informações adicionais para orientar o usuário -->
        <div style="margin-top: 20px; padding: 15px; background-color: #f9f9f9; border-radius: 5px;">
            <h3>Funcionalidades disponíveis:</h3>
            <ul style="text-align: left; display: inline-block;">
                <li><strong>Conta Corrente:</strong> Realize depósitos, saques e utilize o limite especial</li>
                <li><strong>Conta Poupança:</strong> Realize depósitos, saques e aplique rendimentos</li>
            </ul>
        </div>
    </div>

</body>
</html>