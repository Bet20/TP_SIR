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

<main>
    <?php include_once __DIR__ . '/../../../templates/navbar.php'; ?>

    <h1>Veículos em Manutenção</h1>
<?php if ($user['admin'] === 1) { ?>
    <div class="special-border p-4 h-75 overflow-y-auto ">
        <table class="table">
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Matricula</th>
                    <th>Cliente</th>
                    <th>Estado manutenção</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if(count($cars) == 0){
                        echo '<tr><td class="ps-5 fw-bold text-primary" colspan="5">Não existem veículos em manutenção</td></tr>';
                    };
                    
                    foreach ($cars as $car) {  $maintenceStatusName = getMaintenanceNameByCarId($car['id']);?>
                    <tr >
                        <td><?= $car['marca'] ?></td>
                        <td><?= $car['matricula'] ?></td>
                        <td><?= $car['name'] ?></td>
                        <td><?= $maintenceStatusName['estadoNome'] ?></td>
                        <td>
                            <button href="/sir/pages/secure/car/car.php?id=<?= $car['id'] ?>" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalManutencao<?= $car['id'] ?>">Listar</button>
                            <!-- Modal Ver Manutenção Admin -->
                            <div class="modal fade" id="modalManutencao<?= $car['id'] ?>" tabindex="-1" aria-labelledby="modalManutencaoLabel<?= $car['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
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
                            <a href="/sir/pages/secure/car/car-delete.php?id=<?= $car['id'] ?>" class="btn btn-danger">Apagar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>
</main>

<?php
include_once __DIR__ . '/../../../templates/footer.php';
 ?>