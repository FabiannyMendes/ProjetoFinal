<?php
include('includes/header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $quantidade = $_POST['quantidade'];

    $stmt = $pdo->prepare("UPDATE produtos SET quantidade = ? WHERE id = ?");
    $stmt->execute([$quantidade, $id]);

    echo "<p>Estoque atualizado com sucesso!</p>";
}

$stmt = $pdo->query("SELECT * FROM produtos");
$produtos = $stmt->fetchAll();
?>
<h2>Gestão de Estoque</h2>
<table>
    <thead>
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produtos as $produto): ?>
        <tr>
            <td><?= htmlspecialchars($produto['nome']) ?></td>
            <td><?= $produto['quantidade'] ?></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                    <input type="number" name="quantidade" value="<?= $produto['quantidade'] ?>" required>
                    <button type="submit">Atualizar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include('includes/footer.php'); ?>
