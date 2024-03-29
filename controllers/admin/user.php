<?php

require_once __DIR__ . '/../../infra/repositories/userRepository.php';
require_once __DIR__ . '/../../helpers/validations/admin/validate-user.php';
require_once __DIR__ . '/../../helpers/validations/admin/validate-password.php';
require_once __DIR__ . '/../../helpers/validations/admin/validate-profile.php';
require_once __DIR__ . '/../../helpers/session.php';

if (isset($_POST['user'])) {
    if ($_POST['user'] == 'create') {
        create($_POST);
    }

    if ($_POST['user'] == 'update') {
        update($_POST);
    }
    if ($_POST['user'] == 'profile') {
        updateProfile($_POST);
    }

    if ($_POST['user'] == 'password') {
        changePassword($_POST);
    }
}

if (isset($_GET['user'])) {
    if ($_GET['user'] == 'update') {
        $user = getById($_GET['id']);
        
        if(!isset($user)){
            $_SESSION['errors'] = ['Não existe esse utilizador'];
            header('location: /sir/pages/secure/admin' . $params);
        }

        $user['action'] = 'update';
        $params = '?' . http_build_query($user);
        header('location: /sir/pages/secure/admin/user.php' . $params);
    }

    if ($_GET['user'] == 'delete') {
        $user = getById($_GET['id']);
        if ($user['admin']) {
            $_SESSION['errors'] = ['This user cannot be deleted!'];
            header('location: /sir/pages/secure/admin/list-user.php');
            return false;
        }

        $success = delete_user($user);

        if ($success) {
            $_SESSION['success'] = 'User deleted successfully!';
            header('location: /sir/pages/secure/admin/list-user.php');
        }
    }
}

function create($req)
{
    $data = validatedUser($req);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?' . http_build_query($req);
        header('location: /sir/pages/secure/admin/user.php' . $params);
        return false;
    }

    if (!empty($_FILES['foto']['name'])) {
        $data = saveFile($data, $req);
    }

    $success = createUser($data);

    if ($success) {
        $_SESSION['success'] = 'User created successfully!';
        header('location: /sir/pages/secure/admin/list-user.php');
    }
}

function update($req)
{
    $data = validatedUser($req);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?' . http_build_query($req);
        header('location: /sir/pages/secure/admin/user.php' . $params . '&action=update');

        return false;
    }
    
    if (!empty($_FILES['foto']['name'])) {
        $data = saveFile($data, $req);
    }

    $success = updateUser($data);

    if ($success) {
        $_SESSION['success'] = 'User successfully changed!';
        $data['action'] = 'update';
        $params = '?' . http_build_query($data);
        header('location: /sir/pages/secure/admin/user.php' . $params);
    }
}

function updateProfile($req)
{
    $data = validatedUserProfile($req);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?' . http_build_query($req);
        header('location: /sir/pages/secure/user/profile.php' . $params);
        } else {  
        $user = user();
        $data['admin'] = $user['admin'];

        if (!empty($_FILES['foto']['name'])) {
            $data = saveFile($data, $req);
        }

        $success = updateUser($data);

        if ($success) {
            $_SESSION['success'] = 'Perfil atualizado com sucesso!';
            $_SESSION['action'] = 'update';
            $params = '?' . http_build_query($data);
            header('location: /sir/pages/secure/user/profile.php' . $params);
        }
    }
}

function changePassword($req)
{
    $data = passwordIsValid($req);
    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?' . http_build_query($req);
        header('location: /sir/pages/secure/user/password.php' . $params);
    } else {
        $data['id'] = userId();
        $success = updatePassword($data);
        if ($success) {
            $_SESSION['success'] = 'Password successfully changed!';
            header('location: /sir/pages/secure/user/password.php');
        }
    }
}

function delete_user($user)
{
    $data = deleteUser($user['id']);
    return $data;
}

function saveFile($data, $oldImage = null)
{
    $fileName = $_FILES['foto']['name'];
    $tempFile = $_FILES['foto']['tmp_name'];

    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
    $extension = strtolower($extension);
    $newName = uniqid('foto') . '.' . $extension;

    $path = __DIR__ . '/../../assets/images/uploads/users/';

    $file = $path . $newName;

    if (move_uploaded_file($tempFile, $file)) {
        $data['foto'] = $newName;

        if (isset($data['user']) && ($data['user'] == 'update')) {
            unlink($path . $oldImage['foto']);
        }
    }
    return $data;
}