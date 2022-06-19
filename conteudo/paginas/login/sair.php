<?php
session_start();
unset($_SESSION['instituicao'], $_SESSION['instituicao_id']);

$_SESSION['msg'] = "Successfully logged out";
header("Location: login.php");



