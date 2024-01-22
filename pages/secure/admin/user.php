<?php

$title = ' - Admin';
require_once __DIR__ . '/../../../templates/header-secure.php'; 
require_once __DIR__ . '/../../../infra/middlewares/middleware-admin.php';

if(isset($_GET['id'])){
  $userObtido = getById($_GET['id']);
}

?>


<main class="min-vh-100 d-flex flex-column justify-content-between">
  <?php require_once __DIR__ . '/../../../templates/navbar.php' ?>
  <div class="flex-grow-1">
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
    <section class="pb-4 container">
      <section class="py-4">
        <a href="/sir/pages/secure/admin/list-user.php"><button type="button" class="btn btn-secondary special-border px-5">Voltar</button></a>
      </section>
      <form enctype="multipart/form-data" action="/sir/controllers/admin/user.php" method="post"
        class="form-control special-border py-3">
        <div class="row">
          <div class="col-md-4">
            <label id="labelFoto" for="foto" class="d-flex align-items-center justify-content-center border h-100 w-100">
                <img id="preview" src="/sir/assets/images/uploads/users/<?= $userObtido['foto'] ?>" alt="foto" class="img-fluid d-block <?= !isset($userObtido['foto']) ? 'd-none' : '' ?>" style="max-height: 260px;">
                <i id="noImage" class="fa-solid fa-circle-user fs-2 me-2 <?= isset($userObtido['foto']) ? 'd-none' : '' ?>"></i>
                <input type="file" id="foto" name="foto" accept="image/*" class="d-none" onchange="previewImage()">
            </label>
          </div>
          <div class="col-md-8">   
            <div class="input-group mb-3">
              <span class="input-group-text">Name</span>
              <input type="text" class="form-control" name="name" maxlength="100" size="100"
              value="<?= isset($_REQUEST['name']) ? $_REQUEST['name'] : null ?>" required>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">Telemóvel</span>
              <input type="tel" class="form-control" name="telemovel" maxlength="9"
              value="<?= isset($_REQUEST['telemovel']) ? $_REQUEST['telemovel'] : null ?>">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">E-mail</span>
              <input type="email" class="form-control" name="email" maxlength="255"
              value="<?= isset($_REQUEST['email']) ? $_REQUEST['email'] : null ?>" required>
            </div>
              <div class="input-group mb-3">
                <span class="input-group-text">Password</span>
                <input type="text" class="form-control" name="password" maxlength="255" 
                  <?php if(!(isset($_REQUEST['action']) && $_REQUEST['action'] == 'update')){
                      echo 'required';
                    }
                  ?>
                >
              </div>
            <div class="input-group mb-3">
              <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" name="admin" role="switch" id="flexSwitchCheckChecked"
                <?= isset($_REQUEST['admin']) && $_REQUEST['admin'] == true ? 'checked' : null ?>>
                <label class="form-check-label" for="flexSwitchCheckChecked">admin</label>
              </div>
            </div>
          </div>
        </div>
        <div class="d-grid col-4 mx-auto">
          <input type="hidden" name="id" value="<?= isset($_REQUEST['id']) ? $_REQUEST['id'] : null ?>">
          <?php 
            if((isset($_REQUEST['action']) && $_REQUEST['action'] == 'update')){
              echo '<button type="submit" class="btn btn-success special-border" name="user" value="update">Atualizar</button>';
            } else {
              echo '<button type="submit" class="btn btn-success special-border" name="user" value="create">Criar</button>';
            }
          ?>
        </div>
      </form>
    </section>
  </div>
  <?php
    require_once __DIR__ . '/../../../templates/footer.php';
  ?>
</main>


<script>
    //Esta função serve para trocar o src da img
    function previewImage() {
        var input = document.getElementById('foto');

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                var foto = <?php echo json_encode(isset($userObtido['foto'])); ?>;
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