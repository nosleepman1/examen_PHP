<?php 

    require 'db_connection.php';


    function addDepense($motant, $description, $categorie_id, $user_id, $date_depense){
        try{

             global $connexion;
                $sql = 'INSERT INTO depenses (montant, description, categorie_id, user_id, date_depense) VALUES (:montant, :description, :categorie_id, :user_id, :date_depense)';
                $stmt = $connexion->prepare($sql);
            
            //    $stmt->bindParam(':montant', $motant, PDO::PARAM_INT);
            //    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            //    $stmt->bindParam(':category_id', $categorie_id, PDO::PARAM_INT);
            //    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            //    $stmt->bindParam(':date_depense', $date_depense);
            
                return $stmt->execute(
                [
                    'montant'=> $motant,
                    'description'=> $description,
                    'categorie_id'=> $categorie_id,
                    'user_id'=> $user_id,
                    'date_depense'=> $date_depense
                ]
            );       
        } catch(PDOException $e){
            $_SESSION['error'] = $e->getMessage();
            header('Location: /views/depenses/create.php');
            exit();
        }   
    }

    function getDepensesByUser($userId){
        global $connexion;
        $sql = 'SELECT d.id, d.montant, d.date_depense, d.description, c.nom FROM depenses d
                JOIN categories c ON d.categorie_id = c.id
                WHERE user_id=:user_id';
        $stmt = $connexion->prepare($sql);
        $stmt->execute([
            'user_id'=> $userId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function totalDepenses($userId){
        global $connexion;
        $sql = 'SELECT SUM(montant) FROM depenses WHERE ';
    }
function getDepensesByUserAndCategorie($userId, $categorieId){
    global $connexion;
    $sql = 'SELECT d.id, d.montant, d.date_depense, d.description, COALESCE(c.nom, "Non categorisé") AS nom 
            FROM depenses d
            LEFT JOIN categories c ON d.categorie_id = c.id
            WHERE d.user_id=:user_id AND d.categorie_id = :categorie_id';
    $stmt = $connexion->prepare($sql);
    $stmt->execute([
            'user_id'=> $userId,
            'categorie_id'=> $categorieId
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function delete($user_id, $depense_id){
    global $connexion;
    $sql = 'DELETE FROM depenses WHERE user_id= :user_id AND id=:id ';
    $stmt = $connexion->prepare($sql);
    return $stmt->execute([
        'user_id'=> $user_id,
        'id'=> $depense_id
        ]);
}


function sommeParcategorie($userId){
    global $connexion;
     $sql = 'SELECT c.nom, SUM(d.montant) AS montantCategorie FROM depenses d
                JOIN categories c ON d.categorie_id = c.id
                WHERE user_id=:user_id
                GROUP BY c.nom';
                
        $stmt = $connexion->prepare($sql);
        $stmt->execute([
            'user_id'=> $userId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



        