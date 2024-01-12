<?php
$title = "- Email";
include_once __DIR__ . '../../../templates/header.php';
include_once __DIR__ . '/../../infra/repositories/emailRepository.php';
$messages = getMessagesByMaintenceId($_GET['id']);
?> 

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card special-border">
                <div class="card-body messages-container">
                    <?php foreach ($messages as $message) : ?>
                        <div class="message">
                            <strong class="user"><?php echo $message['sender']; ?>:</strong>
                            <span class="content"><?php echo $message['mensagem']; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="card-footer">
                    <form action="/sir/controllers/email/email.php?<?= 'message=send&id=' . $_GET['id'] ?>" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control special-border rounded" placeholder="Digite sua mensagem" name="mensagem">
                            <input type="hidden" id="id_manutencao" name="id_manutencao" value="<?= $_GET['id'] ?>">
                            <input type="hidden" id="data" name="data" value="<?= date('Y-m-d'); ?>">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-dark special-border"><i class="fa-solid fa-location-arrow"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once __DIR__ . '../../../templates/footer.php';
?>
