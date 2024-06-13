<?php
require_once 'App/Model/PessoaModel.php';
$model = new PessoaModel();
$senhaGerada = $model->gerarSenha();

if (strpos($_SERVER['PHP_SELF'], basename(__FILE__)) !== false) {
    // Redireciona para a página inicial
    header("Location: /");
    exit();
}



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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/formpaciente.css">
    <script>
        function mostrarAlerta(valor) {
            alert("Senha gerada: " + valor);
        }
    </script>
</head>

<body>
    <div class="container">
        <form action="/pessoa/form/save" method="post"  class="p-4 border rounded shadow" enctype="multipart/form-data">
            <h2 class="mb-4">Formulário de Cadastro</h2>
            <div class="row">
                <div class="col-md-6 mb-3">
                 <input type="hidden" value = "<?= $model->idPaciente ?>" name = "idPaciente" />  

                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="nome" required id="nome"  value="<?= $model->nome ?>" >
                </div>
                <div class="col-md-6 mb-3">
                    <label for="sobrenome" class="form-label">Sobrenome</label>
                    <input type="text" class="form-control" name="sobrenome" id="sobrenome" placeholder="Sobrenome" required  value="<?= $model->sobrenome ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" name="cpf" id="cpf" value="<?= $model->cpf ?>" placeholder="CPF" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control" name="cep" id="cep" placeholder="CEP" required  value="<?= $model->cep ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado"  value="<?= $model->estado ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade"   value="<?= $model->cidade ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="rua" class="form-label">Rua</label>
                    <input type="text" class="form-control" name="rua" id="rua" placeholder="rua"  value="<?= $model->rua ?>" required>
                </div>
                <div>
                <!-- Adicionando campo oculto para a senha gerada -->
                <input type="hidden" name="senhaGerada" value="<?= $senhaGerada ?>">
            </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" class="form-control" name="numero" id="numero" placeholder="Número" required  value="<?= $model->numero ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="plano" class="form-label">Plano de Saúde</label>
                    <select class="form-select" name="planoSaude" id="planoSaude" required>
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
                    <label for="tipoPessoa" class="form-label">Tipo de Pessoa</label>
                    <select class="form-select" name="tipoPessoa" id="tipoPessoa" required>
                        <option value="" selected disabled>Selecione a Situação</option>
                        <option value="dependente">Dependente</option>
                        <option value="pessoa">Pessoa</option>
                    </select>
                </div>


                <div class="form-group col-md-4">
                        <label for="rua">CRM</label>
                        <input type="number" class="form-control" name="CRM" id="CRM" placeholder="CRM" required>
                    </div>
                <?php 
               
                ?>
                
            </div>
            <div class="btn-container">
                <button type="submit" class="btn btn-primary" onclick="mostrarAlerta('<?php echo $senhaGerada; ?>')">Cadastrar</button>
                <a href="/telaF" class="btn btn-secondary" >Voltar</a>
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