<?php
$host = 'ec2-15-228-94-229.sa-east-1.compute.amazonaws.com';
$dbname = 'ecospark';
$username = 'ecospark';
$password = 'GGcrTf!J0svzVm!F';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>