<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard do Paciente</title>
    <link rel="stylesheet" href="css/dashboardpaciente.css">
</head>
<body>
    <header>
        <img src="img/log1.png" alt="Logo da Clínica">
        <h1></h1>
        <nav>
            <ul>
                <li><a href="#lembretes">Lembretes</a></li>
                <li><a href="#historico">Histórico</a></li>
                <li><a href="#comentarios">Comentários</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="lembretes">
            <h2>Lembretes de Medicamentos</h2>
            <ul class="lista-lembretes">
                <!-- Cada lembrete terá um campo de entrada de texto para o horário -->
                <li>
                    <input type="text" placeholder="Horário">
                </li>
            </ul>
            <button id="adicionarLembrete">Adicionar Lembrete</button>
        </section>

        <section id="historico">
            <h2>Histórico de Prescrições</h2>
            <div class="filtro">
                <label for="periodo">Período:</label>
                <select id="periodo">
                    <option value="todos">Todos</option>
                    <option value="semana">Última Semana</option>
                    <option value="mes">Último Mês</option>
                    <option value="ano">Último Ano</option>
                </select>
                <label for="medicamento">Medicamento:</label>
                <input type="text" id="medicamento" placeholder="Pesquisar...">
            </div>
            <table class="tabela-prescricoes">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Medicamento</th>
                        <th>Data de Prescrição</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </section>

        <section id="comentarios">
            <h2>Comentários para o Médico</h2>
            <textarea id="comentario" placeholder="Escreva sobre seus sintomas..."></textarea>
            <label for="gravidade">Gravidade:</label>
            <select id="gravidade">
                <option value="leve">Leve</option>
                <option value="moderada">Moderada</option>
                <option value="severa">Severa</option>
            </select>
            <button id="enviarComentario">Enviar Comentário</button>
            <ul class="lista-comentarios"></ul>
        </section>
    </main>

    <!-- Scripts JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
    <!-- Script personalizado para adicionar lembretes -->
    <script>
        $(document).ready(function() {
            // Função para carregar as prescrições com base no período e medicamento selecionados
            function carregarPrescricoes(periodo, medicamento) {
                $.ajax({
                    url: 'read.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Limpar a tabela antes de preencher
                        $('.tabela-prescricoes tbody').empty();

                        // Preencher a tabela com os dados das prescrições
                        $.each(data, function(index, prescricao) {
                            $('.tabela-prescricoes tbody').append(`
                                <tr>
                                    <td>${prescricao.id}</td>
                                    <td>${prescricao.medicamento}</td>
                                    <td>${prescricao.data_prescricao}</td>
                                </tr>
                            `);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro ao obter prescrições:', error);
                    }
                });
            }

            // Chamar a função para carregar as prescrições ao carregar a página
            carregarPrescricoes();

            // Adicionar evento de mudança ao seletor de período e à entrada de medicamento
            $('#periodo, #medicamento').change(function() {
                var periodoSelecionado = $('#periodo').val();
                var medicamentoPesquisado = $('#medicamento').val();
                
                // Chamar a função para carregar as prescrições com base no período selecionado e no medicamento pesquisado
                carregarPrescricoes(periodoSelecionado, medicamentoPesquisado);
            });

            // Adicionar evento de clique ao botão "Adicionar Lembrete"
            $('#adicionarLembrete').click(function() {
                var horario = $('input[type="text"]').val();
                
                if (horario !== '') {
                    $('.lista-lembretes').append('<li>' + horario + '</li>');
                    $('input[type="text"]').val('');
                } else {
                    alert('Por favor, insira um horário.');
                }
            });
        });
    </script>

</body>
</html>
