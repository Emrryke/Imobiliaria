<?php
include("../conexao.php");

$sql = "SELECT imoveis.*, pessoas.nome 
FROM imoveis
JOIN pessoas ON imoveis.pessoa_id = pessoas.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Lista de Imóveis</title>
<link rel="stylesheet" href="../style.css">
</head>

<body>
<header>
  <div class="navbar">
    <div class="wrapper"> 
      <nav>
        <h1>Imobiliária</h1>
        <div class="menu">
          <a href="/imobiliaria/inicio.php">Início</a>
          <a href="/imobiliaria/imoveis/cadastrar.php">Cadastrar Imóvel</a>
          <a href="/imobiliaria/pessoas/cadastrar.php">Cadastrar Pessoa</a>
        </div>
      </nav>
    </div>
  </div>
</header>

<div class="container mt-4">
<?php if(isset($_GET['msg'])): ?>
  <div class="alert alert-success">
  Operação realizada com sucesso!
</div>
<?php endif; ?>

<h2 class="mb-4">Lista de Imóveis</h2>

<a href="cadastrar.php" class="btn btn-success mb-3">
  + Novo Imóvel
</a>

<table class="table table-striped table-bordered table-hover">

<tr>
  <th>ID</th>
  <th>Logradouro</th>
  <th>Número</th>
  <th>Bairro</th>
  <th>Complemento</th>
  <th>Contribuinte</th>
  <th>Ações</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['logradouro'] ?></td>
        <td><?= $row['numero'] ?></td>
        <td><?= $row['bairro'] ?></td>
        <td><?= $row['complemento'] ?></td>
        <td><?= $row['nome'] ?></td>
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