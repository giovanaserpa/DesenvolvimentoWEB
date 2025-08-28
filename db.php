<?php

$DB_HOST = "localhost"; 
$DB_NAME = "cad";
$DB_USER = "root";
$DB_PASS = "";
$dns = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4; ";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try{
    $pdo = new PDO($dns, $DB_USER, $DB_PASS, $options);
}catch(PDOException $e){
    exit("Erro ao conectar ao banco". $e->getMessage());
}