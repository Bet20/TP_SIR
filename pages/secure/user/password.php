<?php
$title = ' - Change password';
include_once __DIR__ . '/../../../templates/header.php';
require_once __DIR__ . '/../../../infra/middlewares/middleware-user.php';
@require_once __DIR__ . '/../../../helpers/session.php';
$user = user();
?>

<main class="min-vh-100 d-flex flex-column justify-content-between">
    <?php require_once __DIR__ . '/../../../templates/navbar.php' ?>
    <div class="container">
        <div class="mb-2 text-black">
            <h1>Alterar Password</h1>
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
                    <span class="input-group-text">Nova Password</span>
                    <input type="password" class="form-control" name="password" maxlength="255" size="255" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Confirmar Nova Password</span>
                    <input type="password" class="form-control" name="confirm_password" maxlength="255" required>
                </div>

                <div class="row justify-content-end">
                    <div class="d-grid col-4 ">
                        <a href="/sir/pages/secure/<?= (admin()) ? 'admin' : '' ?>"
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
    <?php
    include_once __DIR__ . '../../../../templates/footer.php';
    ?>
</main>