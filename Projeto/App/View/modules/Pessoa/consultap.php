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
    <title>Lista Medicamento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 20px;
            color: #444;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fafafa;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a {
            color: #0066cc;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Lista de Medicamentos</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Medicamento</th>
                <th>Tipo</th>
                <th>CRM</th>
                <th>Data</th>
                <th>Dosagem</th>
                <th>Instrução</th>
            </tr>
            
            <?php
            // Verifica se há resultados para exibir
            if (!empty($results['result'])) {
                // Inicializa variáveis para armazenar temporariamente os últimos valores exibidos
                $ultimo_nome = '';
                $ultimo_NumCRM = '';
                $ultimo_medicamento = '';
                $ultimo_tipo = '';
        
            
                foreach ($results['result'] as $linha) {
                    // Verifica se qualquer um dos campos é diferente do último valor exibido
                    $mostrar_nova_linha = false;
                    if ($linha->nome != $ultimo_nome || $linha->NumCRM != $ultimo_NumCRM || $linha->Medicamento != $ultimo_medicamento || $linha->tipo != $ultimo_tipo) {
                        $mostrar_nova_linha = true;
                    }
            
                    if ($mostrar_nova_linha) {
                        echo '<tr>';
                        // Exibe o nome do paciente se for diferente do último nome exibido
                        if ($linha->nome != $ultimo_nome) {
                            echo '<td>' . $linha->idPaciente . '</td>';
                            echo '<td>' . $linha->nome . '</td>';
                            $ultimo_nome = $linha->nome; // Atualiza o último nome exibido
                        } else {
                            echo '<td></td><td></td>';
                        }
            
                        // Exibe o medicamento se for diferente do último medicamento exibido
                        if ($linha->Medicamento != $ultimo_medicamento) {
                            echo "<td>{$linha->Medicamento}</td>";
                            $ultimo_medicamento = $linha->Medicamento; // Atualiza o último medicamento exibido
                        } else {
                            echo '<td></td>';
                        }


          
                        if ($linha->tipo != $ultimo_tipo) {
                            echo "<td>{$linha->tipo}</td>";
                            $ultimo_tipo = $linha->tipo; 
                        } else {
                            echo '<td></td>';
                        } 
                        

                        if ($linha->NumCRM != $ultimo_NumCRM) {
                            echo "<td>{$linha->NumCRM}</td>";
                            $ultimo_NumCRM = $linha->NumCRM;
                        } else {
                            echo '<td></td>';
                        } 
                            


                        
            
                        echo "<td>{$linha->data_prescricao}</td>";
                        echo "<td>{$linha->dosagem}</td>";
                        echo "<td>{$linha->instrucao}</td>";
            
                        echo '</tr>';
                    }
                }
            } else {
                // Se não houver resultados, exibe uma mensagem de que nenhum medicamento foi encontrado
                echo '<tr><td colspan="7">Nenhum medicamento encontrado para este paciente.</td></tr>';
            }
            ?>
        </table>

        <?php
        // Exibindo os resultados da segunda consulta (efeitos colaterais)
        if (!empty($results['sintomas'])) {
            echo "<h2>Efeitos Colaterais</h2>";
            foreach ($results['sintomas'] as $efeito) {
                echo "<p>Sintoma: {$efeito->descricao}, Data: {$efeito->data_descricao}</p>";
            }
        }
        ?>

    <a href="/telaM" class="btn btn-primary" >Voltar</a>
    </div>
</body>
</html>