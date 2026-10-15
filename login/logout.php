<?php
session_start();
$_SESSION = [];
session_destroy();

header('Location: /Projeto-integrador/login/login.php');
exit;
