<?php
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
    echo "teste";
    $data = validatedMessage($req);

    echo "teste";
    if (isset($data['invalid'])) {
        echo "teste";
        $_SESSION['errors'] = $data['invalid'];
        header('location: /sir/pages/secure/email.php?id=' . $_GET['id']);
        return false;
    }

    $success = sendMessage($data);

    if ($success) {
        $params = '?' . http_build_query($data);
        header('location: /sir/pages/secure/email.php?id=' . $_GET['id']);
    }
}

function checkErrors($data, $req)
{
    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        header('location: /crud/pages/secure/email.php?id=' . $_GET['id']);
        return false;
    }

    unset($_SESSION['errors']);
    return true;
}