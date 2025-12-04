<?php
require_once 'config.php';
//Verificar se o usúario já está logado
require_once 'mensagens.php';

if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Financeiro</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1 id="log">Login - Sistema Financeiro</h1>

    <?php exibir_mensagem()?>
    <form action="autenticar.php" method="post">
        <div>
            <label for="email" class="email">E-mail</label>
            <input type="email" name="email" class="email" required>
        </div>
        <br>
        <div>
            <label for="senha" class="senha">Senha:</label>
            <input type="password" name="senha" class="senha" required>
        </div>
        <br>
        <div>
            <button type="submit" id="bt">Entrar</button>
        </div>
    </form>

    <p>Não tem conta?<a href="registro.php">Cadastre-se aqui.</a></p>

    
</body>

</html>