<?php
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
        header('location: /sir/pages/secure/car/car.php' . $params);
        return false;
    }

    $success = createCar($data);

    if ($success) {
        $_SESSION['success'] = 'User created successfully!';
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
        header('location: /sir/pages/secure/car/car-new.php' . $params . '&action=update');

        return false;
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
    return $car;
}
