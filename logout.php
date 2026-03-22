<?php
session_start();
session_destroy();

header("Location: /imobiliaria/login.php");
exit;