<?php
require_once __DIR__ . '../../../../infra/repositories/carRepository.php';

$title = ' - Registar Veículo';
require_once __DIR__ . '/../../../templates/header.php'; 
?>
    <main class="d-flex flex-column">
        <h2>Formulário de Criação de Carro</h2>

        <form  enctype="multipart/form-data" action="/sir/controllers/car/car.php" method="post">
            <label for="matricula">Matrícula:</label>
            <input type="text" name="matricula" required minlength="6" maxlength="20" 
            value="<?= isset($_REQUEST['matricula']) ? $_REQUEST['matricula'] : null ?>">

            <label for="descricao">Descrição:</label>
            <input name="descricao" rows="4"
            value="<?= isset($_REQUEST['descricao']) ? $_REQUEST['descricao'] : null ?>">

            <label for="marca">Marca:</label>
            <input type="text" name="marca" required
            value="<?= isset($_REQUEST['marca']) ? $_REQUEST['marca'] : null ?>">

            <label for="modelo">Modelo:</label>
            <input type="text" name="modelo" required
            value="<?= isset($_REQUEST['modelo']) ? $_REQUEST['modelo'] : null ?>">

            <label for="cor">Cor:</label>
            <input type="color" name="cor"
            value="<?= isset($_REQUEST['cor']) ? $_REQUEST['cor'] : null ?>">

            <!-- Adicione mais campos conforme necessário -->
            <button class="btn btn-success special-border" name="car" value="create" type="submit">Criar</button>
        </form>
    </main>
<?php
    require_once __DIR__ . '/../../../templates/footer.php';
?>
