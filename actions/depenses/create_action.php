    <?php

    if(session_status()==PHP_SESSION_NONE)session_start();

    require '../../database/depense_db.php';

        if($_SERVER["REQUEST_METHOD"] == "POST") {
        
            if(!empty($_POST["montant"]) &&
            !empty($_POST["description"]) &&
            !empty($_POST["category"]) && !empty($_POST["date"])){

        
            $montant = $_POST["montant"];
            $description = $_POST["description"];
            $category = $_POST["category"];
            $date = $_POST["date"];
            $id = $_POST["id"];
            

            if ($montant <= 0) {
                $_SESSION["error"] = "montant doit etre une valeur positive";
                header("Location: /views/depenses/create");
                exit();
            }

            if(strlen($description) > 255) {
                 $_SESSION["error"] = "description doit etre inferieur à 255";
                header("Location: /views/depenses/create");
                exit();
                }

            $result = addDepense($montant, $description, $category,$id, $date);
            if($result) {
                $_SESSION['success'] = 'depense ajouté avec success';
                header('Location: /views/depenses/depenses.php');
                exit();
            } else {
                $_SESSION['error'] = 'echec de la creation de cette depense';
                header('Location: /views/depenses/create.php');
                exit();
            }
            } else {
                 $_SESSION["error"] = "veuillez remplir tous les champs";
                header("Location: /views/depenses/create.php");
                exit();
            }
    }
    header('Location: /views/auth/register.php');
    exit();