<?php
require_once __DIR__ . '../../../../infra/repositories/carRepository.php';

$title = ' - Registar Veículo';
require_once __DIR__ . '/../../../templates/header.php'; 
?>

<h2>Formulário de Criação de Carro</h2>

<form  enctype="multipart/form-data" action="/controllers/car/car.php" method="post">
    <label for="matricula">Matrícula:</label>
    <input type="text" name="matricula" required>

    <label for="descricao">Descrição:</label>
    <textarea name="descricao" rows="4"></textarea>

    <label for="marca">Marca:</label>
    <input type="text" name="marca" required>

    <label for="modelo">Modelo:</label>
    <input type="text" name="modelo" required>

    <label for="cor">Cor:</label>
    <input type="color" name="cor">

    <!-- Adicione mais campos conforme necessário -->
    <button class="btn btn-success special-border" type="submit">Criar</button>
</form>

</body>
</html>
