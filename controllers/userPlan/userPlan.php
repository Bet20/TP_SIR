<?php
require_once __DIR__ . '/../../infra/repositories/planRepository.php';
require_once __DIR__ . '/../../helpers/session.php';

if (isset($_POST['userPlan'])) {
    if ($_POST['userPlan'] == 'create') {
        createUserPlanControl($_POST);
    }

    if ($_POST['plan'] == 'update') {
        update($_POST);
    }

    if ($_POST['plan'] == 'profile') {
        updateProfile($_POST);
    }

    if ($_POST['plan'] == 'password') {
        changePassword($_POST);
    }
}

function createUserPlanControl($req)
{
    $success = createUserPlan($data);

    if ($success) {
        $_SESSION['success'] = 'User associado ao plano com sucesso!';
        header('location: /sir/pages/secure/');
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
