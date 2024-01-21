<?php
session_start();
require_once __DIR__ . '/../../helpers/validations/car/validate-car.php';
require_once __DIR__ . '/../../infra/repositories/carRepository.php';
require_once __DIR__ . '/../../helpers/session.php';

if (isset($_POST['car'])) {
    if ($_POST['car'] == 'create') {
        create($_POST);
    }

    if ($_POST['car'] == 'update') {
        update($_POST);
    }

    if ($_POST['car'] == 'profile') {
        updateProfile($_POST);
    }

    if ($_POST['car'] == 'password') {
        changePassword($_POST);
    }
}

if (isset($_GET['car'])) {
    if ($_GET['car'] == 'update') {
        $car = getCarById($_GET['id']);

        if(!isset($car)){
            $_SESSION['errors'] = ['Não existe esse carro.'];
            header('location: /sir/pages/secure/car/car.php' . $params);
        }

        $car['action'] = 'update';
        $params = '?' . http_build_query($car);
        header('location: /sir/pages/secure/car/car-new.php' . $params);
    }

    if ($_GET['car'] == 'details') {
        $car = getCarById($_GET['id']);

        if(!isset($car)){
            $_SESSION['errors'] = ['Não existe esse carro.'];
            header('location: /sir/pages/secure/car/car.php' . $params);
        }

        $params = '?' . http_build_query($car);
        header('location: /sir/pages/secure/car/car-details.php' . $params);
    }

    if ($_GET['car'] == 'delete') {
        $car = getCarById($_GET['id']);
        if (!isset($car) || $car['id_user'] != $_SESSION['id']) {
            $_SESSION['errors'] = ['Não é possivel apagar este Carro!'];
            header('location: /sir/pages/secure/car/car.php');
            return false;
        }

        $success = delete_car($car);

        if ($success) {
            $_SESSION['success'] = 'Car deleted successfully!';
            header('location: /sir/pages/secure/car/car.php');
        }
    }
}

function create($req)
{
    $data = validatedCar($req);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?' . http_build_query($req);
        header('location: /sir/pages/secure/car/car-new.php' . $params);
        return false;
    }

    if (!empty($_FILES['foto']['name'])) {
        $data = saveFile($data, $req);
    }

    $carId = createCar($data);

    if ($carId) {
        header('location: /sir/pages/secure/car/car.php?id=' . $carId . '?foto=' . $data['foto']);
    }
}

function update($req)
{
    $data = validatedCar($req);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $_SESSION['action'] = 'update';
        $params = '?' . http_build_query($req);
        header('location: /sir/pages/secure/car/car-new.php' . $params . '&action=update');

        return false;
    }
 
    if (!empty($_FILES['foto']['name'])) {
        $data = saveFile($data, $req);
    }

    $success = updateCar($data);

    if ($success) {
        $_SESSION['success'] = 'Car successfully changed!';
        $data['action'] = 'update';
        $params = '?' . http_build_query($data);
        header('location: /sir/pages/secure/car/car.php' . $params);
    }
}

function delete_car($car)
{
    $data = deleteCar($car['id']);
    
    if($data){
        header('location: /sir/pages/secure/');
    }
}

function saveFile($data, $oldImage = null)
{
    $fileName = $_FILES['foto']['name'];
    $tempFile = $_FILES['foto']['tmp_name'];

    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
    $extension = strtolower($extension);
    $newName = uniqid('foto') . '.' . $extension;

    $path = __DIR__ . '/../../assets/images/uploads/cars/';

    $file = $path . $newName;

    if (move_uploaded_file($tempFile, $file)) {
        $data['foto'] = $newName;

        if (isset($data['car']) && ($data['car'] == 'update')) {
            unlink($path . $oldImage['foto']);
        }
    }
    return $data;
}
