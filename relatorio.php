<?php
include('includes/header.php');

$stmt = $pdo->query("SELECT v.id, p.nome, v.quantidade, v.total, v.data_venda 
                     FROM vendas v 
                     JOIN produtos p ON v.produto_id = p.id");
$vendas = $stmt->fetchAll();
?>
<h2>Relatório de Vendas</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Total</th>
            <th>Data</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($vendas as $venda): ?>
        <tr>
            <td><?= $venda['id'] ?></td>
            <td><?= htmlspecialchars($venda['nome']) ?></td>
            <td><?= $venda['quantidade'] ?></td>
            <td>R$ <?= number_format($venda['total'], 2, ',', '.') ?></td>
            <td><?= $venda['data_venda'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include('includes/footer.php'); ?>
