<?php
(isset($_REQUEST['action']) && $_REQUEST['action'] == 'update') ? $string = ' - Listar Veículo' : $string = ' - Registar Veículo';

$title = $string;

require_once __DIR__ . '../../../../helpers/session.php';
require_once __DIR__ . '/../../../templates/header-secure.php'; 
require_once __DIR__ . '../../../../infra/repositories/carRepository.php';

$user = user();
?>

<?php require_once __DIR__ . '/../../../templates/navbar.php' ?>
<main class="d-flex flex-column container">

    <h2>Formulário de Criação de Carro</h2>

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

    <div class="special-border p-3">
        <form enctype="multipart/form-data" action="/sir/controllers/car/car.php" method="post" class="row">
            <label for="foto" class="fileContainer col-3">
                Selecione a imagem do carro:
                <div class="border w-100 h-100">
                    <i class="fas fa-camera fa-3x d-flex h-100 justify-content-center align-items-center"></i>
                    <input type="file" id="foto" name="foto" id="inputFile" class="d-none" accept="image/*">
                </div>
            </label>
            <div class="mb-3 row col-9">
                <div class="col-6 d-flex justify-content-between">
                    <label for="marca" class="col-sm-2 col-form-label">Marca</label>
                    <input class="me-5 right-50"
                            type="text" id="marca" name="marca" required
                           value="<?= isset($_REQUEST['marca']) ? $_REQUEST['marca'] : null ?>">
                </div>

                <div class="col-6 d-flex justify-content-between">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Matrícula</label>
                    <input class="me-5 right-50" type="text" id="matricula" name="matricula" required minlength="5" maxlength="20"
                           value="<?= isset($_REQUEST['matricula']) ? $_REQUEST['matricula'] : null ?>">
                </div>

                <div class="col-6 d-flex justify-content-between">
                    <label for="modelo">Modelo:</label>
                    <input class="me-5 right-50" type="text" name="modelo" id="modelo" required
                           value="<?= isset($_REQUEST['modelo']) ? $_REQUEST['modelo'] : null ?>">
                </div>

                <div class="col-6 d-flex justify-content-between">
                    <label for="cor">Cor:</label>
                    <input class="me-5 right-50" type="color" id="cor" name="cor"
                           value="<?= isset($_REQUEST['cor']) ? $_REQUEST['cor'] : '#000000' ?>">
                </div>

                <div class="col-12">
                    <label for="descricao" class="col-sm-2 col-form-label">Descrição</label>
                    <input id="descricao" name="descricao" class="width-100" rows="4"
                           value="<?= isset($_REQUEST['descricao']) ? $_REQUEST['descricao'] : null ?>">
                </div>
            </div>
            <input type="hidden" name="id" value="<?= isset($_REQUEST['id']) ? $_REQUEST['id'] : null ?>">
            <div class="row justify-content-end">
                <div class="d-grid col-4 ">
                    <a href="/sir/pages/secure"
                       class="btn btn-md btn-warning special-border mb-2" type="submit">
                        Cancel
                    </a>
                </div>
                <?php
                if ((isset($_REQUEST['action']) && $_REQUEST['action'] == 'update')) {
                    echo '<div class="d-grid col-4 ">
                    <button class="btn btn-md btn-success special-border mb-2" type="submit" name="car"
                            value="update">
                        Atualizar
                    </button>
                </div>';
                } else {
                    echo '<div class="d-grid col-4 ">
                    <button class="btn btn-md btn-success special-border mb-2" type="submit" name="car"
                            value="create">
                        Criar
                    </button>
                </div>';
                }
                ?>

            </div>


        </form>
    </div>
</main>
<?php
require_once __DIR__ . '/../../../templates/footer.php';
?>
