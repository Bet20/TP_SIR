<?php
require_once __DIR__ . '../../db/connection.php';

function createUser($user)
{
    $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
    $sqlCreate = "INSERT INTO 
    user (
        name,
        telemovel, 
        email, 
        foto, 
        admin, 
        password) 
    VALUES (
        :name,
        :telemovel, 
        :email, 
        :foto, 
        :admin, 
        :password
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
        ':name' => $user['name'],
        ':telemovel' => $user['telemovel'],
        ':email' => $user['email'],
        ':foto' => $user['foto'],
        ':admin' => $user['admin'],
        ':password' => $user['password']
    ]);

    if ($success) {
        $user['id'] = $GLOBALS['pdo']->lastInsertId();
    }
    return $success;
}

function getById($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM user WHERE id = ?;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getByEmail($email)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM user WHERE email = ? LIMIT 1;');
    $PDOStatement->bindValue(1, $email);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getAll()
{
    $PDOStatement = $GLOBALS['pdo']->query('SELECT * FROM user;');
    $user = [];
    while ($listaUser = $PDOStatement->fetch()) {
        $user[] = $listaUser;
    }
    return $user;
}

function updateUser($user)
{
    if (isset($user['password']) && !empty($user['password'])) {
        $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

        $sqlUpdate = "UPDATE  
        user SET
            name = :name,
            telemovel = :telemovel, 
            email = :email, 
            password = :password,
            foto = :foto, 
            admin = :admin
        WHERE id = :id;";

        $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

        return $PDOStatement->execute([
            ':id' => $user['id'],
            ':name' => $user['name'],
            ':telemovel' => $user['telemovel'],
            ':email' => $user['email'],
            ':password' => $user['password'],
            ':foto' => $user['foto'],
            ':admin' => $user['admin']
        ]);
    }

    if (isset($user['foto']) && !empty($user['foto'])) {
        $sqlUpdate = "UPDATE  
        user SET
            name = :name,
            telemovel = :telemovel, 
            email = :email, 
            foto = :foto, 
            admin = :admin
        WHERE id = :id;";

        $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

        return $PDOStatement->execute([
            ':id' => $user['id'],
            ':name' => $user['name'],
            ':telemovel' => $user['telemovel'],
            ':email' => $user['email'],
            ':foto' => $user['foto'],
            ':admin' => $user['admin']
        ]);
    }

    $sqlUpdate = "UPDATE  
    user SET
        name = :name,
        telemovel = :telemovel, 
        email = :email, 
        admin = :admin
    WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':id' => $user['id'],
        ':name' => $user['name'],
        ':telemovel' => $user['telemovel'],
        ':email' => $user['email'],
        ':admin' => $user['admin']
    ]);
}

function updatePassword($user)
{
    if (isset($user['password']) && !empty($user['password'])) {
        $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

        $sqlUpdate = "UPDATE  
        user SET
            password = :password
        WHERE id = :id;";

        $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

        return $PDOStatement->execute([
            ':id' => $user['id'],
            ':password' => $user['password']
        ]);
    }
}

function deleteUser($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('DELETE FROM user WHERE id = ?;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    return $PDOStatement->execute();
}

function createNewUser($user)
{
    $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
    $sqlCreate = "INSERT INTO 
    user (
        name, 
        email, 
        password) 
    VALUES (
        :name, 
        :email, 
        :password
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);
    $success = $PDOStatement->execute([
        ':name' => $user['name'],
        ':email' => $user['email'],
        ':password' => $user['password']
    ]);

    if ($success) {
        $user['id'] = $GLOBALS['pdo']->lastInsertId();
        return $user;
    }

    return false;
}
