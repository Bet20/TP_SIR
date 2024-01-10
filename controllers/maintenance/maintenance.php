<?php
require_once __DIR__ . '/../../helpers/validations/car/validate-car.php';
require_once __DIR__ . '/../../infra/repositories/carRepository.php';
require_once __DIR__ . '/../../helpers/session.php';

if (isset($_POST['maintenance'])) {
    if ($_POST['maintenance'] == 'create') {
        create($_POST);
    }

    if ($_POST['maintenance'] == 'update') {
        update($_POST);
    }

    if ($_POST['maintenance'] == 'profile') {
        updateProfile($_POST);
    }

    if ($_POST['maintenance'] == 'password') {
        changePassword($_POST);
    }
}

if (isset($_GET['maintenance'])) {
    if ($_GET['maintenance'] == 'update') {
        $maintenance = getMaintenanceById($_GET['id']);

        if(!isset($maintenance)){
            $_SESSION['errors'] = ['Não existe esse manutenção.'];
            header('location: /sir/pages/secure/car/car.php' . $params);
        }

        $manutenção['action'] = 'update';
        $params = '?' . http_build_query($maintenance);
        header('location: /sir/pages/secure/car/car.php' . $params);
    }

    if ($_GET['maintenance'] == 'details') {
        $manutenção = getmaintenanceById($_GET['id']);

        if(!isset($manutenção)){
            $_SESSION['errors'] = ['Não existe essa manutenção.'];
            header('location: /sir/pages/secure/car/car.php' . $params);
        }

        $params = '?' . http_build_query($manutenção);
        header('location: /sir/pages/secure/car/car.php' . $params);
    }

    if ($_GET['manutenção'] == 'delete') {
        $manutenção = getManutençãoById($_GET['id']);
        if (!isset($manutenção) || $manutenção['id_user'] != $_SESSION['id']) {
            $_SESSION['errors'] = ['Não é possivel apagar essa manutenção!'];
            header('location: /sir/pages/secure/car/car.php');
            return false;
        }

        $success = delete_car($manutenção);

        if ($success) {
            $_SESSION['success'] = 'Car deleted successfully!';
            header('location: /sir/pages/secure/car/car.php');
        }
    }
}

function create($req)
{
    $data = validatedMaintenance($req);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?' . http_build_query($req);
        header('location: /sir/pages/secure/car/car.php' . $params);
        return false;
    }

    $success = create($data);

    if ($success) {
        $_SESSION['success'] = 'Manutenção criada com sucesso!';
        header('location: /sir/pages/secure/car/car.php');
    }
}

function update($req)
{
    $data = validatedCar($req);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $_SESSION['action'] = 'update';
        $params = '?' . http_build_query($req);
        header('location: /sir/pages/secure/car/car.php' . $params . '&action=update');

        return false;
    }

    $success = updateMaintenance($data);

    if ($success) {
        $_SESSION['success'] = 'Manutenção successfully updated!';
        $data['action'] = 'update';
        $params = '?' . http_build_query($data);
        header('location: /sir/pages/secure/car/car.php' . $params);
    }
}

function delete_Maintenance($maintenance)
{
    $data = deleteMaintenance($maintenance['id']);
    return $maintenance;
}
