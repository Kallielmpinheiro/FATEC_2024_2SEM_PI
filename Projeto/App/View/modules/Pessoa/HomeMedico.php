<?php
// Verifica se a URL acessada contém o nome do arquivo PHP atual
if (strpos($_SERVER['PHP_SELF'], basename(__FILE__)) !== false) {
    // Redireciona para a página inicial
    header("Location: /");
    exit();
}

// Função para retornar as sugestões de medicamentos
function getMedicamentoSuggestions($input)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bdclinicapi";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = $conn->prepare("SELECT nomeMedicamento FROM medicamentosConsulta WHERE nomeMedicamento LIKE ?");
    $likeInput = "%" . $input . "%";
    $sql->bind_param("s", $likeInput);
    $sql->execute();
    $result = $sql->get_result();

    $suggestions = [];
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row['nomeMedicamento'];
    }

    $conn->close();
    return $suggestions;
}

if (isset($_GET['medicamento'])) {
    echo json_encode(getMedicamentoSuggestions($_GET['medicamento']));
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
    <style>
        .form_action--button {
            display: flex;
            gap: 10px;
        }

        .highlight {
            background-color: #FFFF00;
            /* Cor de destaque */
            font-weight: bold;
        }

        #suggestions {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            border: 1px solid #ccc;
            max-height: 200px;
            overflow-y: auto;
            z-index: 9999;
        }

        #suggestions ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        #suggestions ul li {
            padding: 8px 12px;
            cursor: pointer;
        }

        #suggestions ul li:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <h2 class="logo-nombre"></h2>
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
                                    <?php foreach ($model->rows as $item) : ?>
                                        <tr>
                                            <td><?= $item->nome ?></td>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Seção de Medicamentos -->
            <div class="tab-pane fade" id="medicamentos" role="tabpanel" aria-labelledby="medicamentos-tab">
                <!-- Conteúdo do CRUD de Medicamentos -->
                <div class="container-xl">
                    <div class="table-responsive">
                        <div class="table-wrapper">
                            <div class="table-title">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <h2><b></b></h2>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="search-box">


                                            <input type="text" id="buscar-medicamento" class="form-control" placeholder="Buscar Medicamento..." oninput="getSuggestions(); filterTable()">

                                            <div id="suggestions"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table id="table-medicamentos" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Código Medicamento</th>
                                        <th>Nome Medicamento</th>
                                        <th>Fabricante</th>
                                        <th>Tipo</th>
                                        <th>Uso</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($modelM) && $modelM !== null && property_exists($modelM, 'rows') && is_array($modelM->rows)) {
                                        foreach ($modelM->rows as $item) : ?>
                                            <tr>
                                                <td><?= $item->idMedicamento ?></td>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Seção de Receita Médica -->
            <div class="tab-pane fade" id="receita" role="tabpanel" aria-labelledby="receita-tab">
                <!-- Conteúdo do Formulário de Receita Médica -->
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <h2 class="mb-4">Prescrição Médica</h2>
                            <form action="/prescricao/form/save" method="post" onsubmit="onFormSubmit()">
                                <div class="form-group">
                                    <label for="cpf">CPF</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf" required>
                                </div>
                                <div class="form-group">
                                    <label for="id_medicamentosconsulta">Código Medicamento</label>
                                    <input type="number" class="form-control" id="id_medicamentosconsulta" name="id_medicamentosconsulta" required>
                                </div>
                                <div class="form-group">
                                    <label for="duracao">Duração (dias)</label>
                                    <input type="number" class="form-control" id="duracao" name="duracao" required>
                                </div>
                                <div class="form-group">
                                    <label for="dosagem">Dosagem</label>
                                    <input type="text" class="form-control" id="dosagem" name="dosagem" required>
                                </div>
                                <div class="form-group">
                                    <label for="instrucao">Instrução</label>
                                    <input type="text" class="form-control" id="instrucao" name="instrucao" required>
                                </div>
                                <div class="form-group">
                                    <label for="CRM">CRM</label>
                                    <input type="text" class="form-control" id="CRM" name="CRM" required>
                                </div>
                                <div class="form_action--button">
                                    <input type="submit" class="btn btn-primary" value="Receitar">
                                    <input type="reset" class="btn btn-secondary" value="Reiniciar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        function getSuggestions() {
            var input = document.getElementById('buscar-medicamento').value;
            if (input.length > 0) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        showSuggestions(JSON.parse(this.responseText));
                    }
                };
                xhttp.open('GET', '?medicamento=' + input, true);
                xhttp.send();
            } else {
                hideSuggestions();
            }
        }

        function showSuggestions(suggestions) {
            var suggestionsDiv = document.getElementById('suggestions');
            suggestionsDiv.innerHTML = '';

            if (suggestions.length > 0) {
                var inputText = document.getElementById('buscar-medicamento').value;
                var regex = new RegExp(inputText, 'gi');

                var ul = document.createElement('ul');
                suggestions.forEach(function(suggestion) {
                    var li = document.createElement('li');
                    li.innerHTML = suggestion.replace(regex, '<span class="highlight">$&</span>');
                    li.addEventListener('click', function() {
                        selectSuggestion(suggestion);
                    });
                    ul.appendChild(li);
                });

                suggestionsDiv.appendChild(ul);
                suggestionsDiv.style.display = 'block';
            } else {
                hideSuggestions();
            }
        }

        function selectSuggestion(suggestion) {
            document.getElementById('buscar-medicamento').value = suggestion;
            hideSuggestions();
        }

        function hideSuggestions() {
            document.getElementById('suggestions').style.display = 'none';
        }

        document.getElementById('buscar-medicamento').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                var suggestionsDiv = document.getElementById('suggestions');
                var firstSuggestion = suggestionsDiv.querySelector('ul li:first-child');
                if (firstSuggestion) {
                    selectSuggestion(firstSuggestion.textContent);
                }
            }
        });

        function filterTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("buscar-medicamento");
            filter = input.value.toUpperCase();
            table = document.getElementById("table-medicamentos");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0]; // Assume que o nome do medicamento está na primeira coluna

                if (td) {
                    txtValue = td.textContent || td.innerText;

                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }


        document.addEventListener('click', function(e) {
            if (!document.getElementById('suggestions').contains(e.target)) {
                hideSuggestions();
            }
        });
    </script>
</body>

</html>