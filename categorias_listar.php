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

// Buscar todas as categorias do usuário
$sql = "SELECT * FROM categoria WHERE id_usuario = :usuario_id ORDER BY tipo, nome";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->execute();
$categorias = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - Sistema Financeiro</title>
</head>
<body>
    <h1>\Sistema Financeiro</h1>
    
    <div>
        <p id="bv">Bem-Vindo,<strong><?php echo $usuario_nome ?></strong></p>
        <a href="logout.php">Sair</a>
    </div>

    <?php exibir_mensagem(); ?>

    <nav>
        <ul>
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="categorias_listar.php">Categorias</a></li>
            <li><a href="transacoes_listar.php">Transações</a></li>
        </ul>
    </nav>

    <h2>Categorias</h2>
    
    <div>
        <a href="categorias_formulario.php">Nova Categoria</a>
    </div>
    
    <?php if (count($categorias) > 0): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($categoria['nome']); ?></td>
                        <td><?php echo ucfirst($categoria['tipo']); ?></td>
                        <td>
                            <a href="categorias_formulario.php?id=<?php echo $categoria['id_categoria']; ?>">Editar</a>
                            <a href="categorias_excluir.php?id=<?php echo $categoria['id_categoria']; ?>" 
                               onclick="return confirm('Tem certeza que deseja excluir esta categoria?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhuma categoria cadastrada ainda.</p>
    <?php endif; ?>
</body>
</html>