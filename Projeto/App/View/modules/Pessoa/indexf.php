<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./main.css">
</head>

<body class="font-sans">
    <header class="bg-dark text-light">
        <nav class="container d-flex justify-content-between align-items-center py-2">
            <a href="#" class="navbar-brand"><img src="./log1.png" alt="Logo"></a>
            <ul class="nav">
                <li class="nav-item"><a href="#opcao1" class="nav-link text-light"
                        onclick="showSection('form-container')">Cadastrar pacientes</a></li>
                <li class="nav-item"><a href="#opcao2" class="nav-link text-light"
                        onclick="showSection('history-container')">Checar histórico</a></li>
            </ul>
        </nav>
    </header>

    <main class="container flex-grow-1">
        <section id="form-container" class="form-container active">
            <form action="" method="post" class="p-4 border rounded shadow bg-white mt-4" enctype="multipart/form-data">
                <h2 class="mb-4">Formulário de Cadastro de pacientes</h2>
                <div class="form-row mb-3">
                    <div class="form-group col-md-6">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" name="nome" required id="nome" placeholder="Nome">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sobrenome">Sobrenome</label>
                        <input type="text" class="form-control" name="sobrenome" id="sobrenome" placeholder="Sobrenome">
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="form-group col-md-6">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control" name="cpf" id="cpf" placeholder="CPF">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cep">CEP</label>
                        <input type="text" class="form-control" name="cep" id="cep" placeholder="CEP">
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="form-group col-md-4">
                        <label for="estado">Estado</label>
                        <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="rua">Rua</label>
                        <input type="text" class="form-control" name="rua" id="rua" placeholder="Rua">
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="form-group col-md-6">
                        <label for="numero">Número</label>
                        <input type="text" class="form-control" name="numero" id="numero" placeholder="Número">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="planoSaude">Plano de Saúde</label>
                        <select class="form-control" name="planoSaude" id="planoSaude">
                            <option value="" selected disabled>Selecione o Plano de Saúde</option>
                            <option value="sulamerica">SulAmérica Saúde</option>
                            <option value="amil">Amil</option>
                            <option value="bradesco">Bradesco Saúde</option>
                            <option value="unimed">Unimed</option>
                            <option value="goldencross">Golden Cross</option>
                        </select>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="form-group col-md-6">
                        <label for="tipoPessoa">Tipo de Usuário</label>
                        <select class="form-control" name="tipoPessoa" id="tipoPessoa">
                            <option value="" selected disabled>Selecione a Situação</option>
                            <option value="dependente">Dependente</option>
                            <option value="pessoa">Pessoa</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="imagem">Foto do Paciente</label>
                        <input type="file" class="form-control" name="imagem" id="imagem">
                    </div>
                </div>
                <div class="form-row">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </section>

        <section id="history-container" class="history-container">
            <div class="p-4 border rounded shadow bg-white mt-4 text-center">
                <h2 class="mb-4">Histórico de Pacientes</h2>
                <p>Digite o CPF do paciente para buscar o histórico.</p>
                <input type="text" class="form-control mb-3" placeholder="CPF">
                <button class="btn btn-primary">Buscar</button>
            </div>
        </section>
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

$uploadDir = "C:/xampp/htdocs/testeimg/";

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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagem"])) {
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $cpf = $_POST["cpf"];
    $cep = $_POST["cep"];
    $plano = $_POST["planoSaude"];
    $tipo_usuario = $_POST["tipoPessoa"];
    $estado = $_POST["estado"];
    $cidade = $_POST["cidade"];
    $rua = $_POST["rua"];
    $numero = $_POST["numero"];
    $imagem = $uploadDir . basename($_FILES["imagem"]["name"]);
    $senha_gerada = bin2hex(random_bytes(4)); 

    $mysqli = new mysqli("localhost", "root", "", "dbclinicapi");

    $sql_verificar = "SELECT id FROM pacientes WHERE cpf = '$cpf'";
    $result_verificar = $mysqli->query($sql_verificar);
    if ($result_verificar && $result_verificar->num_rows > 0) {
        echo "Este paciente já está cadastrado.";
    } else {
        $permitidos = array('png', 'jpg', 'jpeg');
        $extensao = strtolower(pathinfo($imagem, PATHINFO_EXTENSION));
        if (in_array($extensao, $permitidos)) {
            if ($_FILES["imagem"]["size"] > 500000) {
                echo "Tamanho da imagem é muito grande. Por favor, escolha uma imagem menor.";
            } else {
                $uploadFile = $uploadDir . basename($_FILES["imagem"]["name"]);
                if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $uploadFile)) {
                    $cep_data = consultarCEP($cep);
                    if ($cep_data) {
                        $estado = $cep_data['uf'];
                        $cidade = $cep_data['localidade'];
                        $rua = $cep_data['logradouro'];
                    } else {
                        echo "Erro ao consultar o CEP.";
                    }

                    $sql = "INSERT INTO pacientes (nome, sobrenome, cpf, cep, estado, cidade, rua, numero, plano, tipo_usuario, imagem, senha_gerada) VALUES ('$nome', '$sobrenome', '$cpf', '$cep', '$estado', '$cidade', '$rua', '$numero', '$plano', '$tipo_usuario', '$imagem', '$senha_gerada')";
                    if ($mysqli->query($sql) === TRUE) {
                        echo "<script>alert('Paciente cadastrado com sucesso!\\nCPF: $cpf\\nSenha: $senha_gerada');</script>";
                    } else {
                        echo "Erro ao adicionar o paciente: " . $mysqli->error;
                    }
                } else {
                    echo "Erro ao mover o arquivo de imagem.";
                }
            }
        } else {
            echo "Formato de arquivo não suportado. Por favor, envie uma imagem no formato PNG, JPG ou JPEG.";
        }
    }
}
?>
