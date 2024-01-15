<?php
require_once __DIR__ . '/../../helpers/validations/maintenance/validate-maintenance.php';
require_once __DIR__ . '/../../infra/repositories/maintenanceRepository.php';
require_once __DIR__ . '/../../helpers/session.php';

if (isset($_POST['maintenance'])) {
    if ($_POST['maintenance'] == 'create') {
        createMaintenancePost($_POST);
    }

    if ($_POST['maintenance'] == 'update') {
        updateMaintenancePost($_POST);
    }

    if ($_POST['maintenance'] == 'profile') {
        updateProfile($_POST);
    }

    if ($_POST['maintenance'] == 'password') {
        changePassword($_POST);
    }

    if ($_GET['maintenance'] == 'delete') {
        $maintenance = getMaintenanceByCarId($_GET['id']);

        $success = deleteMaintenanceById($maintenanceId);

        if ($success) {
            $_SESSION['success'] = 'Manutenção deleted successfully!';
            header('location: /sir/pages/secure/car/car.php?id=' . $maintenance['id_car']);
        }
    }
}

function createMaintenancePost($req)
{
    $data = validatedMaintenance($req);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?' . http_build_query($req);
        header('location: /sir/pages/secure/car/car.php?id=' . $req['id_car']);
        return false;
    }

    $success = createMaintenance($data);
    
    $car['id'] = $req['id_car'];
    $car['estado'] = 0;

    updateEstado($car);

    if ($success) {
        $_SESSION['success'] = 'Manutenção criada com sucesso!';
        header('location: /sir/pages/secure/car/car.php?id=' . $req['id_car']);
    }
}

function updateMaintenancePost($req)
{

    $success = updateMaintenance($req);

    if ($success) {
        $_SESSION['success'] = 'Manutenção successfully updated!';
        header('location: /sir/pages/secure/car/car.php?id=' . $req['id_car']);
    }
}
