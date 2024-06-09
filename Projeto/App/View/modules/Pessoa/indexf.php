<?php

if (strpos($_SERVER['PHP_SELF'], basename(__FILE__)) !== false) {
    // Redireciona para a página inicial
    header("Location: /");
    exit();
}

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

<body class="font-sans">
    <header class="bg-dark text-light">
        <nav class="container d-flex justify-content-between align-items-center py-2">
            <a href="#" class="navbar-brand"><img src="App/View/modules/img/log1.png" alt="Logo"></a>
            <ul class="nav">
                <li class="nav-item"><a href="#opcao1" class="nav-link text-light" onclick="showSection('form-container')">Cadastrar pacientes</a></li>
                <li class="nav-item"><a href="#opcao2" class="nav-link text-light" onclick="showSection('history-container')">Checar histórico</a></li>
            </ul>
        </nav>
    </header>



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
    <div class="link-container">
        <a href="/pessoa/form" class="box1">
            <i class="fas fa-comments"></i>
            <h2>Cadastrar Paciente</h2>
        </a>


        <a href="/logout" class="box1">
            <i class="fas fa-history"></i>
            <h2>logout</h2>

        </a>
    </div>
    </main>

    <footer class="bg-dark text-light py-4 footer">
        <div class="container text-center">
            <h2 class="text-xl font-bold mb-4">I9 Solution, <br>Inspirando Saúde</h2>
            <p>A Plataforma I9 Solution é uma solução digital que visa melhorar a gestão de tratamentos medicamentosos,
                facilitando a comunicação entre pacientes e médicos. Com lembretes personalizados, registro de efeitos
                colaterais e comunicação direta, busca-se aumentar a adesão ao tratamento e proporcionar um cuidado mais
                eficaz e personalizado.</p>
            <p>O acesso seguro e a integração com sistemas de saúde existentes garantem a confidencialidade e a
                eficiência do processo.</p>
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

        // Função para preencher os campos de endereço ao preencher o CEP
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