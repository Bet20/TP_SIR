<?php
require_once __DIR__ . '../../../infra/middlewares/middleware-user.php';
require_once __DIR__ . '../../../infra/repositories/carRepository.php';
@require_once __DIR__ . '/../../helpers/session.php';
$title = ' - APP';
include_once __DIR__ . '../../../templates/header-secure.php';

$user = user();
$cars = getAllCarByUserId($user['id']);

$canCreateCar = count($cars) < 5;

?>

<main>
    <?php include_once __DIR__ . '../../../templates/navbar.php'; ?>
    <div class="p-2 container">
        <div class="mt-3">
            <div>
                <div>
                    <div class="row justify-content-center">
                        <?php
                        if (count($cars) === 0) {

                        echo '<div class="mb-3">
                            <h2 class="text-center">Bem vindo! Comece por adicionar um carro.</h2>
                        </div>';
                        }
                        ?>


                        <?php
                        foreach ($cars as $car) {
                            echo '
                                <a class="col-3" href="/sir/pages/secure/car/car.php?id=' . $car['id'] . '">
                                    <div class="card text-center" style="background: ' . $car['cor'] . '22' . '">
                                        <div class="card-body">
                                            <h5>' . $car['marca'] . '</h5>
                                            <i class="fa-solid fa-car-side my-3"></i>
                                            <h6 class="card-subtitle mb-2 text-muted">' . $car['matricula'] . '</h6>
                                        </div>
                                
                                    </div>
                                </a>';
                        }
                        ?>

                        <?php if ($canCreateCar) { ?>
                            <a class="col-3" href="./car/car-new.php">
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
