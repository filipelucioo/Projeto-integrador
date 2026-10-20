<?php
session_start();
session_destroy();

header("Location: /Projeto-integrador/login/login.php");
exit;
?>
