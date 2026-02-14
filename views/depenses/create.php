    <?php
    session_start();
    $register = true;

    include '../../header.php';
    include '../../navbar.php';

    $errorMessage = $_SESSION['error'] ?? null;
    unset($_SESSION['error']); // Supprimer de la session

    require '../../database/categorie_db.php';
    $categories = getAllCategories();

    ?>
    <main>
        <div class="container">
            <h1>Créez une depense</h1>
        
            <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage ?>
            </div>

            <?php endif ?>
            <form action="/actions/depenses/create_action.php" method="POST">

                <input type="hidden" name="id" value="<?= $_SESSION['user_id'] ?>">
                <div class="mb-3">
                    <label for="montant" class="form-label">Montant</label>
                    <input type="number" class="form-control" id="montant"  placeholder="Entrer le montant" name="montant">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="categories" class="form-label">categories</label>
                    <select name="category" id="" class="form-control">
                        <?php foreach( $categories as $category ): ?>
                        <option value="<?= $category['id'] ?>"> <?= $category['nom'] ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">date</label>
                    <input type="date" name="date" id="date">
                </div>

                <div class="col-12">

                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </main>

    <?php include '../../footer.php'; ?>