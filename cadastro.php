<?php
include('includes/header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    $stmt = $pdo->prepare("INSERT INTO produtos (nome, preco, quantidade) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $preco, $quantidade]);

    echo "<p>Produto cadastrado com sucesso!</p>";
}
?>
<h2>Cadastro de Produtos</h2>
<form method="POST">
    <label for="nome">Nome do Produto:</label>
    <input type="text" id="nome" name="nome" required>

    <label for="preco">Preço:</label>
    <input type="number" step="0.01" id="preco" name="preco" required>

    <label for="quantidade">Quantidade:</label>
    <input type="number" id="quantidade" name="quantidade" required>

    <button type="submit">Cadastrar Produto</button>
</form>
<?php include('includes/footer.php'); ?>
