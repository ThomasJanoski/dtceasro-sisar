<!DOCTYPE html>
<html lang="pt-BR">
<?php
include_once('conexao.php');
$anoAtual = date("Y");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Arquivo Intermediário</title>
</head>

<body>
    <div class="container-fluid">
        <header>
            <?php
            include_once('menu.php');
            ?>
        </header>
        <?php
        $busca_pasta = "SELECT `ID`, `SETOR`, `ANO`, `ASSUNTO`, `CODIGO`, `CORRENTE`, `INTERMEDIARIO`, `DESTFINAL`, `NCAIXA`, `ESTANTE` FROM `caixa` WHERE Tipo = 'PERMANENTE'  order by ESTANTE, NCAIXA";
        $result_pasta = $conn->prepare($busca_pasta);
        $result_pasta->execute();

        echo '<div class="row align-items-center mt-5 ">';

        $EstanteAtual = "";
        while ($row_pasta = $result_pasta->fetch(PDO::FETCH_ASSOC)) {
            extract($row_pasta);

            if ($EstanteAtual !== $ESTANTE) {
                $EstanteAtual = $ESTANTE;
                echo "<div class='col-12 mb-3'><h3 class='text-center  text-white'>Estante: $ESTANTE</h3></div>";
            }
            // Extrai o ano final do intervalo de $CORRENTE
    
                echo '<div class="col-sm-2.5 mb-4" id="sexo">';
                echo '<div class="card text-white bg-info">';
                echo "<div class='card-header'>Setor: $SETOR</div>";
                echo '<div class="card-body">';
                echo "<p class='card-text'>Ano: $ANO</h5>";
                 echo "<p class='card-text'>Assunto: $ASSUNTO</p>";
                echo "<p class='card-text'>Código: $CODIGO</p>";
                echo "<p class='card-text'>Corrente: $CORRENTE</p>";
                echo "<p class='card-text'>Intermediário: $INTERMEDIARIO</p>";
                echo "<p class='card-text'>Dest. Final: $DESTFINAL</p>";
                echo '</div>';
                echo "<div class='card-footer'>$NCAIXA</div>";
                echo '</div>';
                echo '</div>';
            }
        

        echo '</div>'; // Fecha a linha

        // corrente: verde 2
        // intermediario: amarelo 1 
        // eliminação: vermelho 2
        // permanente: azul 2
        ?>



    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>