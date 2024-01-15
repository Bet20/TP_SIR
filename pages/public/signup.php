<?php
$title = ' - Login';
include_once __DIR__ . '../../../templates/header.php';
require_once __DIR__ . '../../../infra/middlewares/middleware-not-authenticated.php';
?>

<div class="vh-100 d-flex flex-column justify-content-between special-background">
  <main class="d-flex justify-content-center h-100">
    <div class="col-md-6 col-10">
      <div>
        <div class="d-flex justify-content-center">
          <img class="logo" src="../../logo.svg">
        </div>
      </div>
      <form action="/sir/controllers/auth/signup.php" method="post" class=" special-border simple-background p-3">
        <section>
          <?php
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
        <h1 class="text-white text-shadow text-center">CloudGarage</h1>
        <hr>
        <div class="col-12">
          <div class="px-2 py-2">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control special-border" id="email" name="email" required maxlength="255"
            value="<?= isset($_REQUEST['email']) ? $_REQUEST['email'] : null ?>" />
            </div>
        </div>
        <div class="col-12">
          <div class="px-2 py-2">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control special-border" id="name" name="name" required maxlength="255"
            value="<?= isset($_REQUEST['name']) ? $_REQUEST['name'] : null ?>" />
            </div>
        </div>
        <div class="col-12">
          <div class="px-2 py-2">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control special-border" id="password" name="password" required
              maxlength="255" value="<?= isset($_REQUEST['password']) ? $_REQUEST['password'] : null ?>" />
          </div>
        </div>
        <div class="col-12">
          <div class="px-2 py-2">
            <label for="confirm_password" class="form-label">Confirmar Password</label>
            <input type="password" class="form-control special-border" id="confirm_password" name="confirm_password" required maxlength="255"
            value="<?= isset($_REQUEST['confirm_password']) ? $_REQUEST['confirm_password'] : null ?>" />
            </div>
        </div>
        <a href="/sir/pages/public/signin.php" class="text-center col-12">Já tem conta?</a>
        <div class="row justify-content-between mt-3 px-4">
          <button class="btn special-border btn-success col-md-4 col-12 my-2" type="submit" name="user"
            value="signUp"><b class="text-dark">Criar conta</b></button>
          <a href="/sir/" class="btn special-border btn-secondary col-md-4 col-12 my-2">Voltar</a>
        </div>
      </form>
    </div>
  </main>
</div>
<?php
include_once __DIR__ . '../../../templates/footer.php';
?>