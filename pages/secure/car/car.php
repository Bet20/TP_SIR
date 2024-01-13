<?php
require_once __DIR__ . '/../../../infra/repositories/carRepository.php';
require_once __DIR__ . '/../../../infra/repositories/maintenanceRepository.php';
require_once __DIR__ . '/../../../infra/middlewares/middleware-user.php';

$car = getCarById($_GET['id']);

$title = ' - Veículos';
require_once __DIR__ . '/../../../templates/header.php'; 
?>

<?= include_once __DIR__ . '/../../../templates/navbar.php' ?>

<div class="container">
    <section class="py-4">
      <div class="d-flex justify-content">
        <a href="/sir/pages/secure/"><button class="btn btn-secondary px-5 me-2">Voltar</button></a>

      </div>
    </section>


  <main class="bg-light special-border p-3">
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
    <section>

        <div class="row">
            <div class="col-5">
                <img class="img-fluid" src="https://live.staticflickr.com/65535/52941868007_113fe37dc3_k.jpg"/>
            </div>
            <div class="col-5">
                <div class="d-inline-flex align-items-center">
                    <h3><?=$car['marca'] . ' - ' . $car['modelo']?></h3>
                    <div style="color: <?= $car['cor'] ?>" class="ms-2 fs-3 align-items-center float-end">
                        <i class="fa-solid fa-car-side"></i>
                    </div>
                </div>
                <h4 class="text-secondary"><?=$car['matricula']?></h4>
                <p><?=$car['descricao']?></p>

                <div class="d-flex align-self-end">
                    <a href="/sir/controllers/car/car.php?<?= 'car=update&id=' . $car['id'] ?>"><button type="button"
                                                                                                        class="btn btn-primary me-2">Atualizar</button></a>
                    <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal"
                            data-bs-target="#delete<?= $car['id'] ?>">Apagar</button>
                    <?php if($car['estado'] === 1){
                        echo '<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalCriarMarcacao' . $car["id"] . '">Agendar Manutenção</button>';
                    }else {
                        echo '<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalListarMarcacao' . $car["id"] . '">Listar Manutenção</button>';
                    } ?>
                </div>
            </div>

            <div>

            </div>
        </div>




        <!-- modal Delete -->
        <div class="modal fade" id="delete<?= $car['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Apagar carro</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Tem  a certeza que quer apagar este carro?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="/sir/controllers/car/car.php?<?= 'car=delete&id=' . $car['id'] ?>"><button type="button"
                                                                                                            class="btn btn-danger">Confirm</button></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal Manutenção -->
        <div class="modal fade" id="modalCriarMarcacao<?= $car['id'] ?>" tabindex="-1" aria-labelledby="modalMarcacaoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Agendar Manutenção</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="processar_agendamento.php" method="post">
                                <!-- Campos do formulário -->
                                <div>
                                    <label for="dt_inicio">Data de Início:</label>
                                    <input type="date" id="dt_inicio" name="dt_inicio" required>
                                </div>
                                <div>
                                    <label for="dt_fim">Data de Fim:</label>
                                    <input type="date" id="dt_fim" name="dt_fim">
                                </div>
                                <div>
                                    <label for="descricao">Descrição:</label>
                                    <textarea id="descricao" name="descricao" rows="4"></textarea>
                                </div>
                                <div>
                                    <label for="preco">Preço:</label>
                                    <input type="number" id="preco" name="preco">
                                </div>
                                <div>
                                    <label for="estado">Estado:</label>
                                    <span id="estado" name="estado"><?= isset($car['estado']) ? $car['estado'] : null ?></span>
                                </div>
                                <input type="hidden" id="id_user" name="id_user" value="<?= isset($_SESSION['id']) ? $_SESSION['id'] : null ?>">
                                <input type="hidden" id="estado" name="estado" value="0">

                                <!-- Adicione outros campos conforme necessário -->

                                <button type="submit" class="btn btn-primary">Agendar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal Manutenção
              <?php $maintenance = getMaintenanceByCarId($car['id']);?> -->

        <!--   <div class="modal fade" id="modalListarMarcacao<?php /*= $car['id'] */?>" tabindex="-1" aria-labelledby="modalMarcacaoLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title">Listar Manutenção</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                                <div class="modal-body">
                                  // Campos do formulário
                                  <div>
                                      <label for="dt_inicio">Data de Início:</label>
                                      <span id="dt_inicio" name="dt_inicio"><?php /*= isset($maintenance['dt_inicio']) ? $maintenance['dt_inicio'] : 'N/D' */?></span>
                                  </div>
                                  <div>
                                      <label for="dt_fim">Data de Fim:</label>
                                      <span id="dt_fim" name="dt_fim"><?php /*= isset($maintenance['dt_fim']) ? $maintenance['dt_fim'] : 'N/D' */?></span>
                                  </div>
                                  <div>
                                      <label for="descricao">Descrição:</label>
                                      <span name="descricao" rows="4"><?php /*= isset($maintenance['descricao']) ? $maintenance['descricao'] : 'N/D' */?></span>
                                  </div>
                                  <div>
                                      <label for="preco">Preço:</label>
                                      <span id="preco" name="preco"><?php /*= isset($maintenance['preco']) ? $maintenance['preco'] : 'N/D' */?></span>
                                  </div>
                                  <div>
                                      <label for="estado">Estado:</label>
                                      <span id="estado" name="estado"><?php /*= isset($maintenance['estado']) ? $maintenance['estado'] : 'N/D' */?></span>
                                  </div>
                                  // Adicione outros campos conforme necessário

                                  <button type="submit" class="btn btn-primary">Agendar</button>
                                </div>
                          </div>
                      </div>
                  </div>
              </div>-->

    </section>
  </main>
</div>
<?php
include_once __DIR__ . '/../../../templates/footer.php'; ?>