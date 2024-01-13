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
                    <div class="row">
                        <div class="col-12 row mb-5">
                            <div class="col-6">
                                <a class="d-flex align-items-center p-2 btn btn-danger special-border"
                                href="/sir/pages/secure/email.php">
                                <span class="mx-2">Email - este botao é para sair</span>
                                <i class="fa-solid fa-car-side"></i>
                                </a>
                            </div>
                        </div>
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
        <div class="d-flex align-items-stretch mt-4">
            <div class="col-md-6 pe-1">
                <div class="h-100 p-5 text-bg-dark rounded-3">
                    <h2>Your Profile</h2>
                    <a href="/sir/pages/secure/user/profile.php">
                        <button class="btn btn-outline-light px-5"
                                type="button">Change
                        </button>
                    </a>
                </div>
            </div>
            <?php
            if (isAuthenticated() && $user['admin']) {
                echo '<div class="col-md-6 ps-1">
                    <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                        <h2>Admin</h2>
                        <a href="/sir/pages/secure/admin/"><button class="btn btn-outline-success" type="button">Admin</button></a>
                    </div>
                </div>';
            } else {
                echo '<div class="col-md-6 ps-1">
                    <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                        <h3>Feel like your plane limits you in any way? Upgrade your plan now!</h3>
                        <a href="/sir/pages/secure/admin/"><button class="btn btn-outline-danger" type="button">Upgrade</button></a>
                    </div>
                </div>';
            }
            ?>
        </div>
        <?php
        $logs_examples = array(
            "Maintenance" => ["Mudança de óleo", 'xx/xx/xxxx'],
            "Washing" => ["Lavagem", 'xx/xx/xxxx'],
            "Others" => ["Investigar som estranho no motor", 'xx/xx/xxxx']);

        echo '<div class="d-flex align-items-stretch mt-4"><h3>Latest</h3></div>';
        foreach ($logs_examples as $key => $value) {
            // Fixable
            echo '<div class="d-flex align-items-stretch mt-1">
            <div class="col-md-12">
                <div class=" valign-middle text-center p-2 text-bg-dark special-border rounded-3 d-flex justify-content-between">
                    ';
            echo "<div class='d-flex'><i class='fa-solid fa-wrench d-flex float-left me-2'></i><span><b>$key</b> : $value[0]</span></div><span>$value[1]</span>";
            echo '</div></div></div>';
        }

        ?>
    </div>
</main>

<?php
include_once __DIR__ . '../../../templates/footer.php';
?>
