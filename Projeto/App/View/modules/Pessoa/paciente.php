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
    <link rel="icon" href="img/log1.png" type="image/x-icons">
    <title>Dashboard Paciente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="App/View/modules/css/telapaciente.css">
    <!-- Inclua outros estilos CSS aqui -->
    <style>
        /* Adicione estilos personalizados aqui */
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <h2 class="logo-nombre">Dashboard Paciente</h2>
            <nav class="container d-flex justify-content-between align-items-center py-2">
            <ul class="nav">
                <li class="nav-item"><a href="/AtualizarDadosCadastrais" class="nav-link text-light" onclick="showSection('form-container')">Atualizar Dados</a></li>
            </ul>
        </div>
    </header>

    <div class="container">
        <!-- Abas ou seções do dashboard -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="medicamento-tab" data-toggle="tab" href="#medicamento" role="tab" aria-controls="medicamento" aria-selected="true">Relatório Completo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="alarme-tab" data-toggle="tab" href="#alarme" role="tab" aria-controls="alarme" aria-selected="false">Alarme</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="sintomas-tab" data-toggle="tab" href="#sintomas" role="tab" aria-controls="sintomas" aria-selected="false">Sintomas</a>
            </li>
            <li>
                <a class="btn" id="logout-tab" href="/logout">Logout</a>
            </li>
        </ul>

        <!-- Conteúdo das abas -->
        <div class="tab-content" id="myTabContent">
            <!-- Conteúdo da aba de Medicamento -->
            <div class="tab-pane fade show active" id="medicamento" role="tabpanel" aria-labelledby="medicamento-tab">
                <!-- Adicione o conteúdo aqui -->
                <div class="container-xl">
                    <div class="table-responsive">
                        <div class="table-wrapper">
                            <div class="table-title">
                                <div class="row">
                                    <div class="col-sm-8"><h2><b></b></h2></div>
                                    <div class="col-sm-4">
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Medicamento</th>
                                        <th>tipo <i class="fa fa-sort"></i></th>
                                        <th>uso</th>
                                        <th>dosagem <i class="fa fa-sort"></i></th>
                                        <th>Esquema de tratamento</th>
                                        <th>data_prescrição</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                    if(isset($model) && $model !== null && property_exists($model, 'rows') && is_array($model->rows)) {
                        foreach($model->rows as $item): ?>
                            <tr>
                                <td><?= $item->nomeMedicamento ?></td>
                                <td><?= $item->tipo?></td>
                                <td><?= $item->uso ?></td>
                                <td><?= $item->dosagem ?></td>
                                <td><?= $item->instrucao?></td>
                                <td><?= $item->data_prescricao?></td>
                            </tr>
                        <?php endforeach;
                        } else {
                            echo 'Nenhum medicamento cadastrado';
                        }
                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>  
                </div>  
            </div>

            <!-- Conteúdo da aba de Alarme -->
            <div class="tab-pane fade" id="alarme" role="tabpanel" aria-labelledby="alarme-tab">
                <!-- Adicione o conteúdo aqui -->
                <div class="container">
                    <form id="alarmForm" class="success-alert">
                        <div class="form-group">
                            <label for="medicineName">Nome do Medicamento:</label>
                            <input type="text" id="medicineName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="alarmTime">Horário do Alarme:</label>
                            <input type="time" id="alarmTime" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Adicionar Alarme</button>
                    </form>
                    <div id="alarmList">
                        <!-- Aqui serão listados os alarmes adicionados -->
                    </div>
                </div>
            </div>

            <!-- Conteúdo da aba de Sintomas -->
            <div class="tab-pane fade" id="sintomas" role="tabpanel" aria-labelledby="sintomas-tab">
                <!-- Adicione o conteúdo aqui -->
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            Adicionar Sintoma
                        </div>
                        <div class="card-body">
                            <form id="addSymptomForm" action="/paciente" method="post" class="success-alert">
                                <div class="form-group">
                                    <label for="symptom">Sintoma / Efeito Colateral:</label>
                                    <input type="text" class="form-control" id="symptom" placeholder="Digite o sintoma ou efeito colateral" name="descricao" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Adicionar Sintoma</button>
                            </form>
                        </div>
                    </div>

                  
                </div>
            </div>

            <!-- Conteúdo da aba de Relatório Completo -->
           
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll("form.success-alert").forEach(function(form) {
                form.addEventListener("submit", function(event) {
                    event.preventDefault();
                    alert("Enviado com sucesso");
                    form.submit();
                });
            });
        });
    </script>
</body>
</html>