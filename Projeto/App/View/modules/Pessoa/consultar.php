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
    <title>Buscar Paciente por CPF</title>
    <link rel="stylesheet" href="../css/medico.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2 class="mt-4 mb-4 text-center">Buscar Paciente por CPF</h2>
        <form action= "/medicamento/Consultar" method="post">
            <div class="mb-3">
                <label for="cpf" class="form-label">Digite o CPF do paciente:</label>
                <input type="text" name="cpf" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="/telaM" class="btn btn-secondary" >Voltar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>