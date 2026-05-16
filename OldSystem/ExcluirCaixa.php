<?php
include_once('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar os dados do formulário
    $ncaixa = $_POST['ncaixa'];
    $tipo = $_POST['tipo'];

    try {
        // Prepara a query de exclusão
        $query = "DELETE FROM caixa WHERE NCAIXA = :ncaixa AND TIPO = :tipo";
        $stmt = $conn->prepare($query);

        // Vincula os parâmetros
        $stmt->bindParam(':ncaixa', $ncaixa, PDO::PARAM_INT);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);

        // Executa a query
        if ($stmt->execute()) {
            // Redireciona com mensagem de sucesso
               echo "<script> alert('Caixa excluida com sucesso'); </script>";
			print "<script>setTimeout(\"location.href='pgExcluirCaixa.php'\", 10);</script>";
        } else {
            // Redireciona com mensagem de erro
           echo "<script> alert('Ocorreu um erro ao excluir'); </script>";
			print "<script>setTimeout(\"location.href='pgExcluirCaixa.php'\", 10);</script>";
        }
    } catch (PDOException $e) {
        // Redireciona com mensagem de erro específico
        header("Location: pgExcluirCaixa.php?status=error&message=" . urlencode($e->getMessage()));
        exit();
    }
}
?>
