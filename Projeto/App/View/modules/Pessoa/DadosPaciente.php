<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="App/View/modules/css/dadosp.css">
    <style>
        /* Estilos adicionais aqui */
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
                    <td><?= $item->medico_id ?></td> <!-- Corrigido aqui -->
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/telaF" class="btn btn-primary">Voltar</a>
</body>
</html>