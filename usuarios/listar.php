<?php
include __DIR__ . '/../conexao.php';

// Verifica se é admin
if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin'){
    echo "Acesso negado. Apenas administradores podem ver a lista de usuários.";
    exit;
}

$result = $conn->query("SELECT id, nome, email, tipo, data_nascimento, telefone FROM usuarios");
?>

<div class="container mt-4">
  <?php if(isset($_GET['msg'])): ?>
    <div class="alert alert-success">
      Operação realizada com sucesso!
    </div>
  <?php endif; ?>

  <h2 class="mb-4">Lista de Usuários</h2>

  <a href="/imobiliaria/usuarios/cadastrar.php" class="btn btn-success mb-3">+ Novo Usuário</a>

  <table class="table table-striped table-bordered table-hover">
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Email</th>
      <th>Tipo</th>
      <th>Data Nascimento</th>
      <th>Telefone</th>
      <th>Ações</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= intval($row['id']) ?></td>
        <td><?= htmlspecialchars($row['nome']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['tipo']) ?></td>
        <td><?= htmlspecialchars($row['data_nascimento']) ?></td>
        <td><?= htmlspecialchars($row['telefone']) ?></td>
        <td>
          <a href="/imobiliaria/usuarios/editar.php?id=<?= intval($row['id']) ?>" class="btn btn-primary btn-sm">Editar</a>
          <a href="/imobiliaria/usuarios/excluir.php?id=<?= intval($row['id']) ?>" class="btn btn-danger btn-sm">Excluir</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</div>