<?php
session_start();
$register = true;

include '../../header.php';
include '../../navbar.php';

$errorMessage = $_SESSION['error'] ?? null;
unset($_SESSION['error']); // Supprimer de la session
?>
<main>
    <div class="container">
        <h1>Créez un compte</h1>
        <?php if (isset($errorMessage)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage ?>
        </div>
        <?php endif ?>
        <form action="/actions/auth/register_action.php" method="POST">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" placeholder="Entrer votre nom" name="nom">
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" placeholder="Entrer votre prénom" name="prenom">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse Email</label>
                <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" placeholder="Votre mot de passe" name="password">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </div>
        </form>
    </div>
</main>

<?php include '../../footer.php'; ?>