<?php
$title = ' - Profile';
include_once __DIR__ . '../../../../templates/header-secure.php';
@require_once __DIR__ . '/../../../helpers/session.php';

$user = user();
?>
    <main>

        <?php require_once __DIR__ . '/../../../templates/navbar.php' ?>

        <div class="container mt-3">
            <div class="mb-3 text-black">
                <h1>Alterar Perfil</h1>
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
                    ;
                }
                ?>
            </section>
            <section>
                <form enctype="multipart/form-data" action="/sir/controllers/admin/user.php" method="post"
                      class="form-control py-3 special-border">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Name</span>
                        <input type="text" class="form-control" name="name" placeholder="name" maxlength="100"
                               size="100"
                               value="<?= isset($_REQUEST['name']) ? $_REQUEST['name'] : $user['name'] ?>" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Telemóvel</span>
                        <input type="tel" class="form-control" name="telemovel" maxlength="9"
                               value="<?= isset($_REQUEST['telemovel']) ? $_REQUEST['telemovel'] : $user['telemovel'] ?>"
                               required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">email</span>
                        <input type="email" class="form-control" name="email" maxlength="255"
                               value="<?= isset($_REQUEST['email']) ? $_REQUEST['email'] : $user['email'] ?>" required>
                    </div>
                    <!-- <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupFile01">Picture</label>
                        <input accept="image/*" type="file" class="form-control" id="inputGroupFile01" name="foto"/>
                    </div> -->
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <div class="d-flex mb-3">
                        <div class="input-group">
                            <label class="input-group-text" for="inputGroupFile01">Password</label>
                            <input type="password" class="form-control" name="password" value="123456"
                                   maxlength="255"
                                   disabled
                                   readonly>
                        </div>
                        <a class="float-right ms-2 text-nowrap btn special-border px-2" href="./password.php">
                            Change Password
                        </a>
                    </div>

                    <div class="row justify-content-end">
                        <div class="d-grid col-4 ">
                            <a href="/sir/pages/secure"
                               class="btn btn-md btn-warning special-border mb-2" type="submit">
                                Cancel
                            </a>
                        </div>
                        <div class="d-grid col-4 ">
                            <button class="btn btn-md btn-success special-border mb-2" type="submit" name="user"
                                    value="profile">
                                Confirm
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