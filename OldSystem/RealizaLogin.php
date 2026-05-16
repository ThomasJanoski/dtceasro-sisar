<?php
session_start();
include_once('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    echo $username;
    echo $password;

    try {
        // Consulta o usuário pelo nome de usuário
        $query = "SELECT * FROM usuarios WHERE usuario = :usuario";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':usuario', $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
         echo "<pre>";
    print_r($user); // Ou use var_dump($user);
    echo "</pre>";

    if($username == $user['usuario'] && $password == $user['senha']){
 echo "<script> alert('Login realizado'); </script>";
			print "<script>setTimeout(\"location.href='pgindex.php'\", 10);</script>";
    }
    else{
          // Credenciais inválidas
            $_SESSION['login_error'] = "Usuário ou senha inválidos.";
            header("Location: pglogin.php");
            exit();
    }

    }
     catch (PDOException $e) {
        $_SESSION['login_error'] = "Erro no sistema: " . $e->getMessage();
       
    }
} 

?>
