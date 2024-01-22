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
        $_SESSION['errors'] = $data['invalid'];
        header('location: /sir/pages/secure/admin/list-manutencao.php?id=' . $data['id_car']);
        return false;
    }

    if (!empty($_FILES['image']['name'])) {
        $data = saveFile($data, $req);
    }

    $success = sendMessage($data);

    if (isset($success)) {
        header('location: /sir/pages/secure/admin/list-manutencao.php?id=' . $data['id_car']);
    }
}

function saveFile($data, $oldImage = null)
{
    $fileName = $_FILES['image']['name'];
    $tempFile = $_FILES['image']['tmp_name'];

    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
    $extension = strtolower($extension);
    $newName = uniqid('image') . '.' . $extension;

    $path = __DIR__ . '/../../assets/images/uploads/message/';

    $file = $path . $newName;

    if (move_uploaded_file($tempFile, $file)) {
        $data['image'] = $newName;
    }
    return $data;
}