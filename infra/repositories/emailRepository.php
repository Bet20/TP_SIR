<?php
require_once __DIR__ . '../../db/connection.php';

function sendMessage($message)
{
    $sqlCreate = "INSERT INTO 
    mensagens (
        id_manutencao, 
        mensagem, 
        data,
        sender
    ) VALUES (
        :id_manutencao, 
        :mensagem, 
        :data,
        :sender
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
        ':id_manutencao' => $message['id_manutencao'],
        ':mensagem' => $message['mensagem'],
        ':data' => $message['data'],
        ':sender' => $_SESSION['id']
    ]);

    if ($success) {
        $message['id'] = $GLOBALS['pdo']->lastInsertId();
    }
    return $success;
}

function checkMessage($messageId)
{
    $sqlUpdate = "UPDATE  
    mensagens SET
        vista = 1
    WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':id' => $messageId
    ]);
}

function getMessagesByMaintenceId($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM mensagens WHERE id_manutencao = ?;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetchAll();
}

function updateMessage($mensagem)
{
    if (isset($user['password']) && !empty($user['password'])) {
        $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

        $sqlUpdate = "UPDATE  
        user SET
            name = :name,
            telemovel = :telemovel, 
            email = :email, 
            foto = :foto, 
            admin = :admin, 
            password = :password
        WHERE id = :id;";

        $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

        return $PDOStatement->execute([
            ':id' => $user['id'],
            ':name' => $user['name'],
            ':telemovel' => $user['telemovel'],
            ':email' => $user['email'],
            ':foto' => $user['foto'],
            ':admin' => $user['admin'],
            ':password' => $user['password']
        ]);
    }

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

function deleteMessage($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('DELETE FROM mensagens WHERE id = ?;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    return $PDOStatement->execute();
}