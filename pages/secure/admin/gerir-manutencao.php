<?php
    require_once __DIR__ . '/../../../infra/repositories/carRepository.php';
    require_once __DIR__ . '/../../../infra/repositories/maintenanceRepository.php';
    require_once __DIR__ . '/../../../infra/middlewares/middleware-user.php';
    require_once __DIR__ . '../../../../helpers/session.php';

    $title = ' - Veículos';
    require_once __DIR__ . '/../../../templates/header-secure.php';
    include_once __DIR__ . '/../../../infra/repositories/emailRepository.php';

    $maintenance_data = getMaintenanceByCarId($car['id']);
    $messages = getMessagesByMaintenceId($maintenance_data['id']);
?>
<div class="row">
    <div class="col-4 border-end">
        <h3>Dados da manutenção:</h3>
        <div>
            <p><b>ID do Carro:</b> <?= $maintenance_data['id_car'] ? $maintenance_data['id_car']: 'N/D' ?></p>
            <p><b>Data de Início:</b> <?= $maintenance_data['dt_inicio'] ? $maintenance_data['dt_inicio']: 'N/D' ?></p>
            <p><b>Data de Fim:</b> <?= $maintenance_data['dt_fim'] ? $maintenance_data['dt_fim']: 'N/D' ?></p>
            <p><b>Estado:</b> <?= $maintenance_data['estado'] ? $maintenance_data['estado']: 'N/D' ?></p>
            <p><b>Descrição:</b> <?= $maintenance_data['descricao'] ? $maintenance_data['descricao']: 'N/D' ?></p>
            <p><b>Preço:</b> <?= $maintenance_data['preco'] ? $maintenance_data['preco'] . '€': 'N/D' ?></p>
        </div>
    </div>
    <div class="col-4 border-end">
        <h3>Formulario:</h3>
        <form action="/sir/controllers/maintenance/maintenance.php" method="post">
            <label for="estado">Estado:</label>
            <select 
                class="form-select" 
                aria-label="Default select example"
                name="estado"
            >
                <?php 
                    $maintenanceStates = getAllMaintenanceStates();
                    foreach ($maintenanceStates as $state) {
                        echo '<option value="' . $state["id"] . '">' . $state['nome'] . '</option>';
                    }
                ?>
            </select>
            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" id="descricao" class="form-control">
            <label for="preco">Preço:</label>
            <input type="number" name="preco" id="preco" class="form-control" value="<?= $maintenance_data['preco'] ? $maintenance_data['preco']: '' ?>">
            <input type="hidden" name="id" id="id" value="<?= $maintenance_data['id'] ? $maintenance_data['id']: '' ?>">
            <input type="hidden" name="id_car" id="id_car" value="<?= $car['id'] ? $car['id'] : '' ?>">
            <button type="submit" class="btn btn-primary mt-2" name="maintenance" value="update">Atualizar</button>
        </form>
    </div>
    <div class="col-4">
    <?php
        if (isset($messages)) {
        ?>
            <div class="card special-border h-100 col-12">
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
                            <strong class="user text-warning"><?php echo 'System'; ?>:</strong>
                            <span class="content"><?php echo 'Chat da Manutenção' ?></span>
                        </div>
                        <hr>
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
                                <label class="btn btn-outline-dark  special-border">
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