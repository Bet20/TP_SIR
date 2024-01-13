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
        dt_inicio
    ) VALUES (
        :id_user,
        :id_plan,
        :dt_inicio
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
        'id_user' =>  $userPlan['id_user'],
        'id_plan' => $userPlan['id_plan'],
        'dt_inicio' => date('Y-m-d')
    ]);

    if ($success) {
        $userPlan['id'] = $GLOBALS['pdo']->lastInsertId();
    }
    return $success;
}

function getAllPlans()
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT p.id, p.titulo, p.subtitulo, p.footerTitulo, p.preco, p.descricao, p.numVeiculos, p.estado, GROUP_CONCAT(pa.nome) as vantagens 
    FROM plan as p 
    LEFT JOIN planadvantages as pa 
    ON p.id = pa.id_plan
    GROUP BY p.id, p.titulo, p.subtitulo, p.footerTitulo, p.preco, p.descricao, p.numVeiculos, p.estado;'); 
   
    $PDOStatement->execute();    
    return $PDOStatement->fetchAll();
}

function getPlanById($id)
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

