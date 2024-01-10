<?php
require_once __DIR__ . '../../db/connection.php';

function createCar($car)
{
    $sqlCreate = "INSERT INTO 
    car (
        matricula,
        marca, 
        modelo, 
        cor, 
        id_user, 
        descricao
    ) VALUES (
        :matricula,
        :marca, 
        :modelo, 
        :cor, 
        :id_user, 
        :descricao
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
        ':matricula' => $car['matricula'],
        ':marca' => $car['marca'],
        ':modelo' => $car['modelo'],
        ':cor' => $car['cor'],
        ':id_user' => $_SESSION['id'],
        ':descricao' => $car['descricao']
    ]);

    if ($success) {
        $car['id'] = $GLOBALS['pdo']->lastInsertId();
    }
    return $success;
}

function getCarById($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM car WHERE id = ?;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getCarByMatricula($matricula)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM car WHERE matricula = ? LIMIT 1;');
    $PDOStatement->bindValue(1, $matricula);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getAllCarByUserId($userId)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM car WHERE id_user = ?');
    $PDOStatement->bindValue(1, $userId, PDO::PARAM_INT);
    $PDOStatement->execute();
    $cars = [];
    while ($carList = $PDOStatement->fetch()) {
        $cars[] = $carList;
    }
    return $cars;
}


function updateCar($car)
{

    $sqlUpdate = "UPDATE  
    car SET
        matricula = :matricula,
        marca =     :marca, 
        modelo =    :modelo, 
        cor =       :cor, 
        descricao = :descricao
    WHERE id =      :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':matricula' => $car['matricula'],
        ':marca'     => $car['marca'],
        ':modelo'    => $car['modelo'],
        ':cor'       => $car['cor'],
        ':descricao' => $car['descricao'],
        ':id'        => $car['id']
    ]);

}

function updateEstado($car)
{
    $sqlUpdate = "UPDATE  
    car SET
        estado = :estado,
    WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':name' => $car['estado'],
        ':id' => $car['id']
    ]);
}

function deleteCar($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('DELETE FROM car WHERE id = ?;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    return $PDOStatement->execute();
}