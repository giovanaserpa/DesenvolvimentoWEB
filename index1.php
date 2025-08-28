<?php
require_once __DIR__ ."/db.php";

$pdo->exec( "CREATE TABLE IF NOT EXISTS cadastro(id INT AUTO_INCREMENT PRIMARY KEY, Nome VARCHAR(100) NOT NULL, Endereco VACHAR(150) NOT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, ENGINE=INNODB DEFAULT CHARSET=utf8mb4");
$erro = '';
if($_SERVER ['REQUEST_METHOD'] == 'POST') {
    $Nome = $_POST ['nome'] ?? '';
    $Endereco = $_POST ['endereco'] ??'';
    if($Nome == '' || $Endereco == '') 
        $erro = 'Preencha os campos.';
    }else{
        $stms = $pdo->prepare('INSERT INTO cadastro(nome,endereco) VALUES (:nome, :endereco)');
        $stms->execute([
            ':nome'=> $Nome,
            ':endereco'=>$Endereco
        ]);
        header('Location: ' .$_SERVER
        ['PHP_SELF']);
        exit();
    }
?>