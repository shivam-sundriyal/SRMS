<?php
session_start();

$_SESSION = array();

session_destroy();

session_unset();

session_regenerate_id(true);

header("Location: login.php");
exit();
