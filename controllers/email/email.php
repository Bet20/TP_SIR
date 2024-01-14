<?php

session_start();
require_once __DIR__ . '/../../helpers/validations/message/validate-message.php';
require_once __DIR__ . '/../../infra/repositories/emailRepository.php';
require_once __DIR__ . '/../../helpers/session.php';

if (isset($_POST['message'])) {
    if ($_POST['message'] == 'send') {
        sendMessagePost($_POST);
    }
}

function sendMessagePost($req)
{
    $data = validatedMessage($req);

    if (isset($data['invalid'])) {
        echo "teste";
        $_SESSION['errors'] = $data['invalid'];
        header('location: /sir/pages/secure/car/car.php?id=' . $req['id_car']);
        return false;
    }

    $success = sendMessage($data);

    if ($success) {
        $params = '?' . http_build_query($data);
        header('location: /sir/pages/secure/car/car.php?id='. $req['id_car']);
    }
}