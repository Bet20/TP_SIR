<?php
require_once __DIR__ . '/../../../infra/repositories/carRepository.php';
require_once __DIR__ . '/../../../infra/repositories/maintenanceRepository.php';
require_once __DIR__ . '/../../../infra/middlewares/middleware-user.php';
require_once __DIR__ . '../../../../helpers/session.php';

$car = getCarById($_GET['id']);

$title = ' - Veículos';
require_once __DIR__ . '/../../../templates/header-secure.php';
include_once __DIR__ . '/../../../infra/repositories/emailRepository.php';
$render_messages = false;
if ($car['estado'] === 0) {
    $maintenance_data = getMaintenanceByCarId($car['id']);
    $messages = getMessagesByMaintenceId($maintenance_data['id']);
    $render_messages = true;
}
?>

<?php include_once __DIR__ . '/../../../templates/navbar.php' ?>

<div class="container-fluid">
    <section class="py-4">
        <div class="d-flex justify-content">
            <a href="/sir/pages/secure/"><button class="btn btn-secondary px-5 me-2">Voltar</button></a>
        </div>
    </section>

    <div class="row mx-auto justify-content-center gap-3 max-height-50vh">
        <main class="bg-light special-border p-3 col-md-6 col-12">
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
                <?php if(!admin()){?>
                    <div class="row">
                        <div class="col-5">
                            <img class="img-fluid" src="https://live.staticflickr.com/65535/52941868007_113fe37dc3_k.jpg" />
                        </div>
                        <div class="col-5">
                            <div class="d-inline-flex align-items-center">
                                <h3><?= $car['marca'] . ' - ' . $car['modelo'] ?></h3>
                                <div style="color: <?= $car['cor'] ?>" class="ms-2 fs-3 align-items-center float-end">
                                    <i class="fa-solid fa-car-side"></i>
                                </div>
                            </div>
                            <h4 class="text-secondary"><?= $car['matricula'] ?></h4>
                            <p><?= $car['descricao'] ?></p>

                            <div class="d-flex align-self-end">
                                <a href="/sir/controllers/car/car.php?<?= 'car=update&id=' . $car['id'] ?>"><button type="button" class="btn btn-primary me-2">Atualizar</button></a>
                                <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#delete<?= $car['id'] ?>">Apagar</button>
                                <?php if ($car['estado'] === 1) {
                                    echo '<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalCriarMarcacao' . $car["id"] . '">Agendar Manutenção</button>';
                                } else {
                                    echo '<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalListarMarcacao' . $car["id"] . '">Listar Manutenção</button>';
                                } ?>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="row">
                        <div class="col-6 border-end">
                            <h3>Dados da manutenção:</h3>
                            <div>
                                <p>ID do Carro: <?= $maintenance_data['id_car'] ? $maintenance_data['id_car']: 'N/D' ?></p>
                                <p>Data de Início: <?= $maintenance_data['dt_inicio'] ? $maintenance_data['dt_inicio']: 'N/D' ?></p>
                                <p>Data de Fim: <?= $maintenance_data['dt_fim'] ? $maintenance_data['dt_fim']: 'N/D' ?></p>
                                <p>Estado: <?= $maintenance_data['estado'] ? $maintenance_data['estado']: 'N/D' ?></p>
                                <p>Descrição: <?= $maintenance_data['descricao'] ? $maintenance_data['descricao']: 'N/D' ?></p>
                                <p>Preço: <?= $maintenance_data['preco'] ? $maintenance_data['preco']: 'N/D' ?></p>
                            </div>
                        </div>
                        <div class="col-6 border-end">
                            <h3>Formulario:</h3>
                            <!-- TODO -->
                            <form action="" method="post">
                                <label for="estado">Estado:</label>
                                <select 
                                    name="estado" 
                                    id="estado" 
                                    class="form-select" 
                                    aria-label="Default select example"
                                    value="<?= $maintenance_data['estado'] ? $maintenance_data['estado']: '' ?>"
                                >
                                    <?php 
                                        $maintenanceStates = getAllMaintenanceStates();
                                        foreach ($maintenanceStates as $state) {
                                            echo '<option value=$state["id"]>' . $state['nome'] . '</option>';
                                        }
                                    ?>
                                </select>
                                <label for="descricao">Descrição:</label>
                                <input type="text" name="descricao" id="descricao" class="form-control">
                                <label for="preco">Preço:</label>
                                <input type="text" name="preco" id="preco" class="form-control" value="<?= $maintenance_data['preco'] ? $maintenance_data['preco']: '' ?>">
                                <button type="submit" class="btn btn-primary mt-2">Atualizar</button>
                            </form>

                        </div>
                    </div>
                    
                <?php } ?>

                <!-- modal Delete -->
                <div class="modal fade" id="delete<?= $car['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Apagar carro</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Tem a certeza que quer apagar este carro?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="/sir/controllers/car/car.php?<?= 'car=delete&id=' . $car['id'] ?>"><button type="button" class="btn btn-danger">Confirm</button></a>
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


                                    <form action="/sir/controllers/maintenance/maintenance.php" method="post">
                                        <!-- Campos do formulário -->
                                        <div class="mb-3">
                                            <label for="dt_inicio" class="form-label">Data de Início:</label>
                                            <input type="date" class="form-control" id="dt_inicio" name="dt_inicio" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="descricao" class="form-label">Descrição</label>
                                            <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="image_maintenance" class="form-label">Adicionar Imagem</label>
                                            <input class="form-control" type="file" id="image_maintenance" name="image_maintenance">
                                        </div>

                                        <input type="hidden" id="id_user" name="id_user" value="<?= isset($_SESSION['id']) ? $_SESSION['id'] : null ?>">

                                        <input type="hidden" id="id_car" name="id_car" value="<?= $_GET['id'] ?>">
                                        <!-- Adicione outros campos conforme necessário -->

                                        <button type="submit" class="btn btn-primary" name="maintenance" value="create">Agendar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal Manutenção
              <?php $maintenance = getMaintenanceByCarId($car['id']); ?> -->

                <div class="modal fade" id="modalListarMarcacao<?= $car['id'] ?>" tabindex="-1" aria-labelledby="modalMarcacaoLabel" aria-hidden="true">
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
                                        <span id="dt_inicio" name="dt_inicio"><?php /*= isset($maintenance['dt_inicio']) ? $maintenance['dt_inicio'] : 'N/D' */ ?></span>
                                    </div>
                                    <div>
                                        <label for="dt_fim">Data de Fim:</label>
                                        <span id="dt_fim" name="dt_fim"><?php /*= isset($maintenance['dt_fim']) ? $maintenance['dt_fim'] : 'N/D' */ ?></span>
                                    </div>
                                    <div>
                                        <label for="descricao">Descrição:</label>
                                        <span name="descricao" rows="4"><?php /*= isset($maintenance['descricao']) ? $maintenance['descricao'] : 'N/D' */ ?></span>
                                    </div>
                                    <div>
                                        <label for="preco">Preço:</label>
                                        <span id="preco" name="preco"><?php /*= isset($maintenance['preco']) ? $maintenance['preco'] : 'N/D' */ ?></span>
                                    </div>
                                    <div>
                                        <label for="estado">Estado:</label>
                                        <span id="estado" name="estado"><?php /*= isset($maintenance['estado']) ? $maintenance['estado'] : 'N/D' */ ?></span>
                                    </div>
                                    // Adicione outros campos conforme necessário

                                    <button type="submit" class="btn btn-primary">Agendar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </main>
        <?php

        if ($render_messages) {
        ?>
            <div class="card special-border max-height-50vh col-md-4 col-12">
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

                <div class="card-body messages-container overflow-y-auto">
                        <div class="message">
                            <strong class="user"><?php echo 'System'; ?>:</strong>
                            <span class="content"><?php echo 'Chat da Manutenção id_' . $maintenance_data['id']; ?></span>
                        </div>
                    <?php foreach ($messages as $message) : ?>
                        <div class="message">
                            <strong class="user"><?php echo $message['sender']; ?>:</strong>
                            <span class="content"><?php echo $message['mensagem']; ?></span>
                        </div>
                        <?php if (isset($message['image'])) : ?>
                            <div class="align-center">
                                <img src="/<?= $message['image'] ?>" alt="image" width="200" height="200">
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="card-footer">
                    <form enctype="multipart/form-data" action="/sir/controllers/email/email.php?<?= 'id=' . $maintenance_data['id'] ?>" method="post">
                        <div class="input-group">
                            <div class="w-100 d-flex gap-2">
                                <input type="text" class="form-control special-border rounded" placeholder="Digite sua mensagem" name="mensagem">
                                <label type="button" class="btn  special-border">
                                    <i class="fa-solid fa-upload"></i>
                                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="image" style="display: none;">
                                </label>
                                <input type="hidden" id="id_manutencao" name="id_manutencao" value="<?= $maintenance_data['id'] ?>">
                                <input type="hidden" id="data" name="data" value="<?= date('Y-m-d'); ?>">
                                <input type="hidden" id="id_car" name="id_car" value="<?= $car['id'] ?>">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-outline-dark special-border" id="message" name="message" value="send"><i class="fa-solid fa-location-arrow"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        <?php
        }
        ?>
    </div>
</div>
<?php
include_once __DIR__ . '/../../../templates/footer.php'; ?>