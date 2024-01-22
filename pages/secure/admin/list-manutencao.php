<?php
require_once __DIR__ . '/../../../infra/middlewares/middleware-user.php';
require_once __DIR__ . '/../../../infra/repositories/carRepository.php';
require_once __DIR__ . '/../../../infra/repositories/maintenanceRepository.php';
require_once __DIR__ . '/../../../infra/repositories/maintenanceRepository.php';
require_once __DIR__ . '/../../../infra/repositories/emailRepository.php';
@require_once __DIR__ . '/../../../helpers/session.php';
$title = ' - APP';
include_once __DIR__ . '/../../../templates/header-secure.php';

$user = user();
$canCreateCar = false;


if (isset($_GET['search'])) {
    $cars = getAllCarInMaintenanceWithSearchQuery($_GET['search']);
} else {
    $cars = getAllCarInMaintenance();
}

?>

<main class="min-vh-100 d-flex flex-column justify-content-between">
    <?php include_once __DIR__ . '/../../../templates/navbar.php'; ?>
    <section class="flex-grow-1">
        <div class="col-md-8 col-12 mx-auto">
            <h1 class="ms-5 mt-4">Veículos em Manutenção</h1>
        </div>
        <div class="col-8 mx-auto">
            <div class="input-group special-border rounded my-3 ">
                <input id="car-search" type="search" class="form-control  rounded" placeholder="Search" />
                <button class="input-group-text border-0 rounded btn btn-warning" id="btnCancelSearch">
                    <i class="fas fa-close"></i>
                </button>
            </div>
        </div>
        <div class="m-4 h-75 overflow-y-auto rounded col-md-8 col-12 mx-auto">
            <table class="table special-border m-0">
                <thead class="table-dark">
                    <tr>
                        <th>Cliente</th>
                        <th>Marca</th>
                        <th>Matricula</th>
                        <th>Estado manutenção</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($cars) == 0) {
                        echo '<tr><td class="ps-5 fw-bold text-dark" colspan="5">Não existem veículos em manutenção</td></tr>';
                    };
                    foreach ($cars as $car) {
                        $maintenceStatusName = getMaintenanceNameByCarId($car['id']); ?>
                        <tr>
                            <th class="align-middle"><?= $car['name'] ?></th>
                            <td class="align-middle"><?= $car['marca'] ?></td>
                            <td class="align-middle"><?= $car['matricula'] ?></td>
                            <td class="align-middle">
                                <div class="
                                <?php
                                switch ($maintenceStatusName['estadoNome']) {
                                    case "Em Análise":
                                        echo 'badge rounded-pill text-primary info';
                                        break;
                                    case "Aguardando Pagamento":
                                        echo 'badge rounded-pill text-warning warning';
                                        break;
                                    case "Em Manutenção":
                                        echo 'badge rounded-pill text-success success';
                                        break;
                                    default:
                                        echo 'badge rounded-pill text-dark';
                                } ?>">
                                    <?= $maintenceStatusName['estadoNome'] ?></div>
                            </td>
                            <td>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalManutencao<?= $car['id'] ?>">Gerir Manutenção</button>
                                <!-- Modal Ver Manutenção Admin -->
                                <div class="modal fade" id="modalManutencao<?= $car['id'] ?>" tabindex="-1" aria-labelledby="modalManutencaoLabel<?= $car['id'] ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Manutenção do carro <?= $car['id'] ?></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                require_once __DIR__ . '/../../../infra/repositories/carRepository.php';
                                                require_once __DIR__ . '/../../../infra/repositories/maintenanceRepository.php';
                                                require_once __DIR__ . '/../../../infra/middlewares/middleware-user.php';
                                                require_once __DIR__ . '../../../../helpers/session.php';
                                                include_once __DIR__ . '/../../../infra/repositories/emailRepository.php';

                                                $maintenance_data = getMaintenanceByCarId($car['id']);
                                                $messages = getMessagesByMaintenceId($maintenance_data['id']);
                                                ?>
                                                <div class="row">
                                                    <div class="col-4 border-end">
                                                        <h3>Dados da manutenção:</h3>
                                                        <div>
                                                            <p><b>ID do Carro:</b> <?= $maintenance_data['id_car'] ? $maintenance_data['id_car'] : 'N/D' ?></p>
                                                            <p><b>Data de Início:</b> <?= $maintenance_data['dt_inicio'] ? $maintenance_data['dt_inicio'] : 'N/D' ?></p>
                                                            <p><b>Data de Fim:</b> <?= $maintenance_data['dt_fim'] ? $maintenance_data['dt_fim'] : 'N/D' ?></p>
                                                            <p><b>Estado:</b> <?= $maintenance_data['estado'] ? $maintenance_data['estado'] : 'N/D' ?></p>
                                                            <p><b>Descrição:</b> <?= $maintenance_data['descricao'] ? $maintenance_data['descricao'] : 'N/D' ?></p>
                                                            <p><b>Preço:</b> <?= $maintenance_data['preco'] ? $maintenance_data['preco'] . '€' : 'N/D' ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 border-end">
                                                        <h3>Formulario:</h3>
                                                        <form action="/sir/controllers/maintenance/maintenance.php" method="post">
                                                            <label for="estado">Estado:</label>
                                                            <select class="form-select" aria-label="Default select example" name="estado">
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
                                                            <input type="number" name="preco" id="preco" class="form-control" value="<?= $maintenance_data['preco'] ? $maintenance_data['preco'] : '' ?>">
                                                            <input type="hidden" name="id" id="id" value="<?= $maintenance_data['id'] ? $maintenance_data['id'] : '' ?>">
                                                            <input type="hidden" name="id_car" id="id_car" value="<?= $car['id'] ? $car['id'] : '' ?>">
                                                            <button type="submit" class="btn btn-primary mt-2" name="maintenance" value="update">Atualizar</button>
                                                        </form>
                                                    </div>
                                                    <div class="col-4">
                                                        <?php
                                                        if (isset($messages)) {
                                                        ?>
                                                            <div class="card special-border h-100 col-12">
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

                                                                <div class="card-body messages-container overflow-y-auto">
                                                                    <div class="message">
                                                                        <strong class="user text-warning"><?php echo 'System'; ?>:</strong>
                                                                        <span class="content"><?php echo 'Chat da Manutenção' ?></span>
                                                                    </div>
                                                                    <hr>
                                                                    <?php foreach ($messages as $message) : ?>
                                                                        <div class="message">
                                                                            <strong class="user"><?php echo $message['sender']; ?>:</strong>
                                                                            <span class="content"><?php echo $message['mensagem']; ?></span>
                                                                        </div>
                                                                        <?php if (!empty($message['image'])) : ?>
                                                                            <div class="align-center">
                                                                                <img src="/sir/assets/images/uploads/message/<?= $message['image'] ?>" alt="image" width="200" height="200">
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <form enctype="multipart/form-data" action="/sir/controllers/admin/email.php?<?= 'id=' . $maintenance_data['id'] ?>" method="post">
                                                                        <div class="input-group">
                                                                            <div class="w-100 d-flex gap-2">
                                                                                <input type="text" class="form-control special-border rounded" placeholder="Digite sua mensagem" name="mensagem">
                                                                                <label class="btn btn-outline-dark special-border">
                                                                                    <i id="imageUpload<?= $car['id'] ?>" class="fa-solid fa-upload"></i>
                                                                                    <input id="image" type="file" accept="image/png, image/jpeg, image/jpg" name="image" style="display: none;" onchange="selectImage(<?= $car['id']?>)">
                                                                                </label>
                                                                                <input type="hidden" id="id_manutencao" name="id_manutencao" value="<?= $maintenance_data['id'] ?>">
                                                                                <input type="hidden" id="data" name="data" value="<?= date('Y-m-d'); ?>">
                                                                                <input type="hidden" id="id_car" name="id_car" value="<?= $car['id'] ?>">
                                                                                <div class="input-group-append">
                                                                                    <button type="submit" class="btn btn-outline-dark special-border" id="message" name="message" value="send"><i class="fa-solid fa-location-arrow"></i></button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php
    include_once __DIR__ . '/../../../templates/footer.php';
    ?>

</main>

<script>
    let t = null
    const carSearchInput = document.getElementById('car-search');
    const btnCancelSearch = document.getElementById('btnCancelSearch');

    btnCancelSearch.addEventListener('click', () => {
        window.location.href = '/sir/pages/secure/admin/list-manutencao.php';
    });

    <?php if (isset($_GET['search'])) { ?>
        carSearchInput.value = "<?= $_GET['search'] ?>";
    <?php } ?>

    carSearchInput.addEventListener('keyup', (e) => {
        if (t) {
            clearTimeout(t);
        }

        t = setTimeout(() => {
            console.log("was set!")
            const search = e.target.value;
            window.location.href = `/sir/pages/secure/admin/list-manutencao.php?search=${search}`;
        }, 1000);
    });

    //Abri modal se tiver id na url
    <?php if (isset($_GET['id'])) { ?>
        const id = <?= $_GET['id'] ?>;
        const modal = document.getElementById('modalManutencao' + id);
        const modalManutencao = new bootstrap.Modal(modal);
        modalManutencao.show();
    <?php } ?>

    // Adicionar imagem ao input com variável loading a girar
    function selectImage(id_car) {
        const imageUpload = document.getElementById('imageUpload' + id_car);
        imageUpload.classList.remove('fa-upload');
        imageUpload.classList.add('fa-spinner', 'fa-spin');

        const file = document.querySelector('input[type=file]').files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function() {
            setTimeout(() => {
                    imageUpload.classList.remove('fa-spinner', 'fa-spin');
                    imageUpload.classList.add('fa-check', 'text-success');
            }, 500);
            
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>