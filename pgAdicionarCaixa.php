<!DOCTYPE html>
<html lang="pt-BR">
<?php
include_once('conexao.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Adicionar Caixa</title>
</head>

<body>
    <div class="container-fluid">
        <header>
            <?php
            include_once('menu.php');
            ?>
        </header>
        <div class="container mt-5">
            <h2 class="text-center text-white">Cadastro de Caixa</h2>
            <form action="CadastroCaixa.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="setor" class="text-white">Setor:</label>
                            <input type="text" class="form-control" id="setor" name="setor" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ano" class="text-white">Ano:</label>
                            <input type="text" class="form-control" id="ano" name="ano" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="assunto" class="text-white">Assunto:</label>
                            <input type="text" class="form-control" id="assunto" name="assunto" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="codigo" class="text-white">Código:</label>
                            <input type="text" class="form-control" id="codigo" name="codigo" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="corrente" class="text-white">Corrente:</label>
                            <input type="text" class="form-control" id="corrente" name="corrente" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="intermediario" class="text-white">Intermediário:</label>
                            <input type="text" class="form-control" id="intermediario" name="intermediario" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="destfinal" class="text-white">Destino Final:</label>
                            <input type="text" class="form-control" id="destfinal" name="destfinal" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipo" class="text-white">Tipo:</label>
                            <select class="form-control" id="tipo" name="tipo" required>
                                <option value="CORRENTE">CORRENTE</option>
                                <option value="INTERMEDIÁRIO">INTERMEDIÁRIO</option>
                                <option value="ELIMINAÇÃO">ELIMINAÇÃO</option>
                                <option value="PERMANENTE">PERMANENTE</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ncaixa" class="text-white">Número da Caixa:</label>
                            <input type="number" class="form-control" id="ncaixa" name="ncaixa" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estante" class="text-white">Estante:</label>
                            <select class="form-control" id="estante" name="estante" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</body>

</html>
