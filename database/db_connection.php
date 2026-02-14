<?php
$host="localhost";
$user="root";
$password="";
$dbname="l2_gl_app";

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    $connexion = new PDO($dsn, $user, $password, $options);
    //die("Connexion réussie : " . $connexion->getAttribute(PDO::ATTR_CONNECTION_STATUS));
} catch (PDOException $e) {
    die("Connexion échouée : " . $e->getMessage());
}
?>