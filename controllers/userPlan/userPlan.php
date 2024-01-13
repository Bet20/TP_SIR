<?php
require_once __DIR__ . '/../../infra/repositories/planRepository.php';
require_once __DIR__ . '/../../helpers/session.php';

echo '<script>console.log("create")</script>';
if (isset($_GET['userPlan'])) {
    if ($_GET['userPlan'] == 'create') {
        createUserPlanControl($_GET);
    }

}

function createUserPlanControl($req)
{
    $success = createUserPlan($req);

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