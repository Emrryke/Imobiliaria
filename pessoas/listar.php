<?php
include("../conexao.php");

$sql = "SELECT * FROM pessoas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Lista de Pessoas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-4">
  <?php if(isset($_GET['msg'])): ?>
    <div class="alert alert-success">
      Operação realizada com sucesso!
    </div>
  <?php endif; ?>

  <h2 class="mb-4">Lista de Pessoas</h2>

<a href="cadastrar.php" class="btn btn-success mb-3">
  + Nova Pessoa
</a>

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
          <a href="editar.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Editar</a>

            <a href="excluir.php?id=<?= $row['id'] ?>" 
                class="btn btn-danger btn-sm"
                onclick="return confirm('Tem certeza?')">
                Excluir
            </a>
        </td>
      </tr>
    <?php endwhile; ?>

  </table>
</div>
</body>
</html>