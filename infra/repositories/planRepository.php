<?php
require_once __DIR__ . '../../db/connection.php';

function createPlan($plan)
{
    
    $sqlCreate = "INSERT INTO 
    plan (
        titulo,
        subtitulo,
        footerTitulo, 
        preco, 
        descricao,
        numVeiculos,
        estado
    ) VALUES (
        :titulo,
        :subtitulo,
        :footerTitulo, 
        :preco, 
        :descricao,
        :numVeiculos,
        :estado
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
        'titulo' => $plan['titulo'],
        'subtitulo' => $plan['subtitulo'],
        'footerTitulo' => $plan['footerTitulo'],
        'preco' => $plan['preco'],
        'descricao' => $plan['descricao'],
        'numVeiculos' => $plan['numVeiculos'],
        'estado' => $plan['estado']
    ]);

    if ($success) {
        $plan['id'] = $GLOBALS['pdo']->lastInsertId();
    }
    return $success;
}

function createUserPlan($userPlan)
{
    
    $sqlCreate = "INSERT INTO 
    userplan (
        id_user,
        id_plan, 
        dt_inicio, 
        dt_fim, 
        estado, 
    ) VALUES (
        :id_user,
        :id_plan,
        :dt_inicio,
        :dt_fim,
        :estado,
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
        'id_user' => $userPlan['id_user'],
        'id_plan' => $userPlan['id_plan'],
        'dt_inicio' => $userPlan['dt_inicio'],
        'dt_fim' => $userPlan['dt_fim'],
        'estado' => $userPlan['estado']
    ]);

    if ($success) {
        $userPlan['id'] = $GLOBALS['pdo']->lastInsertId();
    }
    return $success;
}

function getById($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM plan WHERE id = ?;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getPlanByUserId($userId)
{
    //TODO ADICIONAR AND dt_fim < data atual
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM userplan WHERE id_user = ? LIMIT 1;');
    $PDOStatement->bindValue(1, $userId);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function updatePlan($plan)
{
    $sqlUpdate = "UPDATE  
    plan SET
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

function inativarPlan($id)
{
    $sqlUpdate = "UPDATE  
    userplan SET
        estado = 0, 
    WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':id' => $user['id']
    ]);
}

