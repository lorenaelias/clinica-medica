<?php

session_start();

$_SESSION['cod'] = -1;

session_unset();

session_destroy();

header('Location: ../../index.php');
exit();

?>