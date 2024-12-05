<?php
include('includes/header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];

    $stmt = $pdo->prepare("SELECT preco, quantidade FROM produtos WHERE id = ?");
    $stmt->execute([$id]);
    $produto = $stmt->fetch();

    if ($produto['quantidade'] >= $quantidade) {
        $total = $produto['preco'] * $quantidade;

        $stmt = $pdo->prepare("INSERT INTO vendas (produto_id, quantidade, total) VALUES (?, ?, ?)");
        $stmt->execute([$id, $quantidade, $total]);

        $stmt = $pdo->prepare("UPDATE produtos SET quantidade = quantidade - ? WHERE id = ?");
        $stmt->execute([$quantidade, $id]);

        echo "<p>Venda realizada com sucesso! Total: R$ " . number_format($total, 2, ',', '.') . "</p>";
    } else {
        echo "<p>Estoque insuficiente!</p>";
    }
}

$stmt = $pdo->query("SELECT * FROM produtos");
$produtos = $stmt->fetchAll();
?>
<h2>Vendas Rápidas</h2>
<form method="POST">
    <label for="produto_id">Produto:</label>
    <select id="produto_id" name="produto_id">
        <?php foreach ($produtos as $produto): ?>
        <option value="<?= $produto['id'] ?>"><?= htmlspecialchars($produto['nome']) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="quantidade">Quantidade:</label>
    <input type="number" id="quantidade" name="quantidade" required>

    <button type="submit">Realizar Venda</button>
</form>
<?php include('includes/footer.php'); ?>
