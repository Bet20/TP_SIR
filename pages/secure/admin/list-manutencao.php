<?php
require_once __DIR__ . '/../../../infra/middlewares/middleware-user.php';
require_once __DIR__ . '/../../../infra/repositories/carRepository.php';
require_once __DIR__ . '/../../../infra/repositories/maintenanceRepository.php';
require_once __DIR__ . '/../../../infra/repositories/maintenanceRepository.php';
require_once __DIR__ . '/../../../infra/repositories/emailRepository.php';
@require_once __DIR__ . '/../../../helpers/session.php';
$title = ' - APP';
include_once __DIR__ . '/../../../templates/header-secure.php';

$user = user();
$canCreateCar = false;

if ($user['admin'] === 1) {
    if (isset($_GET['search'])) {
        $cars = getAllCarInMaintenanceWithSearchQuery($_GET['search']);
    } else {
        $cars = getAllCarInMaintenance();
    }
} else {
    $cars = getAllCarByUserId($user['id']);
    $canCreateCar = count($cars) < 5;
}

?>

<main class="min-vh-100 d-flex flex-column justify-content-between">
    <?php include_once __DIR__ . '/../../../templates/navbar.php'; ?>
    <section class="flex-grow-1">
        <div class="col-md-8 col-12 mx-auto">
            <h1 class="ms-5 mt-4">Veículos em Manutenção</h1>
        </div>
        <div class="m-4 h-75 overflow-y-auto rounded col-md-8 col-12 mx-auto">
            <table class="table special-border m-0">
                <thead class="table-dark">
                    <tr>
                        <th>Cliente</th>
                        <th>Marca</th>
                        <th>Matricula</th>
                        <th>Estado manutenção</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(count($cars) == 0){
                            echo '<tr><td class="ps-5 fw-bold text-dark" colspan="5">Não existem veículos em manutenção</td></tr>';
                        };
                        // badge rounded-pill text-bg-danger || badge rounded-pill text-bg-warning || badge rounded-pill text-bg-info
                        foreach ($cars as $car) {  $maintenceStatusName = getMaintenanceNameByCarId($car['id']);?>
                        <tr>
                            <th class="align-middle"><?= $car['name'] ?></th>
                            <td class="align-middle"><?= $car['marca'] ?></td>
                            <td class="align-middle"><?= $car['matricula'] ?></td>
                            <td class="align-middle"><div class="
                                <?php
                                    switch ($maintenceStatusName['estadoNome']) {
                                        case "Em Análise":
                                            echo 'badge rounded-pill text-primary info';
                                            break;
                                        case "Aguardando Pagamento":
                                            echo 'badge rounded-pill text-warning warning';
                                            break;
                                        case "Em Manutenção":
                                            echo 'badge rounded-pill text-success success';
                                            break;
                                        default:
                                            echo 'badge rounded-pill text-dark';
                                    }?>">
                                <?= $maintenceStatusName['estadoNome'] ?></div></td>
                            <td>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalManutencao<?= $car['id'] ?>">Gerir Manutenção</button>
                                <!-- Modal Ver Manutenção Admin -->
                                <div class="modal fade" id="modalManutencao<?= $car['id'] ?>" tabindex="-1" aria-labelledby="modalManutencaoLabel<?= $car['id'] ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                include_once __DIR__ . '/gerir-manutencao.php';
                                                ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php
    include_once __DIR__ . '/../../../templates/footer.php';
    ?>

</main>
