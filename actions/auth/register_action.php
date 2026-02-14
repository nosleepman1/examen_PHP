<?php
session_start();

require '../../database/user_db.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_POST["nom"]) &&
    !empty($_POST["prenom"]) &&
    !empty($_POST["email"]) && !empty($_POST["password"])){

    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    //Verification
    if(!getUserByEmail($email)){
        registerUser($nom, $prenom, $email, $password);
        header('Location: /views/auth/login.php');
        exit();
    }else $_SESSION['error'] = "Cet email appartient à un autre utilisateur!";

    } else $_SESSION['error'] = "Veuillez remplir tous les champs!";
}

header('Location: /views/auth/register.php');
exit();