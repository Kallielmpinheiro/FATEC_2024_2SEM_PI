<?php

// Verifica se a URL acessada contém o nome do arquivo PHP atual
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
    <link rel="icon" href="img/log1.png" type="image/x-icons">
    <title>Dashboard Médico</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="App/View/modules/css/medico.css">
    <!-- Inclua outros estilos CSS aqui -->
    <style>
        /* Adicione estilos personalizados aqui */
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <h2 class="logo-nombre">
        </div>
    </header>

    <div class="container">
        <!-- Abas ou seções do dashboard -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pacientes-tab" data-toggle="tab" href="#pacientes" role="tab" aria-controls="pacientes" aria-selected="true">Registros Pacientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="medicamentos-tab" data-toggle="tab" href="#medicamentos" role="tab" aria-controls="medicamentos" aria-selected="false">Medicamentos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="receita-tab" data-toggle="tab" href="#receita" role="tab" aria-controls="receita" aria-selected="false">Receita Médica</a>
            </li>
            <li class="nav-item">
                <a href="/medicamento/formConsulta" class="nav-link" id="receita-tab" aria-controls="receita" aria-selected="false">Consultar Prescrição</a>
            </li>
            <li class="nav-item">
                <a href="/logout" class="nav-link" id="receita-tab" aria-controls="receita" aria-selected="false">Logout</a>
            </li>



        </ul>

        <div class="tab-content" id="myTabContent">
            <!-- Seção de Pacientes -->
            <div class="tab-pane fade show active" id="pacientes" role="tabpanel" aria-labelledby="pacientes-tab">
                <!-- Conteúdo do CRUD de Pacientes -->
                <!-- Copie e cole o HTML do CRUD de Pacientes aqui -->
                <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/log1.png" type="image/x-icons">
    <title>Pacientes</title>
    <link rel="stylesheet" href="App/View/modules/css/opcpacientes.css">
</head>
<body>
    <header>
        <div class="logo">
            <h2 class="logo-nombre">
        </div>
    </header>
    
    <!-- Crud -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fim do Crud -->

    <!-- Crud -->
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2><b></b></h2>
                        </div>
                       
                    </div>
                </div>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Sobrenome</th>
                            <th>CPF</th>
                            <th>CEP</th>
                            <th>Estado</th>
                            <th>Cidade</th>
                            <th>Rua</th>
                            <th>Número</th>
                            <th>Tipo</th>
                            <th>Plano</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php foreach($model->rows as $item): ?>
                            <tr>
                                <td><a href="/pessoa/form?id=<?= $item->idPaciente ?>"> <?= $item->nome ?></td>
                                <td><?= $item->sobrenome ?></td>
                                <td><?= $item->cpf ?></td>
                                <td><?= $item->cep ?></td>
                                <td><?= $item->estado ?></td>
                                <td><?= $item->cidade ?></td>
                                <td><?= $item->rua ?></td>
                                <td><?= $item->numero ?></td>
                                <td><?= $item->tipoPessoa ?></td>
                                <td><?= $item->PlanoSaude ?></td>
                        <?php endforeach ?>
                        </tr>
                        <table>
        <tr>
            <th></th>
          
        </tr>
    </table>
                        <!-- Aqui vão os outros registros -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Fim do Crud -->

    <!-- Modais do Crud -->
    <div id="addEmployeeModal" class="modal fade">
        <!-- Conteúdo do modal -->
    </div>

    <div id="editEmployeeModal" class="modal fade">
        <!-- Conteúdo do modal -->
    </div>

    <div id="deleteEmployeeModal" class="modal fade">
        <!-- Conteúdo do modal -->
    </div>
    <!-- Fim dos Modais do Crud -->

    <!-- Scripts do Crud -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- Fim dos Scripts do Crud -->

    <script src="js/main.js"></script>
</body>
</html>
            </div>

            <!-- Seção de Medicamentos -->
            <div class="tab-pane fade" id="medicamentos" role="tabpanel" aria-labelledby="medicamentos-tab">
                <!-- Conteúdo do CRUD de Medicamentos -->
                <!-- Copie e cole o HTML do CRUD de Medicamentos aqui -->
                <!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" href="img/log1.png" type="image/x-icons">
