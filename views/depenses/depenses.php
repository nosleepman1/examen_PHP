<?php
        
        if(session_status()==PHP_SESSION_NONE)session_start();
        $depenses = true;

        include '../../header.php';
        include '../../navbar.php';

        $errorMessage = $_SESSION['error'] ?? null;
        unset($_SESSION['error']); // Supprimer de la session

        //require '../../database/depense_db.php';
        require '../../database/categorie_db.php';

        $categories = getAllCategories();

        require  '../../actions/depenses/filtre.php';

        $depenses = $categoriesPardepense;
        if (isset($_SESSION['categories'])) {
            if (is_array($_SESSION['categories'])) {
                $depenses = $_SESSION['categories'];
            } else {
                unset($_SESSION['categories']);
            }
        }
        if (!is_array($depenses)) {
            $depenses = [];
        }

        //$depenses = getDepensesByUser($_SESSION['user_id']);
        $sommeCategories = sommeParcategorie($_SESSION['user_id']);

        $totalMontant = 0;
        if($depenses) {
            foreach($depenses as $depen) {
                $totalMontant += floatval($depen['montant']);
            }
        }


   
?>
    <main>
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Mes depenses depense</h1>
                <div>
                    <a href="/views/depenses/create.php" class="btn btn-primary">Ajouter une depenses</a>
                </div>
            </div>

            <form method="post" class="d-flex gap-3">
                <div class="">
                <select name="categories" id="" class="form-control">
                    <option value="all">Toutes les depenses</option>
                    <?php foreach($categories as $category) : ?>
                        <option value="<?= $category['id'] ?>"><?= $category['nom'] ?></option>
                    <?php endforeach ; ?>
                </select>
                </div>
                <button type="submit" class="btn btn-dark disable">Filtrer</button>
            </form>

            <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage ?>
            </div>
            <?php endif ?>

            
            

            <?php if (!$depenses): ?>
                <h1>Pas de depense</h1>

                <?php else: ?>
                    <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td>Date</td>
                            <td>Description</td>
                            <td>Categories</td>
                            <td>Montant</td>
                            <td>action</td>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach( $depenses as $depense): ?>
                            <tr>
                                <td><?= $depense['date_depense'] ?></td>
                                <td><?= $depense['description'] ?></td>
                                <td><?= $depense['nom'] ?></td>
                                <td><?= $depense['montant'] ?></td>
                                <td>
                                    <form action="/actions/depenses/supprimer.php" method="post">
                                        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                                        <input type="hidden" name="depense_id" value="<?= $depense['id'] ?>" >
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    
                </table>
            <?php endif ?>
                <h1>Total depenses : <?= number_format($totalMontant, 2, '.', ' ') ?> FCFA</h1>

                <h3 class="mt-4">Sommes par categories</h3>
                <?php foreach ($sommeCategories as $sommeCategory): ?>
                    <p><b> <?= $sommeCategory['nom'] ?></b> : <?= $sommeCategory['montantCategorie'] ?></p>
                <?php endforeach; ?>
        </div>
    </main>

    <?php include '../../footer.php'; ?>