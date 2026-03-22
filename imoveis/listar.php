<?php
session_start();
include("../conexao.php");

if ($_SESSION['tipo'] === 'admin') {
    $sql = "SELECT i.*, u.email AS usuario_email FROM imoveis i JOIN usuarios u ON i.usuario_id = u.id";
    $result = $conn->query($sql);
} else {
    $id = $_SESSION['id'];
    $sql = "SELECT i.*, u.email AS usuario_email FROM imoveis i JOIN usuarios u ON i.usuario_id = u.id WHERE usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<div class="container mt-4">
  <?php if(isset($_GET['msg'])): ?>
    <div class="alert alert-success">
      Operação realizada com sucesso!
    </div>
  <?php endif; ?>

  <h2 class="mb-4">Lista de Imóveis</h2>
  <a href="/imobiliaria/imoveis/cadastrar.php" class="btn btn-success mb-3">+ Novo Imóvel</a>

  <table class="table table-striped table-bordered table-hover">
    <tr>
      <th>ID</th>
      <th>Logradouro</th>
      <th>Número</th>
      <th>Bairro</th>
      <th>Complemento</th>
      <th>Proprietário</th>
      <th>Ações</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= intval($row['id']) ?></td>
        <td><?= htmlspecialchars($row['logradouro']) ?></td>
        <td><?= htmlspecialchars($row['numero']) ?></td>
        <td><?= htmlspecialchars($row['bairro']) ?></td>
        <td><?= htmlspecialchars($row['complemento']) ?></td>
        <td><?= htmlspecialchars($row['usuario_email']) ?></td>
        <td>
          <a href="/imobiliaria/imoveis/editar.php?id=<?= intval($row['id']) ?>" class="btn btn-primary btn-sm">Editar</a>
          <a href="/imobiliaria/imoveis/excluir.php?id=<?= intval($row['id']) ?>" class="btn btn-danger btn-sm">Excluir</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</div>