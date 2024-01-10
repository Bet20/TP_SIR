<?php
require_once __DIR__ . '../../../../infra/repositories/carRepository.php';
require_once __DIR__ . '../../../../infra/middlewares/middleware-user.php';

$cars = getAllCarByUserId($_SESSION['id']);
$title = ' - Detalhes';
require_once __DIR__ . '/../../../templates/header.php'; 
?>
<div class="pt-1 ">
    <div class="p-5 mb-2 bg-dark text-white">
        <h1>Detalhes do Carro
            <?= isset($_REQUEST['id']) ? $_REQUEST['id'] : null ?>
        </h1>
        <div>
            <label for="matricula">Matrícula:</label>
            <span>
                <?= isset($_REQUEST['matricula']) ? $_REQUEST['matricula'] : null ?>
            </span>
        </div>
        <div>
            <div>
                <label for="descricao">Descrição:</label>
                <span>
                    <?= isset($_REQUEST['descricao']) ? $_REQUEST['descricao'] : null ?>
                </span>
            </div>
            <div>
                <label for="marca">Marca:</label>
                <span>
                    <?= isset($_REQUEST['marca']) ? $_REQUEST['marca'] : null ?>
                </span>
            </div>
            <div>
                <label for="modelo">Modelo:</label>
                <span>
                    <?= isset($_REQUEST['modelo']) ? $_REQUEST['modelo'] : null ?>
                </span>
            </div>
            <div>
                <label for="cor">Cor:</label>
                <span>
                    <?= isset($_REQUEST['cor']) ? $_REQUEST['cor'] : null ?>
                </span>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalMarcacao">
        Agendar Manutenção
    </button>

    <!-- Modal de Marcação -->
    <div class="modal fade" id="modalMarcacao" tabindex="-1" aria-labelledby="modalMarcacaoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalMarcacaoLabel">Agendar Manutenção</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="processar_agendamento.php" method="post">
                            <!-- Campos do formulário -->
                            <div>
                                <label for="dt_inicio">Data de Início:</label>
                                <input type="date" id="dt_inicio" name="dt_inicio" required>
                            </div>
                            <div>
                                <label for="dt_fim">Data de Fim:</label>
                                <input type="date" id="dt_fim" name="dt_fim">
                            </div>
                            <div>
                                <label for="descricao">Descrição:</label>
                                <textarea id="descricao" name="descricao" rows="4"></textarea>
                            </div>
                            <div>
                                <label for="preco">Preço:</label>
                                <input type="number" id="preco" name="preco">
                            </div>
                            <input type="hidden" id="id_user" name="id_user" value="<?= isset($_REQUEST['id']) ? $_REQUEST['id'] : null ?>">
                            <input type="hidden" id="preco" name="preco">

                            <!-- Adicione outros campos conforme necessário -->

                            <button type="submit" class="btn btn-primary">Agendar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once __DIR__ . '/../../../templates/footer.php'; ?>