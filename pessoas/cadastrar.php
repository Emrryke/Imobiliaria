<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar Pessoa</title>
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

<main>
  <div class="wrapper">
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
  </div>
</main>
</body>
</html>