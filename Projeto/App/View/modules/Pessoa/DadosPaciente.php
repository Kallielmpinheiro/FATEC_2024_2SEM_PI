<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
</body>
</html>