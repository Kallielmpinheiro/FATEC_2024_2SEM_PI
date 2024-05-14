<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Medicamento</title>
    <style>
        
    </style>
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Medicamento</th>
            <th>Quantidade</th>
            <th>Vezes ao Dia</th>
        </tr>
        <?php
        // Verifica se há resultados para exibir
        if (!empty($model->result)) {
            // Inicializa uma variável para armazenar temporariamente o último nome de paciente
            $ultimo_nome = '';
        
            foreach ($model->result as $linha) {
                echo '<tr>';
                // Verifica se o nome do paciente é diferente do último nome exibido
                if ($linha->nome != $ultimo_nome) {
                   
                    echo '<td>' . $linha->id . '</td>';

                    echo '<td> <a href="/pessoa/form?id=' . $linha->id . '"> ' . $linha->nome . '</td>';
                    $ultimo_nome = $linha->nome; // Atualiza o último nome exibido
                } else {
                    // Se for o mesmo nome do paciente, exibe células vazias para o ID e o nome
                    echo '<td></td><td></td>';
                }
                // Exibe as informações do medicamento
                echo '<td>' . $linha->Medicamento . '</td>';
                echo '<td>' . $linha->quantidade . '</td>';
                echo '<td>' . $linha->VezesAoDia . '</td>';
                echo '</tr>';
            }
        } else {
            // Se não houver resultados, exibe uma mensagem de que nenhum medicamento foi encontrado
            echo '<tr><td colspan="6">Nenhum medicamento encontrado para este paciente.</td></tr>';
        }
        ?>
    </table>
</body>
</html>