<title>Medicamentos</title>
<header>
    <div class="logo">
    <h2 class="logo-nome"></h2>
    </div>
</header>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
  
</style>
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>
</head>
<body>
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2> <b></b></h2></div>
                    <div class="col-sm-4">
                        <div class="search-box">
                            <i class="material-icons">&#xE8B6;</i>
                            <input type="text" class="form-control" placeholder="Buscar&hellip;">
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                  
                        <th>Nome Medicamento</th>
                        <th>Fabricante</th>
                        <th>Tipo</th>
                        <th>Uso</th>
      
                    </tr>
                </thead>
                <tbody>
                <?php
                    if(isset($modelM) && $modelM !== null && property_exists($modelM, 'rows') && is_array($modelM->rows)) {
                        foreach($modelM->rows as $item): ?>
                            <tr>
                                <td><?= $item->nomeMedicamento ?></td>
                                <td><?= $item->fabricante ?></td>
                                <td><?= $item->tipo ?></td>
                                <td><?= $item->uso ?></td>
                            </tr>
                        <?php endforeach;
                        } else {
                            echo 'Nenhum medicamento cadastrado';
                        }
                        ?>
                
                    </tr>        
                </tbody>
            </table>
        </div>
    </div>  
</div>   
</body>
</html>

                
            </div>

            <!-- Seção de Receita Médica -->
            <div class="tab-pane fade" id="receita" role="tabpanel" aria-labelledby="receita-tab">
                <!-- Conteúdo do Formulário de Receita Médica -->
                <!-- Copie e cole o HTML do Formulário de Receita Médica aqui -->
                <!DOCTYPE html>
<head>
    <!-- Definição do título da página -->
    <title>Receita Médica</title>
    <!-- Inclusão do arquivo de estilo CSS -->
    <link rel="stylesheet" href="../css/receita.css">
</head>

<body>
    <header>
        <!-- Cabeçalho da página (possivelmente poderia conter o logotipo ou título adicional) -->
    </header>

    <!-- Tabela contendo o formulário de receita médica e a lista de receitas -->
    <table>
        <tr>
            <td>
                <!-- Formulário de receita médica -->
                <div class="col-sm-6">
                    <h2>Prescrição Médica</h2>
                </div>
                <form action="/prescricao/form/save" method="post" onsubmit="onFormSubmit()">
                    <!-- Campo para inserir o nome do paciente -->
                    <div>
                        <label for="product">CPF</label>
                        <input type="varchar" id="cpf" name="cpf" required>
                    </div>
                    <!-- Campo para inserir o medicamento -->
                    <div>
                        <label for="product">Código Medicamento</label>
                        <input type="number" id="id_medicamentosconsulta" name="id_medicamentosconsulta" required>
                    </div>
                    <!-- Campo para inserir a quantidade do medicamento -->
                    <div>
                        <label for="qty">Duração(dias)</label>
                        <input type="number" id="duracao" name="duracao" required>
                    </div>
                    <!-- Campo para inserir as indicações -->
                    <div>
                        <label for="product">Dosagem</label>
                        <input type="dosagem" id="dosagem" name="dosagem" required>
                    </div>
                    <!-- Campo para inserir a duração do tratamento -->
                    <div>
                        <label for="product1">Instrução</label>
                        <input type="text" id="instrucao" name="instrucao" required>
                    </div>
                    <!-- Campo para inserir o médico prescritor -->
                    <div>
                        <label for="product">CRM</label>
                        <input type="text" id="CRM" name="CRM" required>
                    </div>

                    <!-- Botões de ação do formulário -->
                    <div class="form_action--button">
                        <input type="submit" value="Receitar">
                        <input type="reset" value="Reiniciar">
                    </div>
                </form>
            </td>
           
                    <!-- Corpo da tabela de lista de receitas (a ser preenchido dinamicamente) -->
                  
                </table>
            </td>
        </tr>
    </table>

    <!-- Inclusão do arquivo de script JavaScript -->
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>
            </div>
        </div>
    </div>

    <!-- Scripts JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- Adicione outros scripts JavaScript aqui -->


    
</body>

</html>

