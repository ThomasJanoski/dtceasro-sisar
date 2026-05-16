<?php
include_once('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar os dados enviados pelo formulário
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
        // Preparar a query de atualização
        $query = "UPDATE caixa 
                  SET SETOR = :setor, 
                      ANO = :ano, 
                      ASSUNTO = :assunto, 
                      CODIGO = :codigo, 
                      CORRENTE = :corrente, 
                      INTERMEDIARIO = :intermediario, 
                      DESTFINAL = :destfinal, 
                      TIPO = :tipo, 
                      ESTANTE = :estante 
                  WHERE NCAIXA = :ncaixa";

        $stmt = $conn->prepare($query);

        // Vincular os parâmetros
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

        // Executar a query
        if ($stmt->execute()) {
            // Redirecionar para pgAlterarCaixa.php com sucesso
         echo "<script> alert('Caixa alterada com sucesso'); </script>";
			print "<script>setTimeout(\"location.href='pgAlterarCaixa.php'\", 10);</script>";
        } else {
            // Redirecionar para pgAlterarCaixa.php com erro
          echo "<script> alert('Ocorreu um erro ao alterar a caixa'); </script>";
			print "<script>setTimeout(\"location.href='pgAlterarCaixa.php'\", 10);</script>";
        }
    } catch (PDOException $e) {
        // Redirecionar com mensagem de erro
        header("Location: pgAlterarCaixa.php?status=error&message=" . urlencode($e->getMessage()));
        exit();
    }
}
