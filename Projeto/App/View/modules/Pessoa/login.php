<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Login Médico</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Exemplo de um formulário de login">
    <meta name="keywords" content="Formulário de Login, Acesso Médico">
    <link rel="icon" href="img/log1.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Overpass&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/App/View/modules/css/login.css">
</head>
<body>
    <div class="background-image"></div>
    <div id="login">
        <div class="titulo">
            <p>Login</p>
        </div>
        <form id="loginform" action = "/login" method = "post">
            <input type="text" id="cpf" name="cpf" placeholder="CPF" required>
            <input type="password" id="senha" name="senha" placeholder="Senha" required>
            <div>
                <label>Pessoa</label>
                <input type="radio" id="Pessoa" value="Pessoa" name="tipo" required>
                <label>Médico</label>
                <input type="radio" id="Medico" value="Medico" name="tipo" required>
                <label>Funcionario</label>
                <input type="radio" id="Funcionario" value="Funcionario" name="tipo" required>
            </div>
            <button type="submit">Iniciar sessão</button>
            <button type="button" onclick="window.location.href='/'">Voltar</button>
        </form>
    </div>


</body>
</html>