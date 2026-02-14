<?php
session_start();

require '../../database/user_db.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_POST["email"]) && !empty($_POST["password"])){

    $email = $_POST["email"];
    $password = $_POST["password"];
    //Verification
    $user = getUserByEmail($email);
    if($user){
        if(password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nom'] = $user['nom'];
            $_SESSION['user_prenom'] = $user['prenom'];
            header('Location: /index.php');
            exit();
        }else $_SESSION['error'] = "Mot de passe incorrecte";
        
    }else $_SESSION['error'] = "Cet email n'existe pas";

    } else $_SESSION['error'] = "Veuillez remplir tous les champs!";
}

header('Location: /views/auth/login.php');
exit();