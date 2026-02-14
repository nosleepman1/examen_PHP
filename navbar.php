 <header data-bs-theme="dark">
     <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
         <div class="container-fluid"> <a class="navbar-brand" href="#">L2GL APP</a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
             <div class="collapse navbar-collapse" id="navbarCollapse">
                 <ul class="navbar-nav me-auto mb-2 mb-md-0">
                     <li class="nav-item"> <a class="nav-link <?= $index ? 'active' : '' ?>" aria-current="page" href="/index.php">Accueil</a> </li>
                     <?php if (!isset($_SESSION['user_id'])): ?>
                         <li class="nav-item"> <a class="nav-link <?php echo $login ? 'active' : '' ?>" href="/views/auth/login.php">Connexion</a> </li>
                         <li class="nav-item"> <a class="nav-link <?php echo $register ? 'active' : '' ?>" href="/views/auth/register.php">Inscription</a> </li>
                         <?php else: ?> ?>
                         <li class="nav-item"> <a class="nav-link <?php echo $depenses ? 'active' : '' ?>" href="/views/depenses/depenses.php">Depenses</a> </li>
                     <?php endif ?>
                 </ul>
                 <?php if (isset($_SESSION['user_id'])): ?>
                     <form action="/actions/auth/logout_action.php" class="d-flex">
                         <button class="btn btn-outline-danger" type="submit">
                             Déconnexion
                         </button>
                     </form>
                 <?php endif ?>
             </div>
         </div>
     </nav>
 </header>