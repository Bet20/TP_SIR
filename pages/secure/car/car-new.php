<?php
require_once __DIR__ . '../../../../infra/repositories/carRepository.php';

$title = ' - Registar Veículo';
require_once __DIR__ . '/../../../templates/header.php'; 
?>
    <main class="d-flex flex-column">
        <h2>Formulário de Criação de Carro</h2>

        <a href="/sir/pages/secure/car/car.php"><button class="btn btn-secondary px-5 me-2">Back</button></a>

        <section>
            <?php
            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                echo $_SESSION['success'] . '<br>';
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['errors'])) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                foreach ($_SESSION['errors'] as $error) {
                echo $error . '<br>';
                }
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                unset($_SESSION['errors']);
            }
            ?>
        </section>

        <form  enctype="multipart/form-data" action="/sir/controllers/car/car.php" method="post">
            <label for="matricula">Matrícula:</label>
            <input type="text" name="matricula" required minlength="5" maxlength="20" 
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
            <input type="hidden" name="id" value="<?= isset($_REQUEST['id']) ? $_REQUEST['id'] : null ?>">
            <?php 
                if((isset($_REQUEST['action']) && $_REQUEST['action'] == 'update')){
                    echo '<button type="submit" class="btn btn-success special-border" name="car" value="update">Atualizar</button>';
                } else {
                    echo '<button type="submit" class="btn btn-success special-border" name="car" value="create">Criar</button>';
                }
            ?>
        </form>
    </main>
<?php
    require_once __DIR__ . '/../../../templates/footer.php';
?>
