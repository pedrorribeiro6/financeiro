<?php
require_once 'config.php';

//Verificar se o usúario está logado

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}


$usuario_id = $_SESSION['usuario_id'];
$usuario_nome = $_SESSION['usuario_nome'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Financeiro</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1 id="ind">Sistema Financeiro</h1>

    <div>
        <p id="bv">Bem-Vindo,<strong><?php echo $usuario_nome ?></strong></p>
        <a href="logout.php">Sair</a>
    </div>
</body>

</html>