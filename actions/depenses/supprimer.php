<?php 

    require '../../database/depense_db.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
         if (isset($_POST["depense_id"]) && isset($_POST['user_id'])) {
            $user_id = $_POST['user_id'];
            $depense_id = $_POST['depense_id'];

            $result = delete($user_id, $depense_id);

            if ($result) {
                $_SESSION['success'] = 'supression reussie';
                header('Location: /views/depenses/depenses.php');
                exit();
            } else {
                $_SESSION['error'] = 'echec de la suppression';
                header('Location: :views/depenses/depenses.php');
                exit();
        }
        } else {
            $_SESSION['error'] = 'echec de la suppression';
            header('Location: :views/depenses/depenses.php');
            exit();
    }

    } else {
            $_SESSION['error'] = 'echec de la suppression';
            header('Location: :views/depenses/depenses.php');
            exit();
    }