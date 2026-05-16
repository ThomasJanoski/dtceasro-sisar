<?php
include_once('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $setor = $_POST['setor'];
    $ano = $_POST['ano'];
    $assunto = $_POST['assunto'];
    $codigo = $_POST['codigo'];
    $corrente = $_POST['corrente'];
    $intermediario = $_POST['intermediario'];
    $destfinal = $_POST['destfinal'];
    $tipo = $_POST['tipo'];
    $ncaixa = $_POST['ncaixa'];
    $estante = $_POST['estante'];

    try {
        $sql = "INSERT INTO `caixa` (`SETOR`, `ANO`, `ASSUNTO`, `CODIGO`, `CORRENTE`, `INTERMEDIARIO`, `DESTFINAL`, `TIPO`, `NCAIXA`, `ESTANTE`)
                VALUES (:setor, :ano, :assunto, :codigo, :corrente, :intermediario, :destfinal, :tipo, :ncaixa, :estante)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':setor', $setor);
        $stmt->bindParam(':ano', $ano);
        $stmt->bindParam(':assunto', $assunto);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':corrente', $corrente);
        $stmt->bindParam(':intermediario', $intermediario);
        $stmt->bindParam(':destfinal', $destfinal);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':ncaixa', $ncaixa);
        $stmt->bindParam(':estante', $estante);

          if ($stmt->execute()) {
            // Redirecionar para pgAlterarCaixa.php com sucesso
           echo "<script> alert('Caixa cadastrada com sucesso'); </script>";
			print "<script>setTimeout(\"location.href='pgAdicionarCaixa.php'\", 10);</script>";
        } else {
            // Redirecionar para pgAlterarCaixa.php com erro
            echo "<script> alert('Ocorreu um erro ao cadastrar'); </script>";
			print "<script>setTimeout(\"location.href='pgAdicionarCaixa.php'\", 10);</script>";
        }
    } catch (PDOException $e) {
        // Redirecionar com mensagem de erro
        header("Location: pgAdicionarCaixa.php?status=error&message=" . urlencode($e->getMessage()));
        exit();
    }
}
?>
