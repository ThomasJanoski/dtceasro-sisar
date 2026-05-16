<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "bd_arquivo";
    try{
        $conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);
    }
    catch(PDOException $err){
        die("Falha na conexão:" . $err->getMessage());
    }
?>