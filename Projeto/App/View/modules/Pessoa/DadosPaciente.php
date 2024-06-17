<?php

if (strpos($_SERVER['PHP_SELF'], basename(__FILE__)) !== false) {
    // Redireciona para a página inicial
    header("Location: /");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="App/View/modules/css/dadosp.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #ddd;
    background-color: #fff;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
    font-weight: bold;
}

tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}


.btn-primary {
    display: inline-block;
    font-weight: 400;
    color: #fff;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    background-color: #007bff;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    text-decoration: none;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.btn-primary:hover {
    color: #fff;
    background-color: #0056b3;
    border-color: #004085;
    text-decoration: none;
}

.btn-primary:focus, .btn-primary.focus {
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
}

.btn-primary:active, .btn-primary.active {
    color: #fff;
    background-color: #004085;
    border-color: #00306f;
    text-decoration: none;
}

.btn-primary:disabled, .btn-primary.disabled {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    pointer-events: none;
    opacity: 0.65;
}

    </style>
</head>
<body>
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
                <th>Médico</th>
                <th>satus</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($model->rows as $item): ?>
                <tr>
                    <td><a href="/pessoa/form?id=<?= $item->idPaciente ?>"><?= $item->nome ?></a></td>
                    <td><?= $item->sobrenome ?></td>
                    <td><?= $item->cpf ?></td>
                    <td><?= $item->cep ?></td>
                    <td><?= $item->estado ?></td>
                    <td><?= $item->cidade ?></td>
                    <td><?= $item->rua ?></td>
                    <td><?= $item->numero ?></td>
                    <td><?= $item->tipoPessoa ?></td>
                    <td><?= $item->PlanoSaude ?></td>
                    <td><?= $item->nomeMedico ?></td>
                    <td><?= $item->status ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/telaF" class="btn btn-primary">Voltar</a>
</body>
</html>