<?php 
    if(session_status()==PHP_SESSION_NONE)session_start();

    require '../../database/depense_db.php';

    $categoriesPardepense = getDepensesByUser(intval($_SESSION['user_id']));

   
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
         if(isset($_POST["categories"])) {
            $category = $_POST["categories"];

            if ($category === "all" || $category === "") {
                unset($_SESSION['categories']);
            } else {
                $categoryId = intval($category);
                $categoriesPardepense = getDepensesByUserAndCategorie($_SESSION["user_id"], $categoryId);
                $_SESSION['categories'] = $categoriesPardepense;
            }

            header("Location: /views/depenses/depenses.php");
            exit();
         }

    }