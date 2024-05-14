<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Medicamento</title>
</head>
<body>
    <table>
        <tr>
            <th>Nome Medicamento</th>
            <th>Fabricante</th>
            <th>Tipo</th>
            <th>Uso</th>
        </tr>
        <?php foreach($model->rows as $item): ?>
            <tr>
                <td><?= $item->nomeMedicamento ?></td>
                <td><?= $item->fabricante ?></td>
                <td><?= $item->tipo ?></td>
                <td><?= $item->uso ?></td>
            </tr>
        <?php endforeach?>
    </table>
</body>
</html>