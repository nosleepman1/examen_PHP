<?php
require 'db_connection.php';

function getUserByEmail($email) {
    global $connexion;
    $sql = "SELECT * FROM users WHERE email=:email";
    $stmt = $connexion->prepare($sql);
    
    $stmt->execute([':email' => $email]);

    return $stmt->fetch();
}

function registerUser($nom, $prenom, $email, $password) {
    global $connexion;
    $sql = "INSERT INTO users(nom, prenom, email, password) VALUES(:nom, :prenom, :email, :password)";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":prenom", $prenom);
    $stmt->bindParam(":email", $email);
    
    //Hachage mot de passe
    $passwordHash = password_hash($password , PASSWORD_BCRYPT);
    $stmt->bindParam(":password", $passwordHash);

    return $stmt->execute();
}