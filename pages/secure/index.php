<?php
require_once __DIR__ . '../../../infra/middlewares/middleware-user.php';
require_once __DIR__ . '../../../infra/repositories/carRepository.php';
require_once __DIR__ . '../../../infra/repositories/maintenanceRepository.php';
require_once __DIR__ . '../../../infra/repositories/maintenanceRepository.php';
require_once __DIR__ . '../../../infra/repositories/emailRepository.php';
@require_once __DIR__ . '/../../helpers/session.php';
$title = ' - APP';
include_once __DIR__ . '../../../templates/header-secure.php';

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
    <?php include_once __DIR__ . '../../../templates/navbar.php'; ?>

    <div class="p-2 container">
        <div class="mt-3">
            <?php
            if ($user['admin'] === 1) {
                echo '<div class="input-group rounded mb-3 gap-2">
                    <input id="car-search" type="search" class="form-control rounded" placeholder="Search" />
                    <button class="input-group-text border-0 rounded btn btn-warning" id="btnCancelSearch">
                        <i class="fas fa-close"></i>
                    </button>
                </div>';
            }
            ?>

            <div>
                <div>
                    <div class="row justify-content-center">
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
                                        <?php foreach ($cars as $car) {  $maintenceStatusName = getMaintenanceNameByCarId($car['id']);?>
                                            <tr>
                                                <td><?= $car['marca'] ?></td>
                                                <td><?= $car['matricula'] ?></td>
                                                <td><?= $car['name'] ?></td>
                                                <td><?= $maintenceStatusName['estadoNome'] ?></td>
                                                <td>
                                                    <a href="/sir/pages/secure/car/car.php?id=<?= $car['id'] ?>" class="btn btn-primary">Ver</a>
                                                    <a href="/sir/pages/secure/car/car-delete.php?id=<?= $car['id'] ?>" class="btn btn-danger">Apagar</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>


                        <?php } else {


                            if (count($cars) === 0) {
                                echo   '<div class="mb-3 align-text-center text-align-center">
                                            <h2 class="text-center">Bem vindo! Comece por adicionar um carro.</h2>
                                            <div class="text-center fs-2">
                                                <i class="fa-solid fa-arrow-down text-center"></i>
                                            </div>
                                        </div>';
                            }

                            foreach ($cars as $car) {
                                echo '
                                <a class="col-3 mt-2" href="/sir/pages/secure/car/car.php?id=' . $car['id'] . '">
                                    <div class="card text-center" style="background: ' . $car['cor'] . '22' . '">
                                        <div class="card-body">
                                            <h5>' . $car['marca'] . '</h5>
                                            <i class="fa-solid fa-car-side my-3"></i>
                                            <h6 class="card-subtitle mb-2 text-muted">' . $car['matricula'] . '</h6>
                                        </div>
                                
                                    </div>
                                </a>';
                            }
                        }
                        ?>

                        <?php if ($canCreateCar) { ?>
                            <a class="col-3 mt-2" href="./car/car-new.php">
                                <div class="card h-100 text-center">
                                    <div class="card-body justify-content-center d-flex align-items-center text-center">
                                        <i class="fa-solid fa-plus my-3"></i>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                    </div>

                </div>
                <div>
                </div>
            </div>
        </div>

    </div>
</main>

<?php
include_once __DIR__ . '../../../templates/footer.php';
?>

<script>
    let t = null
    const carSearchInput = document.getElementById('car-search');
    const btnCancelSearch = document.getElementById('btnCancelSearch');

    btnCancelSearch.addEventListener('click', () => {
        window.location.href = '/sir/pages/secure/index.php';
    });

    <?php if (isset($_GET['search'])) { ?>
        carSearchInput.value = "<?= $_GET['search'] ?>";
    <?php } ?>

    carSearchInput.addEventListener('keyup', (e) => {
        console.log('stopped writing')

        if (t) {
            clearTimeout(t);
        }

        t = setTimeout(() => {
            console.log("was set!")
            const search = e.target.value;
            window.location.href = `/sir/pages/secure/index.php?search=${search}`;
        }, 1000);
    });
</script>