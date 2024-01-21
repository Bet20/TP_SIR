<?php
(isset($_REQUEST['action']) && $_REQUEST['action'] == 'update') ? $string = ' - Listar Veículo' : $string = ' - Registar Veículo';

$title = $string;

require_once __DIR__ . '../../../../helpers/session.php';
require_once __DIR__ . '/../../../templates/header-secure.php'; 
require_once __DIR__ . '../../../../infra/repositories/carRepository.php';

$user = user();
?>

<main class="min-vh-100 d-flex flex-column justify-content-between">
    <?php require_once __DIR__ . '/../../../templates/navbar.php' ?>
    <div class="flex-grow-1 container mt-5">
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
                <div class="col-md-4 col-12">
                    <label id="labelFoto" for="foto" class="d-flex align-items-center justify-content-center border h-100">
                        <img id="preview" src="/sir/assets/images/uploads/cars/<?= isset($_REQUEST['foto']) ? $_REQUEST['foto'] : '' ?>" alt="foto" height="200" class="<?= !isset($_REQUEST['foto']) ? 'd-none' : '' ?>">
                        <i id="noImage" class="fa-solid fa-car fs-2 me-2  <?= isset($_REQUEST['foto']) ? 'd-none' : '' ?>" ></i>
                        <input type="file" id="foto" name="foto" accept="image/*" class="d-none" onchange="previewImage()">
                    </label>
                </div>
                <div class="mb-3 row col-md-8 col-12">
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

                    <div class="col-6">
                        <label for="descricao">Descrição</label>
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
    </div>
<?php
require_once __DIR__ . '/../../../templates/footer.php';
?>
</main>


<script>
    //Esta função serve para trocar o src da img
    function previewImage() {
        var input = document.getElementById('foto');

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                var foto = <?php echo json_encode(isset($car['foto'])); ?>;
                //Para ver o preview caso não tenha foto
                if(!foto){
                    document.getElementById('noImage').classList.add('d-none');
                    document.getElementById('preview').classList.remove('d-none');
                }

                document.getElementById('preview').src = e.target.result;
                document.getElementById('labelFoto').classList.add('border-warning');
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
