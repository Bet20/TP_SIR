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
<main class="min-vh-100 d-flex flex-column justify-content-between">
    <?php include_once __DIR__ . '/../../../templates/navbar.php' ?>

    <div class="container-fluid flex-grow-1">
        <div class="row mx-auto justify-content-center gap-3 max-height-50vh min-height-50vh">
            <div class="col-md-6 col-12 p-0 mt-4">
                <a href="/sir/pages/secure/"><button class="btn btn-secondary px-5">Voltar</button></a>
            </div>
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
            <section class="h-100">
                <div class="row h-100">
                    <div class="col-5">
                        <img class="img-fluid object-contain-cover" src="/sir/assets/images/uploads/cars/<?= $car['foto'] ?>" alt="Car Photo" />
                    </div>

                    <div class="col-5 h-100 d-flex flex-column">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-inline-flex align-items-center">
                                    <h3><?= $car['marca'] . ' - ' . $car['modelo'] ?></h3>
                                    <div style="color: <?= $car['cor'] ?>" class="ms-2 fs-3 align-items-center float-end">
                                        <i class="fa-solid fa-car-side"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <h4 class="text-secondary"><?= $car['matricula'] ?></h4>
                            </div>
                        </div>
                        <div class="col-12 flex-grow-1">
                            <p><?= $car['descricao'] ?></p>
                        </div>
                        <div class="col-12 mt-auto align-self-end">
                            <div class="mt-auto d-flex">
                                <div class="d-flex">
                                    <a href="/sir/controllers/car/car.php?<?= 'car=update&id=' . $car['id'] ?>">
                                        <button type="button" class="btn btn-primary me-2 special-border">Atualizar</button>
                                    </a>
                                    <button type="button" class="btn btn-warning me-2 special-border" data-bs-toggle="modal" data-bs-target="#delete<?= $car['id'] ?>">Apagar</button>
                                    <?php if ($car['estado'] === 1) {
                                        echo '<button type="button" class="btn btn-info special-border" data-bs-toggle="modal" data-bs-target="#modalCriarMarcacao' . $car["id"] . '">Agendar Manutenção</button>';
                                    } else {
                                        echo '<button type="button" class="btn btn-success special-border" data-bs-toggle="modal" data-bs-target="#modalListarMarcacao' . $car["id"] . '">Listar Manutenção</button>';
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

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
                                <a href="/sir/controllers/car/car.php?<?= 'car=delete&id=' . $car['id'] ?>"><button type="button" class="btn btn-danger">Apagar</button></a>
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
              <?php $maintenance = getMaintenanceByCarId($car['id']) ?> -->

                <div class="modal fade" id="modalListarMarcacao<?= $car['id'] ?>" tabindex="-1" aria-labelledby="modalMarcacaoLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Listar Manutenção</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <span class="fw-bold">Data de Início:</span>
                                        <span id="dt_inicio" name="dt_inicio"><?= isset($maintenance['dt_inicio']) ? $maintenance['dt_inicio'] : 'N/D' ?></span>
                                    </div>
                                    <div>
                                        <span class="fw-bold">Data de Fim:</span>
                                        <span id="dt_fim" name="dt_fim"><?= isset($maintenance['dt_fim']) ? $maintenance['dt_fim'] : 'N/D' ?></span>
                                    </div>
                                    <div>
                                        <span class="fw-bold">Descrição:</span>
                                        <span name="descricao" rows="4"><?= isset($maintenance['descricao']) ? $maintenance['descricao'] : 'N/D' ?></span>
                                    </div>
                                    <div>
                                        <span class="fw-bold">Preço:</span>
                                        <span id="preco" name="preco"><?= isset($maintenance['preco']) ? $maintenance['preco'] : 'N/D'?></span>
                                    </div>
                                    <div>
                                        <span class="fw-bold">Estado:</span>
                                        <span id="estado" name="estado"><?= isset($maintenance['estado']) ? $maintenance['estado'] : 'N/D'?></span>
                                    </div>
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
                                <img src="/sir/assets/images/uploads/message/<?= $message['image'] ?>" alt="image" width="200" height="200">
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
                                    <i id="imageUpload" class="fa-solid fa-upload"></i>
                                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="image" style="display: none;" onchange="selectImage()">
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
    <?php include_once __DIR__ . '/../../../templates/footer.php'; ?>
</main>

<script>
    // Adicionar imagem ao input com variável loading a girar
    function selectImage() {
        const imageUpload = document.getElementById('imageUpload');
        imageUpload.classList.remove('fa-upload');
        imageUpload.classList.add('fa-spinner', 'fa-spin');

        const file = document.querySelector('input[type=file]').files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function() {
            setTimeout(() => {
                    imageUpload.classList.remove('fa-spinner', 'fa-spin');
                    imageUpload.classList.add('fa-check', 'text-success');
            }, 500);
            
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>