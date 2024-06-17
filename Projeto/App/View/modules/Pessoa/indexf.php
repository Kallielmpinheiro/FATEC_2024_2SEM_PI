<?php

if (strpos($_SERVER['PHP_SELF'], basename(__FILE__)) !== false) {
    // Redireciona para a página inicial
    header("Location: /");
    exit();
}

require_once 'App/Service/Auth.php';
Auth::validador();
$nomeUsuario = isset($_SESSION["user_nome"]) ? $_SESSION["user_nome"] : "Usuário";


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="App/View/modules/css/main.css">
</head>

<style>
    .bg-custom {
        background-color: #2e6476;
        color: white;
        /* Define o texto como branco */
    }

    /* Estilo específico para o footer */
    footer.bg-custom {
        background-color: #2e6476;
        color: white;
        /* Define o texto como branco */
    }
</style>

<body class="font-sans">
    <header class="bg-custom text-light">
        <nav class="container d-flex justify-content-between align-items-center py-2">
            <a href="#" class="navbar-brand"><img src="App/View/modules/img/log1.png" alt="Logo"></a>
            <ul class="nav">
                <li class="nav-item"><a href="/pessoa/form" class="nav-link text-light" onclick="showSection('form-container')">Cadastrar pacientes</a></li>
                <li class="nav-item"><a href="/logout" class="nav-link text-light" onclick="showSection('history-container')">Logout</a></li>
            </ul>
        </nav>
    </header>


    <main class="main">
        <section id="form-container" class="form-container active">
            <h3>Bem-vindo, <?= htmlspecialchars($nomeUsuario) ?>!</h3>

        </section>

        <section id="history-container" class="history-container">
            <form action="/ConsultarPaciente" method="post">
                <div class="p-4 border rounded shadow bg-white mt-4 text-center">
                    <h2 class="mb-4">Histórico de Pacientes</h2>
                    <p>Digite o CPF do paciente para buscar o histórico.</p>
                    <input type="text" class="form-control mb-3" placeholder="CPF" name="cpf">
                    <button class="btn btn-primary">Buscar</button>
                </div>
            </form>
        </section>
    </main>

    <footer class="bg-custom text-light py-4 footer" style="background-color: #2e6476;">
        <div class="container text-center">
            <div class="mt-4 text-sm">
                <p>&copy; 2024 I9 Solution. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function showSection(sectionId) {
            document.querySelectorAll('.form-container, .history-container').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(sectionId).classList.add('active');
        }

        // Redireciona para a seção de cadastro por padrão
        document.addEventListener('DOMContentLoaded', () => {
            showSection('form-container');
        });

        // Função para consultar CEP
        document.getElementById('cep').addEventListener('blur', function() {
            var cep = this.value.replace(/\D/g, '');
            if (cep.length != 8) {
                return;
            }
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'https://viacep.com.br/ws/' + cep + '/json/');
            xhr.onload = function() {
                var data = JSON.parse(xhr.responseText);
                if (!data.erro) {
                    document.getElementById('estado').value = data.uf;
                    document.getElementById('cidade').value = data.localidade;
                    document.getElementById('rua').value = data.logradouro;
                }
            };
            xhr.send();
        });
    </script>
</body>

</html>

<?php


function consultarCEP($cep)
{
    $cep = preg_replace('/[^0-9]/', '', $cep);
    if (strlen($cep) != 8) {
        return false;
    }
    $url = "https://viacep.com.br/ws/{$cep}/json/";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    if ($response === false) {
        return false;
    }

    curl_close($curl);

    $data = json_decode($response, true);

    return $data;
}
?>