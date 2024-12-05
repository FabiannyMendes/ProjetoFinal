<?php
$host = 'localhost';
$dbname = 'banck_ambulantes';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=3307;dbname=$dbname;charset=utf8mb4", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão com o banco de dados: " . $e->getMessage());
}
?>
