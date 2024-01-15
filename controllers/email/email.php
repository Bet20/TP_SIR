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
        header('location: /sir/pages/secure/car/car.php?id=' . $req['id_car']);
        return false;
    }

    if(isset($_FILES['image']) && $_FILES['image']['size'] > 0) {

        $targetDirectory = "sir/assets/images/uploads/";

        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }

        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image"]["name"], $targetFile)) {
                error_log("The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.");

                $data['image'] = $targetFile;
            } else {
                if (is_writable($targetDirectory)) {
                    error_log("The directory is writable.");
                } else {
                    echo "The directory is not writable. Please check permissions.";
                }
                error_log("Sorry, there was an error uploading your file.");
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    $success = sendMessage($data);

    if ($success) {
        $params = '?' . http_build_query($data);
        header('location: /sir/pages/secure/car/car.php?id='. $req['id_car']);
    }
}