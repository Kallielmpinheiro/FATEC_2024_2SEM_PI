<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/log1.png" type="image/x-icons">
    <title>Pacientes</title>
    <link rel="stylesheet" href="css/dados.css">
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
                            <h2>Dados  <b></b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Adicionar Novo Paciente</span></a>
                            <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Excluir</span></a>						
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label>
                                </span>
                            </th>
                            <th>Nome Completo</th>
                            <th>Idade</th>
                            <th>Gênero</th>
                            <th>CPF</th>
                            <th>Endereço</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                    <label for="checkbox1"></label>
                                </span>
                            </td>
                            <td>Bruno</td>
                            <td>36</td>
                            <td>M</td>
                            <td>0953678145</td>
                            <td>Fatec-Araras </td>
                            <td>(019) 998-2222</td>
                            <td>bruno@fatecararas.com</td>
                            <td>
                                <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>
                                <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Excluir">&#xE872;</i></a>
                            </td>
                        </tr>
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
