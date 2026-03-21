<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar Pessoa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-4">
  <h2 class="mb-4">Cadastrar Pessoa</h2>

  <form action="salvar.php" method="POST">

    Nome:<br>
    <input type="text" name="nome" required><br><br>

    Data de nascimento:<br>
    <input type="date" name="data_nascimento" required><br><br>

    CPF:<br>
    <input type="text" name="cpf" required><br><br>

    Sexo:<br>
    <select name="sexo" required>
      <option value="">Selecione</option>
      <option value="Masculino">Masculino</option>
      <option value="Feminino">Feminino</option>
    </select>
    <br><br>

    Telefone:<br>
    <input type="text" name="telefone"><br><br>

    Email:<br>
    <input type="email" name="email"><br><br>

    <button type="submit">Cadastrar</button>

  </form>
</div>
</body>
</html>