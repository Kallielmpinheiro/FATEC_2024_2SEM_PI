<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Login Médico</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Exemplo de um formulário de login">
    <meta name="keywords" content="Formulário de Login, Acesso Médico">
    <link rel="icon" href="../img/log1.png" type="image/x-icons">
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Overpass&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="background-image"></div> <!-- Div para a imagem de fundo -->
    <div id="login">
        <div class="titulo">
            <p>Login</p>
        </div>
        <form id="loginform">
            <div class="role-options">
                <input type="radio" id="medico" name="role" value="medico" required>
                <label for="medico">Médico</label>
        
                <input type="radio" id="paciente" name="role" value="paciente">
                <label for="paciente">Paciente</label>
        
                <input type="radio" id="funcionario" name="role" value="funcionario">
                <label for="funcionario">Funcionário</label>
            </div>
            <input type="text" name="usuario" placeholder="Usuário" required>
            <input type="password" placeholder="Senha" name="password" required>
            <button type="submit">Iniciar sessão</button>
        </form>
        <div class="pie-form">
            <a href="#"><button class="button">Esqueceu sua senha?</button></a>
            <a href="#"><button class="button">Registre-se</button></a>
        </div>
        