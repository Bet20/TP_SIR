<?php
$title = ' - Admin';
require_once __DIR__ . '/../../../templates/header-secure.php';
require_once __DIR__ . '/../../../infra/repositories/userRepository.php';
require_once __DIR__ . '/../../../infra/middlewares/middleware-admin.php';

$users = getAll();
?>
<main class="min-vh-100 d-flex flex-column justify-content-between">
  <?php require_once __DIR__ . '/../../../templates/navbar.php' ?>

  <div class="mt-4 container flex-grow-1">
    <div class="p-3 mb-2 bg-dark text-white rounded">
      <h1>Utilizadores</h1>
    </div>

    <section class="bg-light">
      <section class="py-4">
        <div class="d-flex justify-content">
          <a href="/sir/pages/secure/admin"><button class="btn btn-secondary px-5 me-2 special-border">Voltar</button></a>
          <a href="./user.php"><button class="btn btn-success px-4 me-2 special-border">Criar utilizador</button></a>
        </div>
      </section>
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
        <div class="table-responsive bg-white">
          <table class="table">
            <thead class="table-secondary bg-white">
              <tr class="bg-white">
                <th scope="col">Nome</th>
                <th scope="col">Telemóvel</th>
                <th scope="col">Email</th>
                <th scope="col">Admin</th>
                <th scope="col">Opções</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($users as $user) {
              ?>
                <tr>
                  <th scope="row">
                    <?= $user['name'] ?>
                  </th>
                  <td>
                    <?= isset($user['telemovel']) ? $user['telemovel'] : 'N/D' ?>
                  </td>
                  <td>
                    <?= $user['email'] ?>
                  </td>
                  <td>
                    <?= $user['admin'] == '1' ? 'Yes' : 'No' ?>
                  </td>
                  <td>
                    <div class="d-flex justify-content">
                      <a href="/sir/controllers/admin/user.php?<?= 'user=update&id=' . $user['id'] ?>"><button type="button" class="btn btn-info special-border me-2">Atualizar</button></a>
                      <button type="button" class="btn btn-danger special-border" data-bs-toggle="modal" data-bs-target="#delete<?= $user['id'] ?>">Apagar</button>
                    </div>
                  </td>
                </tr>
                <div class="modal fade" id="delete<?= $user['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Apagar utilizador</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Tem a certeza que deseja apagar o utilizador <i class="fw-bold"><?= $user['name'] ?></i>?
                      </div>
                      <div class="modal-footer">
                        <a href="/sir/controllers/admin/user.php?<?= 'user=delete&id=' . $user['id'] ?>"><button type="button" class="btn btn-danger">Confirm</button></a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </section>
    </section>
  </div>
  <?php
  include_once __DIR__ . '/../../../templates/footer.php';
  ?>
</main>