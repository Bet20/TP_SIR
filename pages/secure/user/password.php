<?php
$title = ' - Change password';
include_once __DIR__ . '/../../../templates/header.php';
require_once __DIR__ . '/../../../infra/middlewares/middleware-user.php';
@require_once __DIR__ . '/../../../helpers/session.php';

$user = user();
?>

    <main>

        <header class="p-3 border-bottom d-flex justify-content-between">
            <a href="/sir/pages/secure" class="d-flex align-items-center text-dark text-decoration-none">

                <div class="d-flex flex-column align-items-center">
                    <img src="/sir/logo.svg" alt="logo" width="50" height="50">

                </div>
            </a>

            <!-- Dropdown botao login -->
            <div class="dropdown">
                <button class="d-flex align-items-center p-2 btn dropdown-toggle" id="dropdownUser"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="mx-2"><?= $user['name'] ?></span>
                    <i class="fa-solid fa-circle-user fs-2 me-2"></i>
                </button>
                <ul class="dropdown-menu">
                    <?php if (isAuthenticated() && $user['admin']) {
                        echo '<li><a class="dropdown-item" href="/sir/pages/secure/admin/"><i class="fa-solid fa-circle-user  me-2"></i>Gerir Utilizadores</a></li>';
                    } ?>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="/sir/controllers/auth/signin.php" method="post">
                            <button class="dropdown-item text-danger fw-bold rounded" type="submit" name="user"
                                    value="logout"><i class="fa-solid fa-door-open me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </header>

        <div class="container mt-3">
            <div class="mb-3 text-black">
                <h1>Edit your profile</h1>
            </div>

            <section>
                <?php
                if (isset($_SESSION['success'])) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                    echo $_SESSION['success'] . '<br>';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    unset($_SESSION['success']);
                }
                if (isset($_SESSION['errors'])) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                    foreach ($_SESSION['errors'] as $error) {
                        echo $error . '<br>';
                    }
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    unset($_SESSION['errors']);
                }
                ?>
            </section>
            <section>
                <form action="/sir/controllers/admin/user.php" method="post" class="form-control py-3 special-border">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Name</span>
                        <input type="text" readonly class="form-control" name="name" placeholder="<?= $user['name'] ?>"
                               value="<?= $user['name'] ?>">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Password</span>
                        <input type="password" class="form-control" name="password" maxlength="255" size="255" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Confirm Password</span>
                        <input type="password" class="form-control" name="confirm_password" maxlength="255" required>
                    </div>

                    <div class="row justify-content-end">
                        <div class="d-grid col-4 ">
                            <a href="/sir/pages/secure/user/profile.php"
                               class="btn btn-md btn-warning special-border mb-2" type="submit">
                                Cancel
                            </a>
                        </div>
                        <div class="d-grid col-4">
                            <button class="btn btn-md btn-success special-border mb-2" type="submit" name="user"
                                    value="password">Confirm
                            </button>
                        </div>
                    </div>

                </form>
            </section>
        </div>
    </main>
<?php
include_once __DIR__ . '../../../../templates/footer.php';
?>