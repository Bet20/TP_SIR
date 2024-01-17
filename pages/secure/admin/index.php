<?php
require_once __DIR__ . '/../../../infra/middlewares/middleware-user.php';
require_once __DIR__ . '/../../../infra/repositories/carRepository.php';
require_once __DIR__ . '/../../../infra/repositories/maintenanceRepository.php';
require_once __DIR__ . '/../../../infra/repositories/maintenanceRepository.php';
require_once __DIR__ . '/../../../infra/repositories/emailRepository.php';
@require_once __DIR__ . '/../../../helpers/session.php';
$title = ' - Admin painel';
include_once __DIR__ . '/../../../templates/header-secure.php';

$user = user();

if ($user['admin'] !== 1) {
    header('Location: /sir/pages/secure/');
}

require_once __DIR__ . '/../../../templates/navbar.php';
?>

<main class="container">
    <div class="row mt-5 ">
        <div class="col-12 col-md-6">
            <a href="/sir/pages/secure/admin/list-car.php">
                <div class="card p-4 special-border">
                    <h3>Gerir Manutenções</h3>
                    <p>Onde podes gerir as manutenções dos clientes.</p>
                </div>
            </a>
        </div>
            <div class="col-12 col-md-6 mt-2 mt-md-0">
            <a href="/sir/pages/secure/admin/list-user.php">
                <div class="card p-4 special-border">
                    <h3>Gerir Utilizadores</h3>
                    <p>Onde podes gerir as contas dos utilizadores.</p>
                </div>
            </a>
        </div>
    </div>
    <div class="row mt-5">
        <?php include_once __DIR__ . '/../../../templates/calendar.php'; ?>
    </div>
</main>

<?php
    include_once __DIR__ . '/../../../templates/footer.php';
?>