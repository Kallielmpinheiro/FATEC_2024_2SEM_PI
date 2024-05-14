<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Médico</title>
    <!-- Links para folhas de estilo CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Links para ícones -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- CSS para imagem de fundo -->
    <style>
        body {
            background-image: url('..//SitePI/img/pic4.jpg'); /* Substitua 'caminho/para/sua/imagem.jpg' pelo caminho da sua imagem */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh; 
        }
    </style>
</head>
<body>
    <!-- Barra de navegação -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#pacientes">Pacientes</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#medicamentos">Medicamentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#receitas">Receitas</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Conteúdo do dashboard -->
    <div class="container mt-4">
        <!-- Seção de Medicamentos -->
        <section id="pacientes">
            <!-- Conteúdo do HTML para Medicamentos -->
            <h2>Pacientes</h2>
            <!-- Insira aqui o conteúdo HTML da seção de Medicamentos -->
            <!-- Exemplo: -->
            <iframe src="pacientes.html" style="width: 100%; height: 600px; border: none;"></iframe>
        </section>

        <!-- Seção de Pacientes -->
        <section id="Medicamentos" class="mt-5">
            <!-- Conteúdo do HTML para Pacientes -->
            <h2>Medicamentos</h2>
            <!-- Insira aqui o conteúdo HTML da seção de Pacientes -->
            <!-- Exemplo: -->
            <iframe src="medicamentos.html" style="width: 100%; height: 600px; border: none;"></iframe>
        </section>

        <!-- Seção de Receitas -->
        <section id="receitas" class="mt-5">
            <!-- Conteúdo do HTML para Receitas -->
            <h2>Receitas</h2>
            <!-- Insira aqui o conteúdo HTML da seção de Receitas -->
            <!-- Exemplo: -->
            <iframe src="receita.html" style="width: 100%; height: 600px; border: none;"></iframe>
        </section>
    </div>

    <!-- Scripts JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
