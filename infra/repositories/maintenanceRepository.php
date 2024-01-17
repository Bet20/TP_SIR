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

function getMaintenanceByCarId($carId)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT m.id as id, id_car, dt_inicio, dt_fim, em.nome as estado, descricao, preco FROM tp_sir.manutencao as m JOIN tp_sir.estadomanutencao as em on id_estado = em.id WHERE id_car = ? and id_estado != "3";');
    $PDOStatement->bindValue(1, $carId, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getAllMaintenanceStates()
{
    $PDOStatement = $GLOBALS['pdo']->query('SELECT id, nome FROM estadomanutencao;');
    $maintenanceStates = [];
    while ($listaMaintenanceStates = $PDOStatement->fetch()) {
        $maintenanceStates[] = $listaMaintenanceStates;
    }
    return $maintenanceStates;
}

function updateMaintenance($maintenance)
{
    $sqlUpdate = "UPDATE  
    manutencao SET
        id_estado = :estado,
        descricao = :descricao, 
        preco = :preco
    WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':estado' => $maintenance['estado'],
        ':descricao' => $maintenance['descricao'],
        ':preco' => $maintenance['preco'],
        ':id' => $maintenance['id']
    ]);
}

function getMaintenanceNameByCarId($carId)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT em.nome as estadoNome FROM car JOIN manutencao as m on car.id = m.id_car JOIN estadomanutencao as em on em.id = m.id_estado WHERE car.id = ? AND m.id_estado !=3 LIMIT 1;');
    $PDOStatement->bindValue(1, $carId);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function deleteMaintenanceById($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('DELETE FROM ' . $tabelaManutencao . ' WHERE id = ?;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    return $PDOStatement->execute();
}

function getAllMaintenance()
{
    $PDOStatement = $GLOBALS['pdo']->query('SELECT * FROM manutencao;');
    $maintenance = [];
    while ($listaMaintenance = $PDOStatement->fetch()) {
        $maintenance[] = $listaMaintenance;
    }
    return $maintenance;
}

function getAllMaintenanceWithCarDetails()
{
    $PDOStatement = $GLOBALS['pdo']->query('SELECT m.id as id, id_car, dt_inicio, dt_fim, em.nome as estado, descricao, preco, marca, matricula FROM tp_sir.manutencao as m JOIN tp_sir.estadomanutencao as em on id_estado = em.id JOIN tp_sir.car as c on m.id_car = c.id WHERE id_estado != "3";');
    $maintenance = [];
    while ($listaMaintenance = $PDOStatement->fetch()) {
        $maintenance[] = $listaMaintenance;
    }
    return $maintenance;
}