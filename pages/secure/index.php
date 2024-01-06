<?php
require_once __DIR__ . '../../../infra/middlewares/middleware-user.php';
@require_once __DIR__ . '/../../helpers/session.php';

$user = user();
$title = ' - APP';
include_once __DIR__ . '../../../templates/header.php';
?>

<main>
    <header class="p-3 border-bottom special-background d-flex justify-content-between">
        <a href="/sir/pages/secure" class="d-flex align-items-center text-dark text-decoration-none">
            <div class="d-flex flex-column align-items-center">
                <h3 class="text-white text-shadow m-0">CloudGarage</h3>
            </div>
        </a>
        
        <!-- Dropdown botao login -->
        <div class="dropdown">
            <button class="d-flex align-items-center p-2 btn btn-outline-light dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="mx-2"><?= $user['name'] ?></span>
                <i class="fa-solid fa-circle-user fs-2 me-2"></i>
            </button>
            <ul class="dropdown-menu">
            <?php if (isAuthenticated() && $user['admin']) {
                echo '<li><a class="dropdown-item" href="/sir/pages/secure/admin/"><i class="fa-solid fa-circle-user  me-2"></i>Gerir Utilizadores</a></li>';
            } ?>
                <li><hr class="dropdown-divider"></li>
                <li> 
                    <form action="/sir/controllers/auth/signin.php" method="post">
                        <button class="dropdown-item text-danger fw-bold rounded" type="submit" name="user" value="logout"><i class="fa-solid fa-door-open me-2"></i>Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </header>
    <!-- Menus -->
    <div>
        <a class="d-flex align-items-center p-2 btn btn-secondary special-border" href="/sir/pages/secure/car/car.php">
            <span class="mx-2">Veículos</span>
            <i class="fa-solid fa-car-side"></i>
        </a>
    </div>
    
    <div class="d-flex align-items-stretch">
        <div class="col-md-6 px-2">
            <div class="h-100 p-5 text-bg-dark rounded-3">
                <h2>Profile</h2>
                <a href="/sir/pages/secure/user/profile.php"><button class="btn btn-outline-light px-5"
                        type="button">Change</button></a>
            </div>
        </div>
        <?php
        if (isAuthenticated() && $user['admin']) {
            echo '<div class="col-md-6 px-2">
                    <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                        <h2>Admin</h2>
                        <a href="/sir/pages/secure/admin/"><button class="btn btn-outline-success" type="button">Admin</button></a>
                    </div>
                </div>';
        }
        ?>
    </div>
</main>

<?php
include_once __DIR__ . '../../../templates/footer.php';
?>