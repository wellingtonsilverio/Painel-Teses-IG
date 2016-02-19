<?php
GerarLog::getInstance()->logGerais($_SESSION['usr_id'], 2, "");
session_destroy();
header("Location: index.php");
?>