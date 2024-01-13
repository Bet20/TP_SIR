<?php
$title = ' - Login';
include_once __DIR__ . '../../../templates/header.php';
require_once __DIR__ . '../../../infra/middlewares/middleware-not-authenticated.php';
?>

<div class="vh-100 d-flex flex-column justify-content-between special-background">
  <main class="d-flex justify-content-center align-items-center h-100">
    <div class="col-md-6 col-10">
      <div>
        <div class="d-flex justify-content-center">
          <img class="logo" src="../../logo.svg">
        </div>
        <div class="d-flex flex-column align-items-center">
          <h1 class="text-white text-shadow">CloudGarage</h1>
        </div>
      </div>
      <form action="/sir/controllers/auth/signin.php" method="post" class=" special-border simple-background p-5">
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
        <h1 class="h3 mb-3 fw-bold text-center">Login</h1>
        <div class="col-12">
          <div class="px-2 py-2">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control special-border" id="email" name="email" required maxlength="255"
            value="<?= isset($_REQUEST['email']) ? $_REQUEST['email'] : null ?>" />
            </div>
        </div>
        <div class="col-12">
          <div class="px-2 py-2">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control special-border" id="password" name="password" required
              maxlength="255" value="<?= isset($_REQUEST['password']) ? $_REQUEST['password'] : null ?>" />
          </div>
        </div>
        <a href="/sir/pages/public/signup.php" class="text-center col-12">Não tem conta?</a>
        <div class="row justify-content-between mt-3 px-4">
          <button class="btn btn-lg  special-border btn-success col-md-4 col-12 my-2" type="submit" name="user"
            value="login"><b class="text-dark">Login</b></button>
          <a href="/sir/" class="btn btn-lg  special-border btn-secondary col-md-4 col-12 my-2">Voltar</a>
        </div>
      </form>
    </div>
  </main>
<?php
include_once __DIR__ . '../../../templates/footer.php';
?>