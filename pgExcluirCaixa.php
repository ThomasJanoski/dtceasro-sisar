<!DOCTYPE html>
<html lang="pt-BR">
<?php
include_once('conexao.php');

// Consulta todos os tipos e caixas disponíveis
$query = "SELECT TIPO, NCAIXA FROM caixa ORDER BY TIPO, NCAIXA";
$result = $conn->prepare($query);
$result->execute();

// Organiza os dados em um array associativo
$caixasPorTipo = [];
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $caixasPorTipo[$row['TIPO']][] = $row['NCAIXA'];
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Home</title>
</head>

<body>
    <div class="container-fluid">
        <header>
            <?php
            include_once('menu.php');
            ?>
        </header>
                <div class="container mt-5">
                    <h2 class="text-center text-white">Excluir Caixa</h2>
                    <form action="ExcluirCaixa.php" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipo" class="text-white">Tipo:</label>
                                    <select class="form-control" id="tipo" name="tipo" required>
                                        <option value="">Selecione o Tipo</option>
                                        <?php foreach (array_keys($caixasPorTipo) as $tipo): ?>
                                            <option value="<?= htmlspecialchars($tipo) ?>"><?= htmlspecialchars($tipo) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ncaixa" class="text-white">Número da Caixa:</label>
                                    <select class="form-control" id="ncaixa" name="ncaixa" required>
                                        <option value="">Selecione o Tipo primeiro</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Excluir Caixa</button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                // Dados pré-carregados de PHP
                const caixasPorTipo = <?= json_encode($caixasPorTipo) ?>;

                // Referências dos elementos
                const selectTipo = document.getElementById('tipo');
                const selectNcaixa = document.getElementById('ncaixa');

                // Evento para carregar os números de caixa ao selecionar um tipo
                selectTipo.addEventListener('change', () => {
                    const tipoSelecionado = selectTipo.value;

                    // Limpa as opções de número de caixa
                    selectNcaixa.innerHTML = "<option value=''>Selecione o Tipo primeiro</option>";

                    // Adiciona as novas opções, se existirem
                    if (caixasPorTipo[tipoSelecionado]) {
                        caixasPorTipo[tipoSelecionado].forEach(ncaixa => {
                            const option = document.createElement('option');
                            option.value = ncaixa;
                            option.textContent = `Caixa ${ncaixa}`;
                            selectNcaixa.appendChild(option);
                        });
                    }
                });
            </script>
        </body>

</html>




</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>