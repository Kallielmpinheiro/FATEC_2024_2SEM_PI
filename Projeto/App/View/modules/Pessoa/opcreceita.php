<!DOCTYPE html>
<head>
    <!-- Definição do título da página -->
    <title>Receita Médica</title>
    <!-- Inclusão do arquivo de estilo CSS -->
    <link rel="stylesheet" href="css/consulta.css">
</head>

<body>
    <header>
        <!-- Cabeçalho da página (possivelmente poderia conter o logotipo ou título adicional) -->
    </header>

    <!-- Tabela contendo o formulário de receita médica e a lista de receitas -->
    <table>
        <tr>
            <td>
                <!-- Formulário de receita médica -->
                <div class="col-sm-6">
                    <h2>Receita Médica</h2>
                </div>
                <form autocomplete="off" onsubmit="onFormSubmit()">
                    <!-- Campo para inserir o nome do paciente -->
                    <div>
                        <label for="productCode">Nome do paciente</label>
                        <input type="text" name="productCode" id="productCode">
                    </div>
                    <!-- Campo para inserir o medicamento -->
                    <div>
                        <label for="product">Medicamento</label>
                        <input type="text" name="product" id="product">
                    </div>
                    <!-- Campo para inserir a quantidade do medicamento -->
                    <div>
                        <label for="qty">Quantidade</label>
                        <input type="number" name="qty" id="qty">
                    </div>
                    <!-- Campo para inserir as indicações -->
                    <div>
                        <label for="product1">Indicações</label>
                        <input type="text" name="product1" id="product1">
                    </div>
                    <!-- Campo para inserir a duração do tratamento -->
                    <div>
                        <label for="product1">Duração do tratamento</label>
                        <input type="text" name="product2" id="product2">
                    </div>
                    <!-- Campo para inserir o médico prescritor -->
                    <div>
                        <label for="product1">Médico prescritor</label>
                        <input type="text" name="product3" id="product3">
                    </div>

                    <!-- Botões de ação do formulário -->
                    <div class="form_action--button">
                        <input type="submit" value="Receitar">
                        <input type="reset" value="Reiniciar">
                    </div>
                </form>
            </td>
            <!-- Tabela de lista de receitas -->
            <td>
                <table class="list" id="storeList">
                    <!-- Cabeçalho da tabela de lista de receitas -->
                    <thead>
                        <tr>
                            <th>Nomes do paciente</th>
                            <th>Medicamento</th>
                            <th>Quantidade</th>
                            <th>Indicações</th>
                            <th>Duração do tratamento</th>
                            <th>Médico prescritor</th>
                        </tr>
                    </thead>
                    <!-- Corpo da tabela de lista de receitas (a ser preenchido dinamicamente) -->
                    <tbody>

                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <!-- Inclusão do arquivo de script JavaScript -->
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>