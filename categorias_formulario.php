<?php
require_once 'config.php';
require_once 'mensagens.php';

//Verificar se o usúario está logado

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}


$usuario_id = $_SESSION['usuario_id'];
$usuario_nome = $_SESSION['usuario_nome'];

//Verificar se está editando
$id_categoria = $_GET['id'] ?? null;
$categoria = null;

if ($id_categoria) {
    // Buscar categoria para editar
    $sql = "SELECT * FROM categoria WHERE id_categoria = :id_categoria AND id_usuario = :usuario_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_categoria', $id_categoria);
    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->execute();
    $categoria = $stmt->fetch();

    // Se não encontrou ou não pertence ao usuário, redireciona
    if (!$categoria) {
        set_mensagem('Categoria não encontrada.', 'erro');
        header('Location: categorias_listar.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoria - Sistema Financeiro</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 id="h1">Sistema Financeiro</h1>

        <div id="sair">
            <p id="bv">Bem-Vindo,<strong><?php echo $usuario_nome ?></strong></p>
            <a id="sr" href="logout.php">Sair</a>
        </div>
        <br>

        <?php exibir_mensagem(); ?>

        <nav class="botoes">
            <ul>
                <li class="tirar-bola"><a class="btn btn-primary" href="index.php">Dashboard</a></li>
                <br>
                <li class="tirar-bola"><a class="btn btn-primary" href="categorias_listar.php">Categorias</a></li>
                <br>
                <li class="tirar-bola"><a class="btn btn-primary" href="transacoes_listar.php">Transações</a></li>
            </ul>
        </nav>
        <h2 class="ultp"><?php echo $categoria ? 'Editar' : 'Nova'; ?> Categoria</h2>

        <form action="categorias_salvar.php" method="POST">
            <?php if ($categoria): ?>
                <input type="hidden" name="id_categoria" value="<?php echo $categoria['id_categoria']; ?>">
            <?php endif; ?>

            <div class="ultp">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome"
                    value="<?php echo $categoria ? htmlspecialchars($categoria['nome']) : ''; ?>"
                    required>
            </div>
            <br>

            <div class="ultp">
                <label for="tipo">Tipo:</label>
                <select id="tipo" name="tipo" required>
                    <option value="">Selecione...</option>
                    <option value="receita" <?php echo ($categoria && $categoria['tipo'] === 'receita') ? 'selected' : ''; ?>>Receita</option>
                    <option value="despesa" <?php echo ($categoria && $categoria['tipo'] === 'despesa') ? 'selected' : ''; ?>>Despesa</option>
                </select>
            </div>
            <br>

            <div class="ultp">
                <button class="btn btn-success" type="submit">Salvar</button>
                <a class="btn btn-danger" href="categorias_listar.php">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>