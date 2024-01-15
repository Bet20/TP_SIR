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

<div>
    <a href="/sir/pages/secure/admin/list-car.php">
        <div>
            <h3>Gerir Manutenções</h3>
        </div>
    </a>
    <a href="/sir/pages/secure/admin/list-user.php">
        <div>
            <h3>Gerir Utilizadores</h3>
        </div>
    </a>
</div>

<?php
    include_once __DIR__ . '/../../../templates/footer.php';
?>