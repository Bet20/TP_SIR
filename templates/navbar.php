<?php 
    @require_once __DIR__ . '../../helpers/session.php';
    $user = user();
?>

<header class="p-3 border-bottom d-flex justify-content-between">
    <a href="/sir/pages/secure" class="d-flex align-items-center text-dark text-decoration-none">
        <div class="d-flex flex-column align-items-center">
            <img src="/sir/logo.svg" alt="logo" width="50" height="50">
        </div>
    </a>

    <!-- Dropdown botao login -->
    <div class="dropdown">
        <button class="d-flex align-items-center p-2 btn btn-dark dropdown-toggle" id="dropdownUser"
            data-bs-toggle="dropdown" aria-expanded="false">
            <span class="mx-2">
                <?= $user['name'] ?>
            </span>
            <i class="fa-solid fa-circle-user fs-2 me-2"></i>
        </button>
        <div class="dropdown-menu"> <!-- Add this div container -->
            <?php if (isAuthenticated() && $user['admin']) {
                echo '<li><a class="dropdown-item" href="/sir/pages/secure/admin/list-user.php"><i class="fa-solid fa-circle-user me-2"></i>Gerir Utilizadores</a></li>';
            } ?>
            <li><a class="dropdown-item" href="/sir/pages/secure/user/profile.php"><i class="fas fa-user me-2"></i>Alterar Perfil</a></li>
            <li><a class="dropdown-item" href="/sir/pages/secure/user/password.php"><i class="fas fa-key me-2"></i>Alterar palavra-passe</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <form action="/sir/controllers/auth/signin.php" method="post">
                    <button class="dropdown-item text-danger fw-bold rounded" type="submit" name="user" value="logout"><i class="fa-solid fa-door-open me-2"></i>Logout</button>
                </form>
            </li>
        </div> <!-- Close the div container -->
    </div>
</header>