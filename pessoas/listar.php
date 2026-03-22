<?php
include __DIR__ . '/../conexao.php';

$sql = "SELECT * FROM pessoas";
$result = $conn->query($sql);
?>

<div class="container mt-4">
  <?php if(isset($_GET['msg'])): ?>
    <div class="alert alert-success">
      Operação realizada com sucesso!
    </div>
  <?php endif; ?>

  <h2 class="mb-4">Lista de Pessoas</h2>

  <a href="/imobiliaria/pessoas/cadastrar.php" class="btn btn-success mb-3">+ Nova Pessoa</a>

  <table class="table table-striped table-bordered table-hover">
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>CPF</th>
      <th>Sexo</th>
      <th>Email</th>
      <th>Ações</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nome'] ?></td>
        <td><?= $row['cpf'] ?></td>
        <td><?= $row['sexo'] ?></td>
        <td><?= $row['email'] ?></td>
        <td>
          <a href="/imobiliaria/pessoas/editar.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Editar</a>

          <a href="/imobiliaria/pessoas/excluir.php?id=<?= $row['id'] ?>" 
             class="btn btn-danger btn-sm"
             onclick="return confirm('Tem certeza?')">
             Excluir
          </a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</div>