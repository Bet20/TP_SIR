<?php
session_start();
// Verifica se o utilizador está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: index.html'); // Redirecionar para a página de login se não estiver autenticado
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Bem-vindo ao Dashboard</h2>
    <a href="logout.php">Logout</a>
</body>
</html>
