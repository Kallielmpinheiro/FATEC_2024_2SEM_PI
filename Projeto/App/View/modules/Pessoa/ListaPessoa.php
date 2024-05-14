<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Pessoas</title>
</head>
<body>
    <table>
        <tr>
            <th></th>
            <th>Id</th>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>CPF</th>
            <th>CEP</th>
            <th>Estado</th>
            <th>Cidade</th>
            <th>Rua</th>
            <th>Número</th>
            <th>Tipo de Usuário</th>
            <th>Plano de Saúde</th>
        </tr>
        <?php foreach($model->rows as $item): ?>
            <tr>
                <td>
                    <a href="/pessoa/delete?id=<?= $item->id ?>">X</a>
                </td>
                <td><?= $item->id ?></td>
                <td><?= $item->nome ?></td>
                <td><?= $item->sobrenome ?></td>
                <td><?= $item->cpf ?></td>
                <td><?= $item->cep ?></td>
                <td><?= $item->estado ?></td>
                <td><?= $item->cidade ?></td>
                <td><?= $item->rua ?></td>
                <td><?= $item->numero ?></td>
                <td><?= $item->tipo_usuario ?></td>
                <td><?= $item->plano_saude ?></td>
            </tr>
        <?php endforeach?>
    </table>
</body>
</html>