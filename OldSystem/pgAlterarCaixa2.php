<!DOCTYPE html>
<html lang="pt-BR">
<?php
include_once('conexao.php');
$anoAtual = date("Y");

// Recupera os dados da caixa selecionada (se houver)
$dadosCaixa = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ncaixa'], $_POST['tipo'])) {
    $ncaixa = $_POST['ncaixa'];
    $tipo = $_POST['tipo'];

    // Consulta os dados da caixa no banco
    $query = "SELECT * FROM caixa WHERE NCAIXA = :ncaixa AND TIPO = :tipo";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':ncaixa', $ncaixa);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->execute();

    $dadosCaixa = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Alterar Caixa</title>
</head>

<body>
    <div class="container-fluid">
        <header>
            <?php include_once('menu.php'); ?>
        </header>
        <div class="container mt-5">
            <h2 class="text-center text-white">Alterar Caixa</h2>
            <form action="AlterarCaixa.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="setor" class="text-white">Setor:</label>
                            <input type="text" class="form-control" id="setor" name="setor" value="<?= $dadosCaixa['SETOR'] ?? '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ano" class="text-white">Ano:</label>
                            <input type="text" class="form-control" id="ano" name="ano" value="<?= $dadosCaixa['ANO'] ?? '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="assunto" class="text-white">Assunto:</label>
                            <input type="text" class="form-control" id="assunto" name="assunto" value="<?= $dadosCaixa['ASSUNTO'] ?? '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="codigo" class="text-white">Código:</label>
                            <input type="text" class="form-control" id="codigo" name="codigo" value="<?= $dadosCaixa['CODIGO'] ?? '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="corrente" class="text-white">Corrente:</label>
                            <input type="text" class="form-control" id="corrente" name="corrente" value="<?= $dadosCaixa['CORRENTE'] ?? '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="intermediario" class="text-white">Intermediário:</label>
                            <input type="text" class="form-control" id="intermediario" name="intermediario" value="<?= $dadosCaixa['INTERMEDIARIO'] ?? '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="destfinal" class="text-white">Destino Final:</label>
                            <input type="text" class="form-control" id="destfinal" name="destfinal" value="<?= $dadosCaixa['DESTFINAL'] ?? '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipo" class="text-white">Tipo:</label>
                          <select class="form-control" id="tipo" name="tipo" required>
    <option value="CORRENTE" <?= isset($dadosCaixa['TIPO']) && $dadosCaixa['TIPO'] === 'CORRENTE' ? 'selected' : '' ?>>CORRENTE</option>
    <option value="INTERMEDIÁRIO" <?= isset($dadosCaixa['TIPO']) && $dadosCaixa['TIPO'] === 'INTERMEDIÁRIO' ? 'selected' : '' ?>>INTERMEDIÁRIO</option>
    <option value="ELIMINAÇÃO" <?= isset($dadosCaixa['TIPO']) && $dadosCaixa['TIPO'] === 'ELIMINAÇÃO' ? 'selected' : '' ?>>ELIMINAÇÃO</option>
    <option value="PERMANENTE" <?= isset($dadosCaixa['TIPO']) && $dadosCaixa['TIPO'] === 'PERMANENTE' ? 'selected' : '' ?>>PERMANENTE</option>
</select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ncaixa" class="text-white">Número da Caixa:</label>
                            <input type="number" class="form-control" id="ncaixa" name="ncaixa" value="<?= $dadosCaixa['NCAIXA'] ?? '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estante" class="text-white">Estante:</label>
                            <select class="form-control" id="estante" name="estante" value="<?= $dadosCaixa['ESTANTE'] ?? '' ?>" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>
                </div>
                 <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Alterar</button>
                </div>
            </form>
        </div>
    </div>
       <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>