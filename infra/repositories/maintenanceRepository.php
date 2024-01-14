<?php
require_once __DIR__ . '../../db/connection.php';
require_once __DIR__ . '/../../infra/repositories/maintenanceRepository.php';
require_once __DIR__ . '/../../infra/repositories/carRepository.php';

function createMaintenance($maintenance)
{
    $sqlCreate = "INSERT INTO 
    manutencao (
        id_car,
        dt_inicio,
        descricao
    ) 
    VALUES (
        :id_car,
        :dt_inicio,
        :descricao
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
        ':id_car' => $maintenance['id_car'],
        ':dt_inicio' => $maintenance['dt_inicio'],
        ':descricao' => $maintenance['descricao']
    ]);

    if ($success) {
        
        $maintenance['id'] = $GLOBALS['pdo']->lastInsertId();
    }
    return $success;
}

function getMaintenanceById($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM ' . $tabelaManutencao . ' WHERE id = ?;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getMaintenanceByCarId($carId)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT m.id as id, id_car, dt_inicio, dt_fim, em.nome as estado, descricao, preco FROM tp_sir.manutencao as m JOIN tp_sir.estadomanutencao as em on id_estado = em.id WHERE id_car = ? and id_estado != "3";');
    $PDOStatement->bindValue(1, $carId, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getAllMaintenanceStates()
{
    $PDOStatement = $GLOBALS['pdo']->query('SELECT nome FROM estadomanutencao;');
    $maintenanceStates = [];
    while ($listaMaintenanceStates = $PDOStatement->fetch()) {
        $maintenanceStates[] = $listaMaintenanceStates;
    }
    return $maintenanceStates;
}

function updateMaintenance($maintenance)
{
    $sqlUpdate = "UPDATE  
    $tabelaManutencao SET
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

function deleteMaintenanceById($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('DELETE FROM ' . $tabelaManutencao . ' WHERE id = ?;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    return $PDOStatement->execute();
}