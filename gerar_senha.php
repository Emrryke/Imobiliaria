<?php
$senha = '123456'; // coloque a senha que você quer
$hash = password_hash($senha, PASSWORD_DEFAULT);
echo "Senha criptografada: " . $hash;
?>