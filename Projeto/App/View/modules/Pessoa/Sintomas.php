<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                  
                        <th>ID</th>
                        <th>Descrição</th>
                        <th>Data</th>
                        <th>IDpaciente</th>
      
                    </tr>
                </thead>
                <tbody>
                <?php
                    if(isset($modelM) && $modelM !== null && property_exists($modelM, 'rows') && is_array($modelM->rows)) {
                        foreach($modelM->rows as $item): ?>
                            <tr>
                                <td><?= $item->nome?></td>
                                <td><?= $item->descricao ?></td>
                                <td><?= $item->data_descricao ?></td>
                                <td><?= $item->id_paciente ?></td>
                            </tr>
                        <?php endforeach;
                        } else {
                            echo 'Nenhum medicamento cadastrado';
                        }
                        ?>
                
                    </tr>        
                </tbody>
            </table>
</body>
</html>