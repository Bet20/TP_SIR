<?php
require_once __DIR__ . '/../../../infra/repositories/carRepository.php';
require_once __DIR__ . '/../../../infra/repositories/maintenanceRepository.php';
require_once __DIR__ . '/../../../infra/middlewares/middleware-user.php';
require_once __DIR__ . '../../../../helpers/session.php';

$car = getCarById($_GET['id']);

$title = ' - Veículos';
require_once __DIR__ . '/../../../templates/header-secure.php';
include_once __DIR__ . '/../../../infra/repositories/emailRepository.php';
$render_messages = false;
if ($car['estado'] === 0) {
    $maintenance_data = getMaintenanceByCarId($car['id']);
    $messages = getMessagesByMaintenceId($maintenance_data['id']);
    $render_messages = true;
}
?>
    <div class="row">
        <div class="col-6 border-end">
            <h3>Dados da manutenção:</h3>
            <div>
                <p>ID do Carro: <?= $maintenance_data['id_car'] ? $maintenance_data['id_car']: 'N/D' ?></p>
                <p>Data de Início: <?= $maintenance_data['dt_inicio'] ? $maintenance_data['dt_inicio']: 'N/D' ?></p>
                <p>Data de Fim: <?= $maintenance_data['dt_fim'] ? $maintenance_data['dt_fim']: 'N/D' ?></p>
                <p>Estado: <?= $maintenance_data['estado'] ? $maintenance_data['estado']: 'N/D' ?></p>
                <p>Descrição: <?= $maintenance_data['descricao'] ? $maintenance_data['descricao']: 'N/D' ?></p>
                <p>Preço: <?= $maintenance_data['preco'] ? $maintenance_data['preco']: 'N/D' ?></p>
            </div>
        </div>
        <div class="col-6 border-end">
            <h3>Formulario:</h3>
            <form action="/sir/controllers/maintenance/maintenance.php" method="post">
                <label for="estado">Estado:</label>
                <select 
                    class="form-select" 
                    aria-label="Default select example"
                    name="estado"
                >
                    <?php 
                        $maintenanceStates = getAllMaintenanceStates();
                        foreach ($maintenanceStates as $state) {
                            echo '<option value="' . $state["id"] . '">' . $state['nome'] . '</option>';
                        }
                    ?>
                </select>
                <label for="descricao">Descrição:</label>
                <input type="text" name="descricao" id="descricao" class="form-control">
                <label for="preco">Preço:</label>
                <input type="number" name="preco" id="preco" class="form-control" value="<?= $maintenance_data['preco'] ? $maintenance_data['preco']: '' ?>">
                <input type="hidden" name="id" id="id" value="<?= $maintenance_data['id'] ? $maintenance_data['id']: '' ?>">
                <input type="hidden" name="id_car" id="id_car" value="<?= $car['id'] ? $car['id'] : '' ?>">
                <button type="submit" class="btn btn-primary mt-2" name="maintenance" value="update">Atualizar</button>
            </form>

        </div>
    </div>                  
<?php
    include_once __DIR__ . '/../../../templates/footer.php';
 ?>