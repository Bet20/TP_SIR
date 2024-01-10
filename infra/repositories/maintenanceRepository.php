<?php
require_once __DIR__ . '../../db/connection.php';

$tabelaManutencao = '';

function createMaintenance($maintenance)
{
    $sqlCreate = "INSERT INTO 
    $tabelaManutencao (
        campo1
    ) 
    VALUES (
        :campo1
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
        ':campo1' => $maintenance['campo1']
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
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT m.id, id_car, dt_inicio, dt_fim, em.nome as estado, descricao, preco FROM tp_sir.manutencao as m JOIN tp_sir.estadomanutencao as em on id_estado = em.id WHERE id_car = ?  LIMIT 1;');
    $PDOStatement->bindValue(1, $carId, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getAllMaintenance()
{
    $PDOStatement = $GLOBALS['pdo']->query('SELECT * FROM '. $tabelaManutencao . ';');
    $maintenance = [];
    while ($listaMaintenance = $PDOStatement->fetch()) {
        $maintenance[] = $listaMaintenance;
    }
    return $maintenance;
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