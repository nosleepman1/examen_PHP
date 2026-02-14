<?php
if(session_status()==PHP_SESSION_NONE)session_start();

$index = true;
include 'header.php'; 
include 'navbar.php';
?>
<main>
    <div class="container">
        <h1>
            Bienvenue 
            
            <?php if(isset( $_SESSION['user_prenom'])) : ?>
                <?= $_SESSION['user_prenom'] ?>  <?= $_SESSION['user_nom'] ?>
                <?php else : ?>
                    invité
            <?php endif;    ?>
            sur L2GL  APP
        </h1>
    </div>
</main>

<?php include 'footer.php'; ?>