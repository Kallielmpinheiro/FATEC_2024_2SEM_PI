<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Medicamento</title>
    <style>
        
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastrar Medicamento</h2>
        <form action="/medicamento/form/save" method="post">
            <div class="form-group">
                <label for="nomeMedicamento">Medicamento</label>
                <input type="text" id="nomeMedicamento" name="nomeMedicamento" required>
            </div>

            <div class="form-group">
                <label for="fabricante">fabricante</label>
                <input type="text" id="fabricante" name="fabricante" required>
            </div>

            <div class="form-group">
                <label for="quantidade">tipo</label>
                <input type="text" id="tipo" name="tipo" required>
            </div>

            <div class="form-group">
                <label for="uso">Uso</label>
                <input type="text" id="uso" name="uso" required>
            </div>


            <div class="btn-container">
                <button type="submit" class="btn">Cadastrar</button>
            </div>
        </form>
    </div>
</body>
</html>