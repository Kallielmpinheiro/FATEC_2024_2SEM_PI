<?php

//Caminho onde as imagens serão armazenadas
$uploadDir = "C:/xampp/htdocs/testeimg/";
function consultarCEP($cep)
{
    $cep = preg_replace('/[^0-9]/', '', $cep);
    if (strlen($cep) != 8) {
        return false;
    }
    $url = "https://viacep.com.br/ws/{$cep}/json/";

    // Inicializa a sessão cURL
    $curl = curl_init();

    // Define a URL da requisição cURL
    curl_setopt($curl, CURLOPT_URL, $url);

    // Define que a resposta da requisição deve ser armazenada em uma variável
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Executa a requisição cURL e armazena a resposta
    $response = curl_exec($curl);

    // Verifica se houve erro na requisição
    if ($response === false) {
        return false;
    }

    // Fecha a sessão cURL
    curl_close($curl);

    // Decodifica a resposta JSON para um array associativo
    $data = json_decode($response, true);

    return $data;
}

/*
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagem"])) {

    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $cpf = $_POST["cpf"];
    $cep = $_POST["cep"];
    $plano = $_POST["plano"];
    $tipo_usuario = $_POST["tipo_usuario"];
    $estado = $_POST["estado"];
    $cidade = $_POST["cidade"];
    $rua = $_POST["rua"];
    $numero = $_POST["numero"];
    $imagem = $uploadDir . basename($_FILES["imagem"]["name"]);
    $senha_gerada = gerarSenha(8);

    $sql_verificar = "SELECT id FROM pacientes WHERE cpf = '$cpf'";
    $result_verificar = $mysqli->query($sql_verificar);
    if ($result_verificar && $result_verificar->num_rows > 0) {
        echo "Este paciente já está cadastrado.";
    } else {
        // Verifica se é uma imagem e se o tamanho está dentro do limite
        $permitidos = array('png', 'jpg', 'jpeg');
        $extensao = strtolower(pathinfo($imagem, PATHINFO_EXTENSION));
        if (in_array($extensao, $permitidos)) {
            if ($_FILES["imagem"]["size"] > 500000) {
                echo "Tamanho da imagem é muito grande. Por favor, escolha uma imagem menor.";
            } else {
                // Movendo a imagem para o diretório de upload
                $uploadFile = $uploadDir . basename($_FILES["imagem"]["name"]);
                if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $uploadFile)) {
                    // Consultar CEP e preencher os campos de estado, cidade e rua
                    $cep_data = consultarCEP($cep);
                    if ($cep_data) {
                        $estado = $cep_data['uf'];
                        $cidade = $cep_data['localidade'];
                        $rua = $cep_data['logradouro'];
                    } else {
                        echo "Erro ao consultar o CEP.";
                    }

                    // Inserir dados do paciente no banco de dados
                    $sql = "INSERT INTO pacientes (nome, sobrenome, cpf, cep, estado, cidade, rua, numero, plano, tipo_usuario, imagem, senha_gerada) VALUES ('$nome', '$sobrenome', '$cpf', '$cep', '$estado', '$cidade', '$rua', '$numero', '$plano', '$tipo_usuario', '$imagem', '$senha_gerada')";
                    if ($mysqli->query($sql) === TRUE) {
                        // Alerta mostrando o CPF e a senha gerada
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
*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/formpaciente.css">
</head>

<body>
    <div class="container">
        <form action="/pessoa/form/save" method="post"  class="p-4 border rounded shadow" enctype="multipart/form-data">
            <h2 class="mb-4">Formulário de Cadastro</h2>
            <div class="row">
                <div class="col-md-6 mb-3">
                 <input type="hidden" value = "<?= $model->id ?>" name = "id" />  

                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="nome" required id="nome"  value="<?= $model->nome ?>" >
                </div>
                <div class="col-md-6 mb-3">
                    <label for="sobrenome" class="form-label">Sobrenome</label>
                    <input type="text" class="form-control" name="sobrenome" id="sobrenome" placeholder="Sobrenome">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" name="cpf" value="<?= $model->cpf ?>" placeholder="CPF">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control" name="cep" id="cep" placeholder="CEP">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="rua" class="form-label">Rua</label>
                    <input type="text" class="form-control" name="rua" id="rua" placeholder="rua">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" class="form-control" name="numero" id="numero" placeholder="Número">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="plano" class="form-label">Plano de Saúde</label>
                    <select class="form-select" name="plano" id="plano">
                        <option value="" selected disabled>Selecione o Plano de Saúde</option>
                        <option value="sulamerica">SulAmérica Saúde</option>
                        <option value="amil">Amil</option>
                        <option value="bradesco">Bradesco Saúde</option>
                        <option value="unimed">Unimed</option>
                        <option value="goldencross">Golden Cross</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tipo_usuario" class="form-label">Tipo de Usuário</label>
                    <select class="form-select" name="tipo_usuario" id="tipo_usuario">
                        <option value="" selected disabled>Selecione a Situação</option>
                        <option value="dependente">Dependente</option>
                        <option value="pessoa">Pessoa</option>
                    </select>
                </div>
                <?php 
                /*
                <div class="col-md-6 mb-3">
                    <label for="imagem" class="form-label">Foto do Paciente</label>
                    <input type="file" class="form-control" name="imagem" id="imagem">
                </div>
                */
                ?>
                
            </div>
            <div class="btn-container">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
                <button type="button" class="btn btn-secondary" onclick="window.history.back()">Voltar</button>
            </div>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
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