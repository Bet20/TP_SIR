<?php
$title = ' - Profile';
include_once __DIR__ . '../../../../templates/header-secure.php';
@require_once __DIR__ . '/../../../helpers/session.php';

$user = user();
?>
<main class="min-vh-100 d-flex flex-column justify-content-between">
    <?php require_once __DIR__ . '/../../../templates/navbar.php' ?>

    <div class="container">
        <div class="mb-2 text-black">
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
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';;
            }
            ?>
        </section>
        <section>
            <form enctype="multipart/form-data" action="/sir/controllers/admin/user.php" method="post" class="form-control py-3 special-border">
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label id="labelFoto" for="foto" class="d-flex align-items-center justify-content-center border h-100">
                            <img id="preview" src="/sir/assets/images/uploads/users/<?= $user['foto'] ?>" alt="foto" height="200" class="<?= !isset($user['foto']) ? 'd-none' : '' ?>">
                            <i id="noImage" class="fa-solid fa-circle-user fs-2 me-2  <?= isset($user['foto']) ? 'd-none' : '' ?>" ></i>
                            <input type="file" id="foto" name="foto" accept="image/*" class="d-none" onchange="previewImage()">
                        </label>
                    </div>
                    <div class="col-sm-8 h-100">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Name</span>
                            <input type="text" class="form-control" name="name" placeholder="name" maxlength="100" size="100" value="<?= isset($_REQUEST['name']) ? $_REQUEST['name'] : $user['name'] ?>" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Telemóvel</span>
                            <input type="tel" class="form-control" name="telemovel" maxlength="9" placeholder="<?= !isset($_REQUEST['telemovel']) ? 'N/D' : '' ?>" value="<?= isset($_REQUEST['telemovel']) ? $_REQUEST['telemovel'] : $user['telemovel'] ?>">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">email</span>
                            <input type="email" class="form-control" name="email" maxlength="255" value="<?= isset($_REQUEST['email']) ? $_REQUEST['email'] : $user['email'] ?>" required>
                        </div>
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <div class="d-flex">
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupFile01">Password</label>
                                <input type="password" class="form-control" name="password" disabled readonly>
                            </div>
                            <a class="float-right ms-2 text-nowrap btn special-border px-2" href="./password.php">
                                Change Password
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="d-grid col-6">
                        <a href="/sir/pages/secure/<?= (admin()) ? 'admin' : '' ?>" class="btn btn-md btn-warning special-border mb-2" type="submit">
                            Cancel
                        </a>
                    </div>
                    <div class="d-grid col-6">
                        <button class="btn btn-md btn-success special-border mb-2" type="submit" name="user" value="profile">
                            Confirm
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

<script>
    //Esta função serve para trocar o src da img
    function previewImage() {
        var input = document.getElementById('foto');

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                var foto = <?php echo json_encode(isset($user['foto'])); ?>;
                //Para ver o preview caso não tenha foto
                if(!foto){
                    document.getElementById('noImage').classList.add('d-none');
                    document.getElementById('preview').classList.remove('d-none');
                }

                document.getElementById('preview').src = e.target.result;
                document.getElementById('labelFoto').classList.add('border-warning', 'bg-warning-subtle');
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>